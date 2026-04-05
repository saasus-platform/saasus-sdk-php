<?php

namespace AntiPatternInc\Saasus\Laravel\Middleware;

use AntiPatternInc\Saasus\Api\Client as ApiClient;
use Closure;

use Http\Client\Exception\HttpException;
use Symfony\Component\HttpFoundation\Response;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class Auth
{
    // userinfo レスポンスのキャッシュ有効期間（秒）
    // この期間中はロール変更・ユーザー無効化が反映されないため、
    // セキュリティ要件に応じて SAASUS_USERINFO_CACHE_TTL 環境変数で調整すること
    // デフォルト: 60秒、無効化する場合は 0 を設定
    private const DEFAULT_CACHE_TTL_SECONDS = 60;

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $token = $request->bearerToken();
        if (empty($token)) {
            if (isset($_COOKIE['SaaSus_idToken'])) {
                $token = $_COOKIE['SaaSus_idToken'];
            } else {
                Log::info('Can not get SaaSus ID token.');
                if (getenv('SAASUS_AUTH_MODE') == "api") {
                    return response()->json('Invalid ID Token.', Response::HTTP_UNAUTHORIZED);
                } else {
                    return redirect(getenv('SAASUS_LOGIN_URL'));
                }
            }
        }

        $referer = $request->headers->get('referer');
        if (empty($referer)) {
            $referer = "";
        }

        $xSaasusReferer = $request->headers->get('x-saasus-referer');
        if (empty($xSaasusReferer)) {
            $xSaasusReferer = "";
        }

        $ttl = (int) (getenv('SAASUS_USERINFO_CACHE_TTL') !== false
            ? getenv('SAASUS_USERINFO_CACHE_TTL')
            : self::DEFAULT_CACHE_TTL_SECONDS);

        // referer もキーに含めることで、同一トークンでも referer が異なる場合に
        // 別エントリとしてキャッシュする
        $cacheKey = 'saasus_userinfo:' . hash('sha256', $token . ':' . $referer);

        try {
            if ($ttl > 0) {
                $userinfo = Cache::remember($cacheKey, $ttl, function () use ($token, $referer, $xSaasusReferer) {
                    return $this->fetchUserInfo($token, $referer, $xSaasusReferer);
                });
            } else {
                $userinfo = $this->fetchUserInfo($token, $referer, $xSaasusReferer);
            }
        } catch (\Exception $e) {
            if ($e instanceof HttpException) {
                $statusCode = $e->getResponse()->getStatusCode();
                $body = json_decode($e->getResponse()->getBody(), true);
                $type = $body['type'] ?? 'unknown';
                $message = $body['message'] ?? 'unknown error';

                if ($statusCode == Response::HTTP_UNAUTHORIZED) {
                    // 認証エラーの場合はキャッシュを削除してから返す
                    Cache::forget($cacheKey);
                    Log::info('Type: ' . $type . ', Message: ' . $message);
                    if (getenv('SAASUS_AUTH_MODE') == "api") {
                        return response()->json(['type' => $type, 'message' => $message], Response::HTTP_UNAUTHORIZED);
                    } else {
                        return redirect(getenv('SAASUS_LOGIN_URL'));
                    }
                }
                Log::info('Type: ' . $type . ', Message: ' . $message);
                return response()->json(['type' => $type, 'message' => $message], Response::HTTP_INTERNAL_SERVER_ERROR);
            }
            Log::info('Uncaught error: ' . $e);
            return response()->json('Uncaught error', Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        $request->merge(['userinfo' => $userinfo]);

        return $next($request);
    }

    /**
     * SaaSus API から userinfo を取得する
     */
    private function fetchUserInfo(string $token, string $referer, string $xSaasusReferer): array
    {
        $client = new ApiClient($referer, $xSaasusReferer);
        $authApiClient = $client->getAuthClient();
        $response = $authApiClient->getUserInfo(['token' => $token], $authApiClient::FETCH_RESPONSE);
        return json_decode($response->getBody(), true);
    }
}

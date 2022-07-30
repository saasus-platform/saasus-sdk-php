<?php

namespace AntiPatternInc\Saasus\Laravel\Middleware;

use Closure;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

use Symfony\Component\HttpFoundation\Response;

use Illuminate\Support\Facades\Log;

class Auth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $token = $request->bearerToken();
        if (empty($token)) {
            if (isset($_COOKIE['SaaSus_idToken'])) {
                $token = $_COOKIE['SaaSus_idToken'];
            } else {
                Log::info('Can not get SaaSus ID token.');
                if (getenv('SAASUS_AUTH_MODE') == "api") {
                    return response()->json('Invalid ID Token.', Response::HTTP_FORBIDDEN);
                } else {
                    return redirect(getenv('SAASUS_LOGIN_URL'));
                }
            }
        }

        $saasusid = getenv('SAASUS_SAAS_ID');
        $apikey = getenv('SAASUS_API_KEY');
        if ($saasusid === false || $apikey === false) {
            return response()->json('SAASUS_SAAS_ID and SAASUS_API_KEY are required.', Response::HTTP_BAD_REQUEST);
        }

        $apibase = getenv('SAASUS_API_URL_BASE');
        if ($apibase === false) {
            $apibase = "https://auth.api.saasus.io";
        }

        // トークンに対応したユーザ情報を取得
        $url = $apibase . "/api/auth/userinfo";
        $method = "GET";

        $options = [
            'headers' => [
                'X-SaaSus-ID-Token' => $token,
                'X-SaaSus-SaaSID' => $saasusid,
                'X-SaaSus-API-Key' => $apikey,
                'Content-Type' => 'application/json',
            ]
        ];

        // リクエスト送信
        $client = new Client();
        $response = '';
        try {
            $response = $client->request($method, $url, $options);
        } catch (ClientException $e) {
            Log::info('SaaSus userinfo: ' . $e->getResponse()->getBody()->getContents());
            if (getenv('SAASUS_AUTH_MODE') == "api") {
                return response()->json('Invalid ID Token.', Response::HTTP_FORBIDDEN);
            } else {
                return redirect(getenv('SAASUS_LOGIN_URL'));
            }
        }

        // HTTP_FORBIDDEN は JWT がダメな場合
        // なので、ログイン画面に forward される
        if ($response->getStatusCode() == Response::HTTP_FORBIDDEN) {
            Log::info('SaaSus userinfo: HTTP_FORBIDDEN');
            if (getenv('SAASUS_AUTH_MODE') == "api") {
                return response()->json('Invalid ID Token.', Response::HTTP_FORBIDDEN);
            } else {
                return redirect(getenv('SAASUS_LOGIN_URL'));
            }
        }
        // HTTP_UNAUTHORIZED は API Key がダメな場合
        if ($response->getStatusCode() == Response::HTTP_UNAUTHORIZED) {
            return response()->json('Invalid API Key.', Response::HTTP_UNAUTHORIZED);
        }

        // その他のエラー
        if ($response->getStatusCode() != Response::HTTP_OK) {
            return response()->json('unexpected response: ', $response);
        }

        $userinfo = $response->getBody();
        $userinfo = json_decode($userinfo, true);

        $request->merge(['userinfo' => $userinfo]);

        return $next($request);
    }
}

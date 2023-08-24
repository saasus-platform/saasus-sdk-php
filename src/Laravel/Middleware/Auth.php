<?php

namespace AntiPatternInc\Saasus\Laravel\Middleware;

use AntiPatternInc\Saasus\Api\Client as ApiClient;
use Closure;

use Http\Client\Exception\HttpException;
use Symfony\Component\HttpFoundation\Response;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class Auth
{
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

        // リクエスト送信
        $client = new ApiClient($referer);
        $authApiClient = $client->getAuthClient();
        try {
            $response = $authApiClient->getUserInfo(['token' => $token], $authApiClient::FETCH_RESPONSE);
        } catch (\Exception $e) {
            if ($e instanceof HttpException) {
                $statusCode = $e->getResponse()->getStatusCode();
                $type = json_decode($e->getResponse()->getBody(), true)["type"];
                $message = json_decode($e->getResponse()->getBody(), true)["message"];
                if ($statusCode == Response::HTTP_UNAUTHORIZED) {
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

        $userinfo = $response->getBody();
        $userinfo = json_decode($userinfo, true);

        $request->merge(['userinfo' => $userinfo]);

        return $next($request);
    }
}

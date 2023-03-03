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

        // リクエスト送信
        $client = new ApiClient();
        $authApiClient = $client->getAuthClient();
        try {
            $response = $authApiClient->getUserInfo(['token' => $token], $authApiClient::FETCH_RESPONSE);
        } catch (\Exception $e) {
            if ($e instanceof HttpException) {
                $statusCode = $e->getResponse()->getStatusCode();
                if ($statusCode == Response::HTTP_UNAUTHORIZED) {
                    Log::info('Type: Unauthorized, Message: ' . $e->getResponse());
                    if (getenv('SAASUS_AUTH_MODE') == "api") {
                        return response()->json('Invalid ID Token.', Response::HTTP_UNAUTHORIZED);
                    } else {
                        return redirect(getenv('SAASUS_LOGIN_URL'));
                    }
                }
                Log::info('Type: Intenal Server Error, Message: ' . $e->getResponse());
                return response()->json('Unexpected response: ' . $e->getResponse(), Response::HTTP_INTERNAL_SERVER_ERROR);
            }
            return response()->json('Uncaught error', Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        $userinfo = $response->getBody();
        $userinfo = json_decode($userinfo, true);

        $request->merge(['userinfo' => $userinfo]);

        return $next($request);
    }
}

<?php

namespace AntiPatternInc\Saasus\Laravel\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Log;

use AntiPatternInc\Saasus\Api\Client as ApiClient;
use AntiPatternInc\Saasus\Sdk\Auth\Exception\GetAuthCredentialsNotFoundException;
use AntiPatternInc\Saasus\Sdk\Auth\Exception\GetAuthCredentialsInternalServerErrorException;

class CallbackController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index(Request $request)
    {
        if (empty($request->code)) {
            return redirect(getenv('SAASUS_LOGIN_URL'));
        }
        $idToken = '';
        $refreshToken = '';
        $client = new ApiClient;
        $authApiClient = $client->getAuthClient();
        try {
            $res = $authApiClient->getAuthCredentials([
                'code' => $request->code, 'auth-flow' => 'tempCodeAuth',
            ]);
            $idToken = $res->getIdToken();
            $refreshToken = $res->getRefreshToken();
        } catch (GetAuthCredentialsNotFoundException | GetAuthCredentialsInternalServerErrorException $e) {
            if (get_class($e) == 'GetAuthCredentialsNotFoundException') {
                Log::info('Type: Not Found, Message: ' . $e->getError());
                return redirect(getenv('SAASUS_LOGIN_URL'));
            }
            Log::info('Type: Internal Server Error, Message: ' . $e->getError());
            return redirect(getenv('SAASUS_LOGIN_URL'));
        }
        $idTokenCookieOptions = array(
            'path' => '/',
            'secure' => true,
            'httponly' => true,
            'samesite' => 'Strict'
        );
        setcookie(
            'SaaSus_idToken',
            $idToken,
            $idTokenCookieOptions
        );
        $refreshTokenCookieOptions = array(
            'expires' => time() + 60 * 60 * 24 * 30,
            'path' => '/new-tokens',
            'secure' => true,
            'httponly' => true,
            'samesite' => 'Strict',
        );
        setcookie(
            'SaaSus_refreshToken',
            $refreshToken,
            $refreshTokenCookieOptions,
        );

        return response()->view('saasus_default_callback', ['idToken' => $idToken]);
    }
}

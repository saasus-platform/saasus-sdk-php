<?php

namespace AntiPatternInc\Saasus\Laravel\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Log;

use AntiPatternInc\Saasus\Api\Client as ApiClient;
use Http\Client\Exception\HttpException;
use Symfony\Component\HttpFoundation\Response;

class CallbackController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index(Request $request)
    {
        if (empty($request->code)) {
            return redirect(getenv('SAASUS_LOGIN_URL'));
        }
        $idToken = '';
        $client = new ApiClient;
        $authApiClient = $client->getAuthClient();
        try {
            $res = $authApiClient->getAuthCredentials([
                'code' => $request->code, 'auth-flow' => 'tempCodeAuth',
            ]);
            $idToken = $res->getIdToken();
        } catch (\Exception $e) {
            if ($e instanceof HttpException) {
                $statusCode = $e->getResponse()->getStatusCode();
                $type = json_decode($e->getResponse()->getBody(), true)["type"];
                $message = json_decode($e->getResponse()->getBody(), true)["message"];
                if ($statusCode == Response::HTTP_NOT_FOUND) {
                    Log::info('Type: ' . $type . ', Message: ' . $message);
                    return redirect(getenv('SAASUS_LOGIN_URL'));
                }
                Log::info('Type: ' . $type . ', Message: ' . $message);
                return redirect(getenv('SAASUS_LOGIN_URL'));
            }
            Log::info('Uncaught error: ' . $e);
            return redirect(getenv('SAASUS_LOGIN_URL'));
        }
        $arr_cookie_options = array(
            //            'expires' => time() + 60 * 60 * 24 * 30,
            'path' => '/',
            //            'domain' => '.example.com', // leading dot for compatibility or use subdomain
            'secure' => false,     // or false
            'httponly' => true,    // or false
            'samesite' => 'Strict' // None || Lax  || Strict
        );
        setcookie(
            'SaaSus_idToken',
            $idToken,
            $arr_cookie_options
        );

        return response()->view('saasus_default_callback', ['idToken' => $idToken]);
    }
}

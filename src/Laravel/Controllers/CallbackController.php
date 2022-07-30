<?php

namespace AntiPatternInc\Saasus\Laravel\Controllers;

use Illuminate\Http\Request;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;

use Illuminate\Routing\Controller as BaseController;

class CallbackController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index(Request $request)
    {
        $idToken = $request->idToken;
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

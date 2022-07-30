<?php

namespace AntiPatternInc\Saasus\Laravel\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \Symfony\Component\HttpFoundation\Response;

class TokenTransferController extends Controller
{
    public function index(Request $request)
    {
        $origin = getenv("SAASUS_TOKEN_TRANSFER_ORIGIN");
        if (empty($origin)) {
            return response()->json('SaaSus origins are not defined.', Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        return response()->view('saasus_default_token_transfer', ['origin' => $origin]);
        // ->header(
        //     'X-Frame-Options',
        //     'ALLOW-FROM enplus.d',
        //     true
        // );
    }
}

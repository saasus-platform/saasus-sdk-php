<?php

namespace AntiPatternInc\Saasus\Laravel\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TokenTransferController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index(Request $request)
    {
        $origin = getenv("SAASUS_TOKEN_TRANSFER_ORIGIN");
        if (empty($origin)) {
            return response()->json('SaaSus origins are not defined.', Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        return response()->view('saasus_default_token_transfer', ['origin' => $origin]);
    }
}

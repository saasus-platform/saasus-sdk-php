<?php

namespace AntiPatternInc\Saasus\Laravel\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Log;

use Symfony\Component\HttpFoundation\Response;

use AntiPatternInc\Saasus\Api\Client as ApiClient;
use AntiPatternInc\Saasus\Sdk\Auth\Exception\GetAuthCredentialsNotFoundException;
use AntiPatternInc\Saasus\Sdk\Auth\Exception\GetAuthCredentialsInternalServerErrorException;

class CallbackApiController extends BaseController
{
  use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

  public function index(Request $request)
  {
    if (empty($request->code)) {
      return response()->json('code is not provided by query parameter', Response::HTTP_BAD_REQUEST);
    }
    $client = new ApiClient();
    $authApi = $client->getAuthClient();
    try {
      $res = $authApi->getAuthCredentials(['code' => $request->code], $authApi::FETCH_RESPONSE);
      return json_decode($res->getBody(), true);
    } catch (GetAuthCredentialsNotFoundException | GetAuthCredentialsInternalServerErrorException $e) {
      if (get_class($e) == 'GetAuthCredentialsNotFoundException') {
        Log::info('Type: Not Found, Message: ' . $e->getError());
        return response()->json('credentials not found', Response::HTTP_NOT_FOUND);
      }
    }
  }
}

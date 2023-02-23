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
      $res = $authApi->getAuthCredentials([
        'code' => $request->code, 'auth-flow' => 'tempCodeAuth',
      ], $authApi::FETCH_RESPONSE);
      $body = json_decode($res->getBody(), true);
      if (empty($body['refresh_token'])) {
        return response()->json($body, Response::HTTP_OK);
      }
      $arr_cookie_options = array(
        'expires' => time() + 60 * 60 * 24 * 30,
        'path' => '/api/new-tokens',
        'secure' => true,
        'httponly' => true,
        'samesite' => 'None'
      );
      return response()->json($body, Response::HTTP_OK)->cookie('saasus_refresh_token', $body['refresh_token'], $arr_cookie_options);
    } catch (GetAuthCredentialsNotFoundException | GetAuthCredentialsInternalServerErrorException $e) {
      if (get_class($e) == 'GetAuthCredentialsNotFoundException') {
        Log::info('Type: Not Found, Message: ' . $e->getError());
        return response()->json('credentials not found', Response::HTTP_NOT_FOUND);
      }
      return response()->json('internal server error', Response::HTTP_INTERNAL_SERVER_ERROR);
    }
  }
}

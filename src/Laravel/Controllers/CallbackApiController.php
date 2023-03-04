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
use Http\Client\Exception\HttpException;

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
        'path' => '/api/token/refresh',
        'secure' => true,
        'httponly' => true,
        'samesite' => 'None'
      );
      setcookie('saasus_refresh_token', $body['refresh_token'], $arr_cookie_options);
      return response()->json($body, Response::HTTP_OK);
    } catch (\Exception $e) {
      if ($e instanceof HttpException) {
        $statusCode = $e->getResponse()->getStatusCode();
        $type = json_decode($e->getResponse()->getBody(), true)["type"];
        $message = json_decode($e->getResponse()->getBody(), true)["message"];
        if ($statusCode == Response::HTTP_NOT_FOUND) {
          Log::info('Type: ' . $type . ', Message: ' . $message);
          return response()->json(['type' => $type, 'message' => $message], Response::HTTP_NOT_FOUND);
        }
        Log::info('Type: ' . $type . ', Message: ' . $message);
        return response()->json(['type' => $type, 'message' => $message], Response::HTTP_INTERNAL_SERVER_ERROR);
      }
      return response()->json('Uncaught error', Response::HTTP_INTERNAL_SERVER_ERROR);
    }
  }
}

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
use Error;
use Http\Client\Exception\HttpException;

class TokenRefreshApiController extends BaseController
{
  use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

  public function index(Request $request)
  {
    $refreshToken = $request->cookie('saasus_refresh_token');
    if (empty($refreshToken)) {
      return response()->json('saasus_refresh_token cookie is required', Response::HTTP_BAD_REQUEST);
    }
    $client = new ApiClient();
    $authApi = $client->getAuthClient();
    try {
      $res = $authApi->getAuthCredentials([
        'refresh-token' => $refreshToken, 'auth-flow' => 'refreshTokenAuth',
      ], $authApi::FETCH_RESPONSE);
      $body = json_decode($res->getBody(), true);
      if (empty($body['id_token']) || empty($body['access_token'])) {
        throw new Error('failed to get new credentials');
      }
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
      Log::info('Uncaught error: ' . $e);
      return response()->json('Uncaught error', Response::HTTP_INTERNAL_SERVER_ERROR);
    }
  }
}

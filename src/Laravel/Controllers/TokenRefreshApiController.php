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
use Error;

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
    } catch (GetAuthCredentialsNotFoundException | GetAuthCredentialsInternalServerErrorException $e) {
      if (get_class($e) == 'GetAuthCredentialsNotFoundException') {
        Log::info('Type: Not Found, Message: ' . $e->getError());
        return response()->json('credentials not found', Response::HTTP_NOT_FOUND);
      }
      return response()->json('internal server error', Response::HTTP_INTERNAL_SERVER_ERROR);
    }
  }
}
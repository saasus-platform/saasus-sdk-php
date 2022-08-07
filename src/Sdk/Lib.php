<?php

namespace AntiPatternInc\Saasus\Sdk;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use Symfony\Component\HttpFoundation\Response;

class Lib
{

    public static function findUpperCountByMeteringUnitName($planresult, $metering_unit_name)
    {
        $upper = 0;
        foreach ($planresult['pricing_menus'] as $menus) {
            foreach ($menus['units'] as $units) {
                if ($units['metering_unit_name'] == $metering_unit_name) {
                    $upper = $units['upper_count'];
                    break;
                }
            }
        }
        return $upper;
    }


    public static function callApiWithTokenFromHeaders($method, $apipath, $queryParams = [], $postParams = [])
    {
        $header = '';
        $token = '';
        if (in_array('Authorization', $_SERVER)) {
            $header = $_SERVER['Authorization'];
        }

        if (Lib::startsWith($header, 'Bearer ')) {
            $token = Lib::substr($header, 7);
        }

        if (empty($token)) {
            if (in_array('SaaSus_idToken', $_COOKIE)) {
                $token = $_COOKIE['SaaSus_idToken'];
            }
        }

        $saasusid = getenv('SAASUS_SAAS_ID');
        $apikey = getenv('SAASUS_API_KEY');
        if ($saasusid == "" || $apikey == "") {
            error_log('SAASUS_SAAS_ID and SAASUS_API_KEY are required.');
            return false;
        }

        // トークンに対応したユーザ情報を取得
        $apibase = getenv('SAASUS_API_URL_BASE');
        if ($apibase == "") {
            $apibase = "https://auth.api.dev.saasus.io";
        }

        return Lib::callApi(
            $token,
            $method,
            $apibase,
            $apipath,
            $apikey,
            $saasusid,
            $queryParams,
            $postParams
        );
    }


    public static function callApi(
        $idtoken,
        $method,
        $apibase,
        $apipath,
        $apikey,
        $saasusid,
        $queryParams = [],
        $postParams = []
    ) {
        $token = $idtoken;
        $url = $apibase . $apipath;

        $headers = [
            'X-SaaSus-ID-Token' => $token,
            'X-SaaSus-SaaSID' => $saasusid,
            'X-SaaSus-API-Key' => $apikey,
            'Content-Type' => 'application/json',
        ];

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);

        $params = \GuzzleHttp\json_encode($postParams);

        // リクエスト送信
        $client = new Client();
        $request =  new Request(
            $method,
            $url . ($query ? "?{$query}" : ''),
            $headers,
            $params
        );
        $options = [];
        $response = $client->send($request, $options);

        // HTTP_FORBIDDEN は JWT がダメな場合
        // なので、ログイン画面に forward される
        if ($response->getStatusCode() == Response::HTTP_FORBIDDEN) {
            error_log('Invalid ID Token.');
            return false;
        }
        // HTTP_UNAUTHORIZED は API Key がダメな場合
        if ($response->getStatusCode() == Response::HTTP_UNAUTHORIZED) {
            error_log('Invalid API Key.');
            return false;
        }

        // その他正常じゃないパターン
        if ($response->getStatusCode() < 200 || $response->getStatusCode() >= 300) {
            error_log('unexpected response: ' . $response);
            return false;
        }

        $res = (string) $response->getBody();

        $ret = json_decode($res, true);
        if (empty($ret)) {
            return $res;
        }
        return $ret;
    }
}

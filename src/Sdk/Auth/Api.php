<?php

namespace AntiPatternInc\Saasus\Sdk\Auth;

use AntiPatternInc\Saasus\Sdk\Lib;

class Api
{

    protected string $token;
    protected string $saasusid;
    protected string $apikey;
    protected string $apibase;

    function __construct($manualtoken = "")
    {
        $this->token = $manualtoken;
        if (empty($manualtoken)) {
            $header = '';
            if (in_array('Authorization', $_SERVER)) {
                $header = $_SERVER['Authorization'];
                if (Api::startsWith($header, 'Bearer ')) {
                    $this->token = Api::substr($header, 7);
                }
            }


            if (empty($this->token)) {
                if (isset($_COOKIE['SaaSus_idToken'])) {
                    $this->token = $_COOKIE['SaaSus_idToken'];
                } else {
                    error_log('can not find SaaSus id token.');
                    return false;
                }
            }
        }

        $this->saasusid = getenv('SAASUS_SAAS_ID');
        $this->apikey = getenv('SAASUS_API_KEY');
        if ($this->saasusid == "" || $this->apikey == "") {
            error_log('SAASUS_SAAS_ID and SAASUS_API_KEY are required.');
            return false;
        }

        // トークンに対応したユーザ情報を取得
        $this->apibase = getenv('SAASUS_API_URL_BASE');
        if ($this->apibase == "") {
            $this->apibase = "https://api.saasus.io";
        }
    }

    public function getTenant($tenantid)
    {
        $ret = Lib::callApi(
            $this->token,
            "GET",
            $this->apibase,
            "/api/auth/tenants/$tenantid",
            $this->apikey,
            $this->saasusid,
        );
        return $ret;
    }

    public function getPricingPlan($planid)
    {
        $ret = Lib::callApi(
            $this->token,
            "GET",
            $this->apibase,
            "/api/pricing/plans/$planid",
            $this->apikey,
            $this->saasusid,
        );
        return $ret;
    }

    public function getMeteringUnitDateCount($tenantid, $unitname)
    {
        $ret = Lib::callApi(
            $this->token,
            "GET",
            $this->apibase,
            "/api/metering/tenants/$tenantid/units/$unitname/today",
            $this->apikey,
            $this->saasusid,
        );
        return $ret;
    }

    public function putMeteringUnitDateCount($tenantid, $unitname, $count)
    {
        $ret = Lib::callApi(
            $this->token,
            "PUT",
            $this->apibase,
            "/api/metering/tenants/$tenantid/units/$unitname/today",
            $this->apikey,
            $this->saasusid,
            [],
            ["method" => "direct", "count" => $count]
        );
        return $ret;
    }

    public function addMeteringUnitDateCount($tenantid, $unitname, $count)
    {
        $ret = Lib::callApi(
            $this->token,
            "PUT",
            $this->apibase,
            "/api/metering/tenants/$tenantid/units/$unitname/today",
            $this->apikey,
            $this->saasusid,
            [],
            ["method" => "add", "count" => $count]
        );
        return $ret;
    }

    public function getUsers()
    {
        $ret = Lib::callApi(
            $this->token,
            "GET",
            $this->apibase,
            "/api/auth/users",
            $this->apikey,
            $this->saasusid,
        );
        return $ret;
    }

    public function getUser($tenantid, $uuid)
    {
        $ret = Lib::callApi(
            $this->token,
            "GET",
            $this->apibase,
            "/api/auth/tenants/$tenantid/users/$uuid",
            $this->apikey,
            $this->saasusid,
        );
        return $ret;
    }

    public function createUser($email, $password, $tenantid = 1)
    {
        $ret = Lib::callApi(
            $this->token,
            "POST",
            $this->apibase,
            "/api/auth/tenants/$tenantid/users",
            $this->apikey,
            $this->saasusid,
            [],
            ["email" => $email, "password" => $password]
        );
        return $ret;
    }

    public function updateUser($tenantid, $uuid, $attributes)
    {
        $ret = Lib::callApi(
            $this->token,
            "PATCH",
            $this->apibase,
            "/api/auth/tenants/$tenantid/users/$uuid",
            $this->apikey,
            $this->saasusid,
            [],
            ["attributes" => $attributes]
        );
        return $ret;
    }

    public function deleteUser($uuid)
    {
        $ret = Lib::callApi(
            $this->token,
            "DELETE",
            $this->apibase,
            "/api/auth/users/$uuid",
            $this->apikey,
            $this->saasusid,
            [],
            []
        );
        return $ret;
    }

    public function updatePassword($uuid, $password)
    {
        $ret = Lib::callApi(
            $this->token,
            "PATCH",
            $this->apibase,
            "/api/auth/users/$uuid/password",
            $this->apikey,
            $this->saasusid,
            [],
            ["password" => $password]
        );
        return $ret;
    }

    public function createRole($rolename)
    {
        $ret = Lib::callApi(
            $this->token,
            "POST",
            $this->apibase,
            "/api/auth/roles",
            $this->apikey,
            $this->saasusid,
            [],
            ["role_name" => $rolename]
        );
        return $ret;
    }

    public function createUserRole($id, $rolename, $tenantid = 1, $envid = 1)
    {
        $ret = Lib::callApi(
            $this->token,
            "POST",
            $this->apibase,
            "/api/auth/tenants/$tenantid/users/$id/envs/$envid/roles",
            $this->apikey,
            $this->saasusid,
            [],
            ["role_names" => [$rolename]]
        );
        return $ret;
    }

    private static function substr($string, $start, $length = null)
    {
        return mb_substr($string, $start, $length, 'UTF-8');
    }

    private static function startsWith($haystack, $needles)
    {
        foreach ((array) $needles as $needle) {
            if ($needle !== '' && substr($haystack, 0, strlen($needle)) === (string) $needle) {
                return true;
            }
        }

        return false;
    }
}

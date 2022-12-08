<?php

namespace AntiPatternInc\Tests;

use PHPUnit\Framework\TestCase;

use AntiPatternInc\Saasus\Api\Client;
use AntiPatternInc\Saasus\Api\GuzzleMiddleware;


class SdkTest extends TestCase
{
    public function testSign()
    {

        $header = GuzzleMiddleware::getSignAsHeader(
            "AAA",
            "BBB",
            "CCC",
            "get",
            "localhost",
            "/api/getEnv",
            "",
            ""
        );

        var_dump($header);
    }

    public function testApi()
    {

        $apiClient = new Client(
            "aaa",
            "6hKgIFCub8BR3eKveif9qModVjS8EZ9Tzvm1n04R",
            "98utjcckwed9uhnor7",
            "9it08tgiygos08utgwfaiunawfa20weccawoijt80qqi30iqdiq",
            "http://localhost:8080/api"
        );

        $ret = $apiClient->getAuthClient()->getBasicInfo();
        var_dump("============GET!===================");
        var_dump($ret);

        $param = new \AntiPatternInc\Saasus\Sdk\Auth\Model\UpdateBasicInfoParam();
        $param->setDomainName("test.example.com");
        $ret = $apiClient->getAuthClient()->updateBasicInfo($param);
        var_dump("=====================UPDATE!================");
        var_dump($ret);

        $ret = $apiClient->getAuthClient()->getBasicInfo();
        var_dump("GET!");
        var_dump($ret);

        $ret = $apiClient->getAuthClient()->getEnvs();
        var_dump("GET ENVS!");
        var_dump($ret);

        $ret = $apiClient->getAuthClient()->getAuthInfo();
        var_dump("GET AUTH INFO!");
        var_dump($ret);

        $ret = $apiClient->getPricingClient()->getPricingPlans();
        var_dump("GET Pricing Plans!");
        var_dump($ret);

        $ret = $apiClient->getBllingClient()->getStripeInfo();
        var_dump("getStripeInfo!");
        var_dump($ret);

        $ret = $apiClient->getAuthClient()->getUserInfo(
            array(
                "token" => "eyJhbGciOiJSUzI1NiIsImtpZCI6ImNvZ25pdG8tZW11bGF0b3ItYXAtbm9ydGhlYXN0LTFfemZFckN6eGRRIiwidHlwIjoiSldUIn0.eyJhdWQiOiIyMzl2bGRiNTNqZzI1NmRoMnA5OXVsM2IyZiIsImF1dGhfdGltZSI6MTY2MzY3OTc2MywiY29nbml0bzp1c2VybmFtZSI6IjQxMmNiMmYzLTljOGItNDUxYS04ZTViLTZkMTFiMTdlMTg1NSIsImVtYWlsIjoic2FtcGxlc2Fhcy11c2VyLTFAZXhhbXBsZS5jb20iLCJlbWFpbF92ZXJpZmllZCI6dHJ1ZSwiZXZlbnRfaWQiOiI1MDMxYjFmOS03NzE0LTRhOGQtYmJkNC04MjNlNDcxNWU1N2MiLCJleHAiOjE2OTUyMTU3NjMsImlhdCI6MTY2MzY3OTc2MywiaXNzIjoiaHR0cDovL2NvZ25pdG86ODAvYXAtbm9ydGhlYXN0LTFfemZFckN6eGRRIiwic3ViIjoiNDEyY2IyZjMtOWM4Yi00NTFhLThlNWItNmQxMWIxN2UxODU1IiwidG9rZW5fdXNlIjoiaWQifQ.bXyFgO2WmQCZLtl9Mxd9XBFmIYlay-BnanSTyXQbXyrQ1UAHUMBJ_oKADQrvBM_TTVM5-kWa4Py-qj2abcw89bulNJONMeHeXukCApYkLrKp0_e2TCZnk4jPy8eveZktgK_MgO_VFFzu8m89CKR81Dc8kk2RqonLR3LXTdCpsYpPe4-bdxbGUswZ7KAX8HPKZB_0xfuBhgd1cn-IPdvEgeCGzwBVIu1QY-YHDY0Z7bgxNQxQF64dFEll_p6ac_M7IF02mzQDHZZfbgwmWq42U-hm0Z_tAzvUnTwLv9-rhdA4jPZSzYVDRV3IiFNZyLn6v-yyUM8JYPPRGOAwA20tmA",
            )
        );
        var_dump("============GET!===================");
        var_dump($ret);
    }
}

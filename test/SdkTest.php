<?php

namespace AntiPatternInc\Tests;

use PHPUnit\Framework\TestCase;
use AntiPatternInc\Saasus\Sdk\Lib;
use AntiPatternInc\Saasus\Sdk\Auth\Api;

use OpenAPI\Client\Configuration;
use OpenAPI\Client\Api\AuthInfoApi;
use GuzzleHttp\Client;
use Exception;

class SdkTest extends TestCase
{

    public function testLib(): void
    {
        //        Lib::curl();
    }

    public function testApi(): void
    {
        // export SAASUS_SAAS_ID="SAMPLEPayl9JcYAE4An4APP"
        // export SAASUS_API_KEY="cWPdQuTHLpcPGQi8ffw91tBjw7+R0Le1utI6hswURIA="
        // export SAASUS_API_URL_BASE="https://auth.api.dev.saasus.io"

        // 手動でtokenを追加する場合はこう書く
        $token = "eyJraWQiOiJKUGI0NXFNM1wvRTZNSlwvcEZMUXFNQ1FcL1wva2liaGtVSlRRRGZOVTBGOHVpVT0iLCJhbGciOiJSUzI1NiJ9.eyJzdWIiOiIyZDc2ZGFhZC0zNzhlLTRiYWMtODE2OC0yNmNlNTU3ODc5MGIiLCJlbWFpbF92ZXJpZmllZCI6dHJ1ZSwiaXNzIjoiaHR0cHM6XC9cL2NvZ25pdG8taWRwLmFwLW5vcnRoZWFzdC0xLmFtYXpvbmF3cy5jb21cL2FwLW5vcnRoZWFzdC0xXzZrZ3FIdHVUSyIsImNvZ25pdG86dXNlcm5hbWUiOiIyZDc2ZGFhZC0zNzhlLTRiYWMtODE2OC0yNmNlNTU3ODc5MGIiLCJvcmlnaW5fanRpIjoiNzAxOGU3ZTItOTNjNS00ZGI2LWI1OGEtZjlhNTZjZjdlODgyIiwiYXVkIjoiNnRxaDcwbmxxZGtnbGE4aW5iN3JyYTRkdm4iLCJldmVudF9pZCI6ImY4YzBmYjJmLWQ2YTAtNDFlZi04MjJlLTJkNTU0N2MzZDVlOSIsInRva2VuX3VzZSI6ImlkIiwiYXV0aF90aW1lIjoxNjU3NTA1OTk2LCJleHAiOjE2NTc1MDk1OTYsImlhdCI6MTY1NzUwNTk5NiwianRpIjoiZjMyZTZlZmUtNDk5OS00YTljLWJmOTItOGRjZDQxYTkzODNjIiwiZW1haWwiOiJ1c2VyMS0xQGV4YW1wbGUuY29tIn0.qIIH_dO54lEmM8lI4vwdQKA3ff-6HnTci_ua7aG-931T29o8yTItCIG27yKiXo_lRvg3rIJ313xSbrGL3MUz6lPe-yLxmbbiJYuq5kDjZaI3jSghQ3vrhfSf9YvIWCL9nJrtsy0iJnN_4yUzysuqYDEdZquYb1WveWfdg8Xsjt6vyPBTTgtiOxl6HTVpocTzUiiezgqVtyaDiIqt_C696exUZMjXCy-PlvQNIFL2xPOaZza77VfHcYW8xaWDmhLxoF1W8CQbUNCYMd44EwqUjtbRqFTFNalN5UnsDe1bDvyvZOegqJ3-xFW6RUgngRVDg3ICy39EoanFK4Czxtbg-w";
        $api = new Api($token);

        // ヘッダやcookieから勝手に取ってきて設定する場合は、tokenを省略する
        // $api = new Api();

        $ret = $api->putMeteringUnitDateCount("f88e71bd-ee57-4cd2-99bb-828421f54e43", "comment_count", 2);
        var_dump("putMeteringUnitDateCount:");
        var_dump($ret);

        $ret = $api->addMeteringUnitDateCount("f88e71bd-ee57-4cd2-99bb-828421f54e43", "comment_count", 1);
        var_dump("addMeteringUnitDateCount:");
        var_dump($ret);

        $ret = $api->getMeteringUnitDateCount("f88e71bd-ee57-4cd2-99bb-828421f54e43", "comment_count");
        var_dump("getMeteringUnitDateCount:");
        var_dump($ret);

        $ret = $api->getPricingPlan("1a3f7c32-b0e4-470a-871e-1d0a441a526e");
        var_dump("getPricingPlan:");
        var_dump($ret);

        $ret = Lib::findUpperCountByMeteringUnitName($ret, "comment_count");
        var_dump("findUpperCountByMeteringUnitName:");
        var_dump($ret);

        // // ユーザ一覧取得
        // $ret = $api->getUsers();
        // var_dump("getUsers:");
        // var_dump($ret);

        // // ユーザ一覧取得
        // $ret = $api->createUser("y+enplustest@anti-pattern.co.jp",  "@Anti#Pattern7");
        // var_dump("createUser y+enplustest@anti-pattern.co.jp @Anti#Pattern7");
        // var_dump($ret);

        // // ロールの作成(１回だけでOK)
        // $ret = $api->createRole("epconsul");
        // var_dump("createRole epconsul");
        // var_dump($ret);
        // $ret = $api->createRole("employee");
        // var_dump("createRole employee");
        // var_dump($ret);
        // $ret = $api->createRole("admin");
        // var_dump("createRole admin");
        // var_dump($ret);


        // // ほんとうはcreateUserでuuidが返ってくる予定だが、いまは返ってこないので
        // // 作成したユーザをメアドで検索してuuidをとる
        // // ユーザ一覧取得
        // $uuid = "";

        // $ret = $api->getUsers();
        // var_dump("getUsers:");
        // var_dump($ret);

        // foreach (json_decode($ret, true) as $value) {
        //     if ($value['email'] == "y+enplustest-2@anti-pattern.co.jp") {
        //         $uuid = $value['id'];
        //         break;
        //     }
        // }

        // // ロールの設定
        // $ret = $api->createUserRole($uuid, "employee", "従業員");
        // var_dump("createUserRole $uuid employee 従業員");
        // var_dump($ret);
    }
}

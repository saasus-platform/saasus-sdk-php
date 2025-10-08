# 単体テスト設計

## 概要

単体テストは、個々のクラスやメソッドが期待通りに動作することを確認するテストです。SaaSus SDK for PHPでは、コアライブラリ、Laravel統合機能、自動生成APIクライアントの3つのカテゴリに分けて単体テストを設計します。

## テスト対象コンポーネント分類

### A. コアライブラリ単体テスト

#### A-1. [`Client.php`](../../src/Api/Client.php) テスト

**テストクラス**: `ClientTest`

**テスト対象メソッド**:
- `__construct()`: 環境変数検証、クライアント初期化
- `createApiClient()`: HTTPクライアント設定
- `getXxxClient()`: 各APIクライアント取得メソッド（7種類）

**テストケース**:

##### 1. 正常系テスト
```php
/**
 * @test
 * 必要な環境変数が設定されている場合の正常初期化
 */
public function testConstructorWithValidEnvironmentVariables()
{
    // 環境変数設定
    putenv('SAASUS_SECRET_KEY=test_secret');
    putenv('SAASUS_SAAS_ID=test_saas_id');
    putenv('SAASUS_API_KEY=test_api_key');
    
    // クライアント初期化
    $client = new Client();
    
    // 各APIクライアントが正常に取得できることを確認
    $this->assertInstanceOf(Auth\Client::class, $client->getAuthClient());
    $this->assertInstanceOf(Pricing\Client::class, $client->getPricingClient());
    // ... 他のAPIクライアントも同様
}

/**
 * @test
 * デフォルトAPIベースURL設定の確認
 */
public function testDefaultApiBaseUrl()
{
    // SAASUS_API_URL_BASE未設定の場合
    putenv('SAASUS_API_URL_BASE=');
    
    $client = new Client();
    
    // デフォルトURL（https://api.saasus.io）が使用されることを確認
    // リフレクションを使用してprivateプロパティを検証
}

/**
 * @test
 * referer/xSaasusRefererパラメータの正常設定
 */
public function testRefererParameters()
{
    $referer = 'https://example.com';
    $xSaasusReferer = 'https://app.example.com';
    
    $client = new Client($referer, $xSaasusReferer);
    
    // パラメータが正常に設定されることを確認
    // ミドルウェアに正しく渡されることを確認
}
```

##### 2. 異常系テスト
```php
/**
 * @test
 * 必須環境変数未設定時の例外発生確認
 */
public function testConstructorThrowsExceptionWhenRequiredEnvVarsMissing()
{
    // 環境変数をクリア
    putenv('SAASUS_SECRET_KEY=');
    putenv('SAASUS_SAAS_ID=');
    putenv('SAASUS_API_KEY=');
    
    $this->expectException(Exception::class);
    $this->expectExceptionMessage('SAASUS_SECRET_KEY,SAASUS_SAAS_ID,SAASUS_API_KEY are required');
    
    new Client();
}

/**
 * @test
 * 複数環境変数未設定時のエラーメッセージ確認
 */
public function testConstructorErrorMessageWithMultipleMissingVars()
{
    // 一部の環境変数のみ設定
    putenv('SAASUS_SECRET_KEY=test_secret');
    putenv('SAASUS_SAAS_ID=');
    putenv('SAASUS_API_KEY=');
    
    $this->expectException(Exception::class);
    $this->expectExceptionMessage('SAASUS_SAAS_ID,SAASUS_API_KEY are required');
    
    new Client();
}
```

##### 3. 境界値テスト
```php
/**
 * @test
 * 空文字列の環境変数設定
 */
public function testConstructorWithEmptyStringEnvVars()
{
    putenv('SAASUS_SECRET_KEY= '); // スペースのみ
    putenv('SAASUS_SAAS_ID=test_saas_id');
    putenv('SAASUS_API_KEY=test_api_key');
    
    $this->expectException(Exception::class);
    
    new Client();
}

/**
 * @test
 * 非常に長いreferer/xSaasusRefererの処理
 */
public function testLongRefererParameters()
{
    $longReferer = str_repeat('a', 2048); // 2KB文字列
    $longXSaasusReferer = str_repeat('b', 2048);
    
    $client = new Client($longReferer, $longXSaasusReferer);
    
    // 正常に処理されることを確認
    $this->assertInstanceOf(Client::class, $client);
}
```

#### A-2. [`GuzzleMiddleware.php`](../../src/Api/GuzzleMiddleware.php) テスト

**テストクラス**: `GuzzleMiddlewareTest`

**テスト対象メソッド**:
- `__construct()`: ミドルウェア初期化
- `execute()`: リクエスト処理とヘッダー追加
- `getSignAsHeader()`: SAASUSSIGV1署名生成

**テストケース**:

##### 1. 署名生成テスト
```php
/**
 * @test
 * 正常なパラメータでの署名生成確認
 */
public function testGetSignAsHeaderWithValidParameters()
{
    $secret = 'test_secret';
    $apikey = 'test_api_key';
    $saasid = 'test_saas_id';
    $method = 'GET';
    $host = 'api.saasus.io';
    $path = '/v1/auth/userinfo';
    $query = '';
    $body = '';
    
    $header = GuzzleMiddleware::getSignAsHeader(
        $secret, $apikey, $saasid, $method, $host, $path, $query, $body
    );
    
    // 署名ヘッダーの形式確認
    $this->assertStringStartsWith('SAASUSSIGV1 Sig=', $header);
    $this->assertStringContains('SaaSID=test_saas_id', $header);
    $this->assertStringContains('APIKey=test_api_key', $header);
}

/**
 * @test
 * 異なるHTTPメソッドでの署名確認
 */
public function testGetSignAsHeaderWithDifferentMethods()
{
    $baseParams = [
        'test_secret', 'test_api_key', 'test_saas_id',
        'api.saasus.io', '/v1/auth/userinfo', '', ''
    ];
    
    $getMethods = ['GET', 'POST', 'PUT', 'DELETE'];
    $signatures = [];
    
    foreach ($getMethods as $method) {
        $params = array_merge([$method], $baseParams);
        $signatures[$method] = GuzzleMiddleware::getSignAsHeader(...$params);
    }
    
    // 各メソッドで異なる署名が生成されることを確認
    $this->assertNotEquals($signatures['GET'], $signatures['POST']);
    $this->assertNotEquals($signatures['GET'], $signatures['PUT']);
    $this->assertNotEquals($signatures['GET'], $signatures['DELETE']);
}

/**
 * @test
 * クエリパラメータ有無での署名差異確認
 */
public function testGetSignAsHeaderWithQueryParameters()
{
    $baseParams = [
        'test_secret', 'test_api_key', 'test_saas_id',
        'GET', 'api.saasus.io', '/v1/auth/userinfo', '', ''
    ];
    
    $signatureWithoutQuery = GuzzleMiddleware::getSignAsHeader(...$baseParams);
    
    $baseParams[6] = 'param1=value1&param2=value2'; // クエリパラメータ追加
    $signatureWithQuery = GuzzleMiddleware::getSignAsHeader(...$baseParams);
    
    // クエリパラメータの有無で署名が変わることを確認
    $this->assertNotEquals($signatureWithoutQuery, $signatureWithQuery);
}

/**
 * @test
 * 時刻変化による署名変化確認
 */
public function testGetSignAsHeaderTimeVariation()
{
    $params = [
        'test_secret', 'test_api_key', 'test_saas_id',
        'GET', 'api.saasus.io', '/v1/auth/userinfo', '', ''
    ];
    
    $signature1 = GuzzleMiddleware::getSignAsHeader(...$params);
    
    // 1分待機（実際のテストでは時刻をモック）
    sleep(61);
    
    $signature2 = GuzzleMiddleware::getSignAsHeader(...$params);
    
    // 時刻変化により署名が変わることを確認
    $this->assertNotEquals($signature1, $signature2);
}
```

##### 2. ヘッダー処理テスト
```php
/**
 * @test
 * Authorizationヘッダーの正常設定
 */
public function testExecuteAddsAuthorizationHeader()
{
    $middleware = new GuzzleMiddleware('secret', 'saasid', 'apikey');
    
    $request = $this->createMockRequest();
    $options = [];
    
    $handler = function($req, $opts) {
        // Authorizationヘッダーが追加されていることを確認
        $this->assertTrue($req->hasHeader('Authorization'));
        $authHeader = $req->getHeader('Authorization')[0];
        $this->assertStringStartsWith('SAASUSSIGV1', $authHeader);
        
        return new Response(200);
    };
    
    $callable = $middleware($handler);
    $callable($request, $options);
}

/**
 * @test
 * Refererヘッダーの条件付き設定
 */
public function testExecuteAddsRefererHeaderWhenProvided()
{
    $referer = 'https://example.com';
    $middleware = new GuzzleMiddleware('secret', 'saasid', 'apikey', $referer);
    
    $request = $this->createMockRequest();
    $options = [];
    
    $handler = function($req, $opts) use ($referer) {
        $this->assertTrue($req->hasHeader('Referer'));
        $this->assertEquals($referer, $req->getHeader('Referer')[0]);
        
        return new Response(200);
    };
    
    $callable = $middleware($handler);
    $callable($request, $options);
}

/**
 * @test
 * 空文字列パラメータ時のヘッダー未設定確認
 */
public function testExecuteDoesNotAddEmptyHeaders()
{
    $middleware = new GuzzleMiddleware('secret', 'saasid', 'apikey', '', '');
    
    $request = $this->createMockRequest();
    $options = [];
    
    $handler = function($req, $opts) {
        $this->assertFalse($req->hasHeader('Referer'));
        $this->assertFalse($req->hasHeader('x-saasus-referer'));
        
        return new Response(200);
    };
    
    $callable = $middleware($handler);
    $callable($request, $options);
}
```

##### 3. 異常系テスト
```php
/**
 * @test
 * 必須パラメータ未設定時の空文字列返却
 */
public function testGetSignAsHeaderReturnsEmptyStringWhenRequiredParamsMissing()
{
    // secret未設定
    $header = GuzzleMiddleware::getSignAsHeader(
        '', 'apikey', 'saasid', 'GET', 'host', '/path', '', ''
    );
    $this->assertEquals('', $header);
    
    // apikey未設定
    $header = GuzzleMiddleware::getSignAsHeader(
        'secret', '', 'saasid', 'GET', 'host', '/path', '', ''
    );
    $this->assertEquals('', $header);
    
    // saasid未設定
    $header = GuzzleMiddleware::getSignAsHeader(
        'secret', 'apikey', '', 'GET', 'host', '/path', '', ''
    );
    $this->assertEquals('', $header);
}

/**
 * @test
 * 不正なHTTPメソッド指定時の処理
 */
public function testGetSignAsHeaderWithInvalidMethod()
{
    $header = GuzzleMiddleware::getSignAsHeader(
        'secret', 'apikey', 'saasid', 'INVALID', 'host', '/path', '', ''
    );
    
    // 不正なメソッドでも署名は生成される（大文字変換される）
    $this->assertStringStartsWith('SAASUSSIGV1', $header);
}
```

#### A-3. [`Lib.php`](../../src/Api/Lib.php) テスト

**テストクラス**: `LibTest`

**テスト対象メソッド**:
- `findUpperCountByMeteringUnitName()`: メータリングユニット上限値検索

**テストケース**:

##### 1. 正常系テスト
```php
/**
 * @test
 * 存在するメータリングユニット名での正常検索
 */
public function testFindUpperCountByMeteringUnitNameWithValidUnit()
{
    $planResult = [
        'pricing_menus' => [
            [
                'units' => [
                    [
                        'metering_unit_name' => 'api_calls',
                        'upper_count' => 1000
                    ],
                    [
                        'metering_unit_name' => 'storage_gb',
                        'upper_count' => 100
                    ]
                ]
            ]
        ]
    ];
    
    $upperCount = Lib::findUpperCountByMeteringUnitName($planResult, 'api_calls');
    $this->assertEquals(1000, $upperCount);
    
    $upperCount = Lib::findUpperCountByMeteringUnitName($planResult, 'storage_gb');
    $this->assertEquals(100, $upperCount);
}

/**
 * @test
 * 複数メニュー・ユニット構造での正確な値取得
 */
public function testFindUpperCountWithMultipleMenusAndUnits()
{
    $planResult = [
        'pricing_menus' => [
            [
                'units' => [
                    ['metering_unit_name' => 'basic_calls', 'upper_count' => 500]
                ]
            ],
            [
                'units' => [
                    ['metering_unit_name' => 'premium_calls', 'upper_count' => 2000],
                    ['metering_unit_name' => 'storage_tb', 'upper_count' => 10]
                ]
            ]
        ]
    ];
    
    $upperCount = Lib::findUpperCountByMeteringUnitName($planResult, 'premium_calls');
    $this->assertEquals(2000, $upperCount);
}

/**
 * @test
 * 上限値0の場合の正常処理
 */
public function testFindUpperCountWithZeroValue()
{
    $planResult = [
        'pricing_menus' => [
            [
                'units' => [
                    ['metering_unit_name' => 'unlimited_feature', 'upper_count' => 0]
                ]
            ]
        ]
    ];
    
    $upperCount = Lib::findUpperCountByMeteringUnitName($planResult, 'unlimited_feature');
    $this->assertEquals(0, $upperCount);
}
```

##### 2. 異常系テスト
```php
/**
 * @test
 * 存在しないメータリングユニット名での0返却
 */
public function testFindUpperCountWithNonExistentUnit()
{
    $planResult = [
        'pricing_menus' => [
            [
                'units' => [
                    ['metering_unit_name' => 'api_calls', 'upper_count' => 1000]
                ]
            ]
        ]
    ];
    
    $upperCount = Lib::findUpperCountByMeteringUnitName($planResult, 'non_existent');
    $this->assertEquals(0, $upperCount);
}

/**
 * @test
 * 空の料金プラン配列での処理
 */
public function testFindUpperCountWithEmptyPricingMenus()
{
    $planResult = ['pricing_menus' => []];
    
    $upperCount = Lib::findUpperCountByMeteringUnitName($planResult, 'any_unit');
    $this->assertEquals(0, $upperCount);
}

/**
 * @test
 * null/不正な構造データでの処理
 */
public function testFindUpperCountWithInvalidStructure()
{
    // pricing_menusキーが存在しない
    $planResult = [];
    $upperCount = Lib::findUpperCountByMeteringUnitName($planResult, 'any_unit');
    $this->assertEquals(0, $upperCount);
    
    // unitsキーが存在しない
    $planResult = ['pricing_menus' => [['invalid_key' => 'value']]];
    $upperCount = Lib::findUpperCountByMeteringUnitName($planResult, 'any_unit');
    $this->assertEquals(0, $upperCount);
}
```

##### 3. 境界値テスト
```php
/**
 * @test
 * 非常に大きな上限値の処理
 */
public function testFindUpperCountWithLargeValue()
{
    $planResult = [
        'pricing_menus' => [
            [
                'units' => [
                    ['metering_unit_name' => 'enterprise_calls', 'upper_count' => PHP_INT_MAX]
                ]
            ]
        ]
    ];
    
    $upperCount = Lib::findUpperCountByMeteringUnitName($planResult, 'enterprise_calls');
    $this->assertEquals(PHP_INT_MAX, $upperCount);
}

/**
 * @test
 * 特殊文字を含むメータリングユニット名
 */
public function testFindUpperCountWithSpecialCharacters()
{
    $planResult = [
        'pricing_menus' => [
            [
                'units' => [
                    ['metering_unit_name' => 'api-calls_v2.0', 'upper_count' => 1500]
                ]
            ]
        ]
    ];
    
    $upperCount = Lib::findUpperCountByMeteringUnitName($planResult, 'api-calls_v2.0');
    $this->assertEquals(1500, $upperCount);
}
```

### B. Laravel統合機能単体テスト

#### B-1. [`Auth.php`](../../src/Laravel/Middleware/Auth.php) ミドルウェアテスト

**テストクラス**: `AuthMiddlewareTest`

**テスト対象メソッド**:
- `handle()`: 認証処理とリクエスト処理

**テストケース**:

##### 1. 認証成功パターン
```php
/**
 * @test
 * Bearerトークンでの正常認証
 */
public function testHandleWithValidBearerToken()
{
    $middleware = new Auth();
    $request = $this->createRequestWithBearerToken('valid_token');
    
    // APIクライアントのモック設定
    $this->mockApiClient('getUserInfo', ['valid_user_info']);
    
    $response = $middleware->handle($request, function($req) {
        // ユーザー情報がリクエストに注入されていることを確認
        $this->assertArrayHasKey('userinfo', $req->all());
        return response('success');
    });
    
    $this->assertEquals('success', $response->getContent());
}

/**
 * @test
 * Cookieトークンでの正常認証
 */
public function testHandleWithValidCookieToken()
{
    $middleware = new Auth();
    $request = $this->createRequestWithCookie('SaaSus_idToken', 'valid_token');
    
    $this->mockApiClient('getUserInfo', ['valid_user_info']);
    
    $response = $middleware->handle($request, function($req) {
        $this->assertArrayHasKey('userinfo', $req->all());
        return response('success');
    });
    
    $this->assertEquals('success', $response->getContent());
}
```

##### 2. 認証失敗パターン
```php
/**
 * @test
 * トークン未提供時のWebモードリダイレクト
 */
public function testHandleWithoutTokenInWebMode()
{
    putenv('SAASUS_AUTH_MODE=web');
    putenv('SAASUS_LOGIN_URL=https://auth.example.com');
    
    $middleware = new Auth();
    $request = $this->createRequestWithoutToken();
    
    $response = $middleware->handle($request, function($req) {
        $this->fail('Should not reach next middleware');
    });
    
    $this->assertInstanceOf(RedirectResponse::class, $response);
    $this->assertEquals('https://auth.example.com', $response->getTargetUrl());
}

/**
 * @test
 * トークン未提供時のAPIモードJSON応答
 */
public function testHandleWithoutTokenInApiMode()
{
    putenv('SAASUS_AUTH_MODE=api');
    
    $middleware = new Auth();
    $request = $this->createRequestWithoutToken();
    
    $response = $middleware->handle($request, function($req) {
        $this->fail('Should not reach next middleware');
    });
    
    $this->assertEquals(401, $response->getStatusCode());
    $this->assertEquals('Invalid ID Token.', $response->getContent());
}

/**
 * @test
 * 無効トークン時の適切なエラー応答
 */
public function testHandleWithInvalidToken()
{
    $middleware = new Auth();
    $request = $this->createRequestWithBearerToken('invalid_token');
    
    // 401エラーを返すAPIクライアントのモック
    $this->mockApiClientWithException(new HttpException(
        'Unauthorized', 401, null, ['type' => 'UNAUTHORIZED', 'message' => 'Invalid token']
    ));
    
    $response = $middleware->handle($request, function($req) {
        $this->fail('Should not reach next middleware');
    });
    
    $this->assertEquals(401, $response->getStatusCode());
}
```

##### 3. ヘッダー処理テスト
```php
/**
 * @test
 * refererヘッダーの正常取得と処理
 */
public function testHandleWithRefererHeader()
{
    $middleware = new Auth();
    $request = $this->createRequestWithBearerToken('valid_token');
    $request->headers->set('referer', 'https://example.com');
    
    // ApiClientが正しいrefererで初期化されることを確認
    $this->mockApiClientConstructor('https://example.com', '');
    $this->mockApiClient('getUserInfo', ['valid_user_info']);
    
    $middleware->handle($request, function($req) {
        return response('success');
    });
}

/**
 * @test
 * x-saasus-refererヘッダーの正常取得と処理
 */
public function testHandleWithXSaasusRefererHeader()
{
    $middleware = new Auth();
    $request = $this->createRequestWithBearerToken('valid_token');
    $request->headers->set('x-saasus-referer', 'https://app.example.com');
    
    $this->mockApiClientConstructor('', 'https://app.example.com');
    $this->mockApiClient('getUserInfo', ['valid_user_info']);
    
    $middleware->handle($request, function($req) {
        return response('success');
    });
}
```

#### B-2. コントローラー単体テスト

##### B-2-1. [`CallbackController.php`](../../src/Laravel/Controllers/CallbackController.php)

**テストクラス**: `CallbackControllerTest`

**テストケース**:
```php
/**
 * @test
 * 正常なcodeパラメータでの認証成功
 */
public function testIndexWithValidCode()
{
    $controller = new CallbackController();
    $request = $this->createRequestWithCode('valid_auth_code');
    
    // 認証成功のAPIレスポンスをモック
    $this->mockApiClient('getAuthCredentials', [
        'getIdToken' => 'valid_id_token'
    ]);
    
    $response = $controller->index($request);
    
    // ビューが返されることを確認
    $this->assertInstanceOf(View::class, $response);
    $this->assertEquals('saasus_default_callback', $response->getName());
    
    // Cookieが設定されることを確認
    $this->assertArrayHasKey('SaaSus_idToken', $_COOKIE);
}

/**
 * @test
 * codeパラメータ未提供時のリダイレクト
 */
public function testIndexWithoutCode()
{
    putenv('SAASUS_LOGIN_URL=https://auth.example.com');
    
    $controller = new CallbackController();
    $request = $this->createRequestWithoutCode();
    
    $response = $controller->index($request);
    
    $this->assertInstanceOf(RedirectResponse::class, $response);
    $this->assertEquals('https://auth.example.com', $response->getTargetUrl());
}
```

##### B-2-2. [`CallbackApiController.php`](../../src/Laravel/Controllers/CallbackApiController.php)

**テストクラス**: `CallbackApiControllerTest`

**テストケース**:
```php
/**
 * @test
 * 正常なcodeパラメータでのJSON応答
 */
public function testIndexWithValidCodeReturnsJson()
{
    $controller = new CallbackApiController();
    $request = $this->createRequestWithCode('valid_auth_code');
    
    $mockResponse = [
        'id_token' => 'valid_id_token',
        'access_token' => 'valid_access_token',
        'refresh_token' => 'valid_refresh_token'
    ];
    
    $this->mockApiClient('getAuthCredentials', $mockResponse);
    
    $response = $controller->index($request);
    
    $this->assertEquals(200, $response->getStatusCode());
    $this->assertEquals($mockResponse, json_decode($response->getContent(), true));
}

/**
 * @test
 * リフレッシュトークンCookie設定確認
 */
public function testIndexSetsRefreshTokenCookie()
{
    $controller = new CallbackApiController();
    $request = $this->createRequestWithCode('valid_auth_code');
    
    $mockResponse = [
        'id_token' => 'valid_id_token',
        'refresh_token' => 'valid_refresh_token'
    ];
    
    $this->mockApiClient('getAuthCredentials', $mockResponse);
    
    $controller->index($request);
    
    // リフレッシュトークンCookieが設定されることを確認
    $this->assertArrayHasKey('saasus_refresh_token', $_COOKIE);
    $this->assertEquals('valid_refresh_token', $_COOKIE['saasus_refresh_token']);
}
```

##### B-2-3. [`TokenRefreshApiController.php`](../../src/Laravel/Controllers/TokenRefreshApiController.php)

**テストクラス**: `TokenRefreshApiControllerTest`

**テストケース**:
```php
/**
 * @test
 * 正常なリフレッシュトークンでのトークン更新
 */
public function testIndexWithValidRefreshToken()
{
    $controller = new TokenRefreshApiController();
    $request = $this->createRequestWithRefreshTokenCookie('valid_refresh_token');
    
    $mockResponse = [
        'id_token' => 'new_id_token',
        'access_token' => 'new_access_token'
    ];
    
    $this->mockApiClient('getAuthCredentials', $mockResponse);
    
    $response = $controller->index($request);
    
    $this->assertEquals(200, $response->getStatusCode());
    $this->assertEquals($mockResponse, json_decode($response->getContent(), true));
}

/**
 * @test
 * リフレッシュトークンCookie未提供時のBadRequest応答
 */
public function testIndexWithoutRefreshTokenCookie()
{
    $controller = new TokenRefreshApiController();
    $request = $this->createRequestWithoutRefreshTokenCookie();
    
    $response = $controller->index($request);
    
    $this->assertEquals(400, $response->getStatusCode());
    $this->assertEquals('saasus_refresh_token cookie is required', $response->getContent());
}
```

### C. 自動生成APIクライアント単体テスト

**テスト方針**:
自動生成コードのため、主要なエンドポイントのみをサンプルテストとして実装

**テストクラス**: `GeneratedApiClientTest`

**テスト対象**:
- [`Auth\Client`](../../generated/Auth/Client.php) の主要メソッド
- [`Pricing\Client`](../../generated/Pricing/Client.php) の主要メソッド
- 他のAPIクライアントの代表的なメソッド

**テストケース**:
```php
/**
 * @test
 * Auth\Client getUserInfo メソッドの正常呼び出し
 */
public function testAuthClientGet
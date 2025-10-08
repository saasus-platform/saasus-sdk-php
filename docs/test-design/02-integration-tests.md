# 結合テスト設計

## 概要

結合テストは、複数のコンポーネント間の連携動作を確認するテストです。SaaSus SDK for PHPでは、コンポーネント間結合テスト、外部システム結合テスト、エンドツーエンド（E2E）テストの3つのレベルで結合テストを実施します。

## 結合テストレベル分類

### A. コンポーネント間結合テスト

#### A-1. Client + GuzzleMiddleware 結合テスト

**テストクラス**: `ClientMiddlewareIntegrationTest`

**テスト内容**:
- [`Client`](../../src/Api/Client.php)初期化時の[`GuzzleMiddleware`](../../src/Api/GuzzleMiddleware.php)正常設定確認
- 実際のHTTPリクエスト送信時の署名ヘッダー確認
- 複数APIクライアント間での一貫した認証処理確認

**テストケース**:

##### 1. 認証フロー統合テスト
```php
/**
 * @test
 * Client初期化からAPI呼び出しまでの一連の流れ
 */
public function testClientInitializationToApiCall()
{
    // 環境変数設定
    putenv('SAASUS_SECRET_KEY=test_secret');
    putenv('SAASUS_SAAS_ID=test_saas_id');
    putenv('SAASUS_API_KEY=test_api_key');
    putenv('SAASUS_API_URL_BASE=https://api-test.saasus.io');
    
    // Clientインスタンス作成
    $client = new Client();
    
    // HTTPクライアントのモック設定（実際のリクエストをキャプチャ）
    $httpMock = new MockHandler([
        new Response(200, [], json_encode(['user_id' => 'test_user']))
    ]);
    $handlerStack = HandlerStack::create($httpMock);
    
    // リクエストをキャプチャするミドルウェア
    $container = [];
    $history = Middleware::history($container);
    $handlerStack->push($history);
    
    // GuzzleClientを差し替え
    $this->replaceGuzzleClient($client, $handlerStack);
    
    // API呼び出し実行
    $authClient = $client->getAuthClient();
    $result = $authClient->getUserInfo(['token' => 'test_token']);
    
    // リクエストが正しく送信されたことを確認
    $this->assertCount(1, $container);
    $request = $container[0]['request'];
    
    // 署名ヘッダーが正しく設定されていることを確認
    $this->assertTrue($request->hasHeader('Authorization'));
    $authHeader = $request->getHeader('Authorization')[0];
    $this->assertStringStartsWith('SAASUSSIGV1 Sig=', $authHeader);
    $this->assertStringContains('SaaSID=test_saas_id', $authHeader);
    $this->assertStringContains('APIKey=test_api_key', $authHeader);
    
    // レスポンスが正しく処理されることを確認
    $this->assertEquals('test_user', $result['user_id']);
}

/**
 * @test
 * 複数APIクライアント間での一貫した認証処理確認
 */
public function testConsistentAuthenticationAcrossApiClients()
{
    $client = new Client();
    
    // 複数のAPIクライアントで同じ認証情報が使用されることを確認
    $authClient = $client->getAuthClient();
    $pricingClient = $client->getPricingClient();
    $billingClient = $client->getBllingClient();
    
    // 各クライアントのHTTPクライアントが同じミドルウェアを使用していることを確認
    $this->assertSameMiddleware($authClient, $pricingClient);
    $this->assertSameMiddleware($authClient, $billingClient);
}

/**
 * @test
 * referer/xSaasusRefererパラメータの統合確認
 */
public function testRefererParametersIntegration()
{
    $referer = 'https://example.com';
    $xSaasusReferer = 'https://app.example.com';
    
    $client = new Client($referer, $xSaasusReferer);
    
    // HTTPリクエストキャプチャ設定
    $container = [];
    $this->setupRequestCapture($client, $container);
    
    // API呼び出し実行
    $client->getAuthClient()->getUserInfo(['token' => 'test_token']);
    
    // refererヘッダーが正しく設定されていることを確認
    $request = $container[0]['request'];
    $this->assertTrue($request->hasHeader('Referer'));
    $this->assertEquals($referer, $request->getHeader('Referer')[0]);
    $this->assertTrue($request->hasHeader('x-saasus-referer'));
    $this->assertEquals($xSaasusReferer, $request->getHeader('x-saasus-referer')[0]);
}
```

##### 2. エラーハンドリング統合テスト
```php
/**
 * @test
 * 認証失敗時の適切なエラー伝播
 */
public function testAuthenticationFailureErrorPropagation()
{
    $client = new Client();
    
    // 401エラーレスポンスのモック設定
    $httpMock = new MockHandler([
        new Response(401, [], json_encode([
            'type' => 'UNAUTHORIZED',
            'message' => 'Invalid API credentials'
        ]))
    ]);
    $this->replaceGuzzleClient($client, HandlerStack::create($httpMock));
    
    // 認証エラーが適切に伝播されることを確認
    $this->expectException(HttpException::class);
    
    $authClient = $client->getAuthClient();
    $authClient->getUserInfo(['token' => 'invalid_token']);
}

/**
 * @test
 * ネットワークエラー時の例外処理
 */
public function testNetworkErrorHandling()
{
    $client = new Client();
    
    // ネットワークエラーのモック設定
    $httpMock = new MockHandler([
        new ConnectException('Connection timeout', new Request('GET', '/'))
    ]);
    $this->replaceGuzzleClient($client, HandlerStack::create($httpMock));
    
    $this->expectException(ConnectException::class);
    $this->expectExceptionMessage('Connection timeout');
    
    $authClient = $client->getAuthClient();
    $authClient->getUserInfo(['token' => 'test_token']);
}
```

#### A-2. Laravel統合機能結合テスト

**テストクラス**: `LaravelIntegrationTest`

**テスト内容**:
- ミドルウェア + コントローラーの連携動作確認
- 認証フロー全体の動作確認
- Cookie設定とセッション管理の確認

**テストケース**:

##### 1. Web認証フロー統合テスト
```php
/**
 * @test
 * 未認証アクセスからログイン完了までの完全フロー
 */
public function testCompleteWebAuthenticationFlow()
{
    // Laravel テストケース設定
    $this->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class]);
    
    // 1. 未認証状態でのアクセス
    putenv('SAASUS_AUTH_MODE=web');
    putenv('SAASUS_LOGIN_URL=https://auth.example.com');
    
    $response = $this->get('/protected-route');
    
    // ログインページへのリダイレクト確認
    $response->assertRedirect('https://auth.example.com');
    
    // 2. OAuth認証後のコールバック処理
    $this->mockApiClient('getAuthCredentials', [
        'getIdToken' => 'valid_id_token'
    ]);
    
    $callbackResponse = $this->get('/callback?code=auth_code_123');
    
    // コールバック処理成功確認
    $callbackResponse->assertStatus(200);
    $callbackResponse->assertViewIs('saasus_default_callback');
    
    // Cookie設定確認
    $callbackResponse->assertCookie('SaaSus_idToken', 'valid_id_token');
    
    // 3. 認証済み状態でのアクセス
    $this->mockApiClient('getUserInfo', [
        'user_id' => 'test_user',
        'email' => 'test@example.com'
    ]);
    
    $protectedResponse = $this->withCookie('SaaSus_idToken', 'valid_id_token')
                              ->get('/protected-route');
    
    // 認証済みアクセス成功確認
    $protectedResponse->assertStatus(200);
}

/**
 * @test
 * ミドルウェアとコントローラーの連携確認
 */
public function testMiddlewareControllerIntegration()
{
    // 認証ミドルウェアが適用されたルートの設定
    Route::middleware(Auth::class)->get('/test-route', function (Request $request) {
        return response()->json([
            'user_info' => $request->get('userinfo'),
            'authenticated' => true
        ]);
    });
    
    // 有効なトークンでのアクセス
    $this->mockApiClient('getUserInfo', [
        'user_id' => 'test_user',
        'email' => 'test@example.com',
        'tenants' => ['tenant1']
    ]);
    
    $response = $this->withHeader('Authorization', 'Bearer valid_token')
                     ->get('/test-route');
    
    $response->assertStatus(200);
    $responseData = $response->json();
    
    // ユーザー情報がリクエストに注入されていることを確認
    $this->assertArrayHasKey('user_info', $responseData);
    $this->assertEquals('test_user', $responseData['user_info']['user_id']);
    $this->assertTrue($responseData['authenticated']);
}
```

##### 2. API認証フロー統合テスト
```php
/**
 * @test
 * API認証フローの完全テスト
 */
public function testCompleteApiAuthenticationFlow()
{
    putenv('SAASUS_AUTH_MODE=api');
    
    // 1. 認証コード取得（コールバック処理）
    $this->mockApiClient('getAuthCredentials', [
        'id_token' => 'new_id_token',
        'access_token' => 'new_access_token',
        'refresh_token' => 'new_refresh_token'
    ]);
    
    $callbackResponse = $this->get('/api/callback?code=auth_code_123');
    
    $callbackResponse->assertStatus(200);
    $callbackData = $callbackResponse->json();
    
    $this->assertEquals('new_id_token', $callbackData['id_token']);
    $this->assertEquals('new_access_token', $callbackData['access_token']);
    
    // リフレッシュトークンCookie設定確認
    $callbackResponse->assertCookie('saasus_refresh_token', 'new_refresh_token');
    
    // 2. API呼び出し（Bearer認証）
    $this->mockApiClient('getUserInfo', [
        'user_id' => 'api_user',
        'email' => 'api@example.com'
    ]);
    
    $apiResponse = $this->withHeader('Authorization', 'Bearer new_id_token')
                        ->get('/api/user-info');
    
    $apiResponse->assertStatus(200);
    
    // 3. トークンリフレッシュ
    $this->mockApiClient('getAuthCredentials', [
        'id_token' => 'refreshed_id_token',
        'access_token' => 'refreshed_access_token'
    ]);
    
    $refreshResponse = $this->withCookie('saasus_refresh_token', 'new_refresh_token')
                            ->post('/api/token/refresh');
    
    $refreshResponse->assertStatus(200);
    $refreshData = $refreshResponse->json();
    
    $this->assertEquals('refreshed_id_token', $refreshData['id_token']);
    $this->assertEquals('refreshed_access_token', $refreshData['access_token']);
}
```

### B. 外部システム結合テスト

#### B-1. SaaSus Platform API結合テスト

**テストクラス**: `SaasusPlatformIntegrationTest`

**テスト内容**:
- 実際のSaaSus Platform APIとの通信確認
- 各APIモジュールの基本動作確認
- エラーレスポンスの適切な処理確認

**注意**: 実際のAPI呼び出しを行うため、テスト環境の準備が必要

**テストケース**:

##### 1. Auth API結合テスト
```php
/**
 * @test
 * ユーザー情報取得API結合テスト
 * @group external-api
 */
public function testAuthApiGetUserInfo()
{
    // テスト環境のAPIクライアント作成
    $client = $this->createTestApiClient();
    $authClient = $client->getAuthClient();
    
    // テスト用の有効なIDトークンを使用
    $testToken = $this->getTestIdToken();
    
    try {
        $userInfo = $authClient->getUserInfo(['token' => $testToken]);
        
        // レスポンス構造の確認
        $this->assertArrayHasKey('id', $userInfo);
        $this->assertArrayHasKey('email', $userInfo);
        $this->assertArrayHasKey('tenants', $userInfo);
        
        // データ型の確認
        $this->assertIsString($userInfo['id']);
        $this->assertIsString($userInfo['email']);
        $this->assertIsArray($userInfo['tenants']);
        
    } catch (HttpException $e) {
        // テスト環境の問題の場合はスキップ
        if ($e->getResponse()->getStatusCode() === 503) {
            $this->markTestSkipped('Test environment unavailable');
        }
        throw $e;
    }
}

/**
 * @test
 * テナント管理API結合テスト
 * @group external-api
 */
public function testAuthApiTenantManagement()
{
    $client = $this->createTestApiClient();
    $authClient = $client->getAuthClient();
    
    // 1. テナント一覧取得
    $tenants = $authClient->getTenants();
    $this->assertIsArray($tenants);
    
    $initialTenantCount = count($tenants);
    
    // 2. テナント作成
    $newTenantData = [
        'name' => 'Integration Test Tenant ' . time(),
        'back_office_staff_email' => 'test@example.com'
    ];
    
    $createdTenant = $authClient->createTenant($newTenantData);
    $this->assertArrayHasKey('id', $createdTenant);
    $this->assertEquals($newTenantData['name'], $createdTenant['name']);
    
    $tenantId = $createdTenant['id'];
    
    // 3. テナント取得
    $retrievedTenant = $authClient->getTenant($tenantId);
    $this->assertEquals($tenantId, $retrievedTenant['id']);
    $this->assertEquals($newTenantData['name'], $retrievedTenant['name']);
    
    // 4. テナント更新
    $updateData = ['name' => 'Updated Test Tenant ' . time()];
    $updatedTenant = $authClient->updateTenant($tenantId, $updateData);
    $this->assertEquals($updateData['name'], $updatedTenant['name']);
    
    // 5. テナント削除
    $authClient->deleteTenant($tenantId);
    
    // 削除確認
    $finalTenants = $authClient->getTenants();
    $this->assertCount($initialTenantCount, $finalTenants);
}
```

##### 2. Pricing API結合テスト
```php
/**
 * @test
 * 料金プラン管理API結合テスト
 * @group external-api
 */
public function testPricingApiPlanManagement()
{
    $client = $this->createTestApiClient();
    $pricingClient = $client->getPricingClient();
    
    // 1. 料金プラン一覧取得
    $plans = $pricingClient->getPricingPlans();
    $this->assertIsArray($plans);
    
    // 2. 料金ユニット作成
    $unitData = [
        'unit_name' => 'test_unit_' . time(),
        'display_name' => 'Test Unit',
        'unit_type' => 'quantity'
    ];
    
    $createdUnit = $pricingClient->createPricingUnit($unitData);
    $this->assertEquals($unitData['unit_name'], $createdUnit['unit_name']);
    
    // 3. 料金プラン作成
    $planData = [
        'plan_name' => 'test_plan_' . time(),
        'display_name' => 'Test Plan',
        'description' => 'Integration test plan'
    ];
    
    $createdPlan = $pricingClient->createPricingPlan($planData);
    $this->assertEquals($planData['plan_name'], $createdPlan['plan_name']);
    
    // クリーンアップ
    $pricingClient->deletePricingPlan($createdPlan['plan_id']);
    $pricingClient->deletePricingUnit($createdUnit['unit_id']);
}

/**
 * @test
 * メータリング機能結合テスト
 * @group external-api
 */
public function testPricingApiMetering()
{
    $client = $this->createTestApiClient();
    $pricingClient = $client->getPricingClient();
    
    // テスト用メータリングユニット作成
    $meteringUnitData = [
        'unit_name' => 'test_metering_' . time(),
        'display_name' => 'Test Metering Unit'
    ];
    
    $meteringUnit = $pricingClient->createMeteringUnit($meteringUnitData);
    $unitName = $meteringUnit['unit_name'];
    
    // メータリング値更新
    $tenantId = $this->getTestTenantId();
    $updateData = [
        'count' => 100,
        'timestamp' => time()
    ];
    
    $pricingClient->updateMeteringUnitTimestampCount(
        $tenantId, $unitName, $updateData
    );
    
    // メータリング値取得確認
    $todayCount = $pricingClient->getMeteringUnitDateCountByTenantIdAndUnitNameToday(
        $tenantId, $unitName
    );
    
    $this->assertGreaterThanOrEqual(100, $todayCount['count']);
    
    // クリーンアップ
    $pricingClient->deleteMeteringUnitByID($meteringUnit['unit_id']);
}
```

#### B-2. Laravel Framework結合テスト

**テストクラス**: `LaravelFrameworkIntegrationTest`

**テスト内容**:
- Laravel各バージョン（9.x-11.x）での動作確認
- Laravelの機能（ルーティング、ミドルウェア、ビュー）との統合確認

**テストケース**:

##### 1. ルーティング統合テスト
```php
/**
 * @test
 * ミドルウェア適用ルートでの正常動作
 */
public function testRoutingWithMiddleware()
{
    // ルート定義
    Route::middleware([Auth::class])->group(function () {
        Route::get('/dashboard', function (Request $request) {
            return view('dashboard', ['user' => $request->get('userinfo')]);
        });
        
        Route::get('/api/profile', function (Request $request) {
            return response()->json($request->get('userinfo'));
        });
    });
    
    // 認証済みアクセステスト
    $this->mockApiClient('getUserInfo', [
        'user_id' => 'test_user',
        'email' => 'test@example.com'
    ]);
    
    $response = $this->withHeader('Authorization', 'Bearer valid_token')
                     ->get('/dashboard');
    
    $response->assertStatus(200);
    $response->assertViewIs('dashboard');
    $response->assertViewHas('user');
    
    // API エンドポイントテスト
    $apiResponse = $this->withHeader('Authorization', 'Bearer valid_token')
                        ->get('/api/profile');
    
    $apiResponse->assertStatus(200);
    $apiResponse->assertJson(['user_id' => 'test_user']);
}

/**
 * @test
 * 認証不要ルートでの正常動作
 */
public function testPublicRoutes()
{
    Route::get('/public', function () {
        return response('Public content');
    });
    
    $response = $this->get('/public');
    $response->assertStatus(200);
    $response->assertSeeText('Public content');
}
```

##### 2. ビュー統合テスト
```php
/**
 * @test
 * Bladeテンプレートの正常レンダリング
 */
public function testBladeTemplateRendering()
{
    // テスト用ビューファイル作成
    $viewContent = '
        @extends("layouts.app")
        @section("content")
            <h1>Welcome {{ $user["email"] }}</h1>
            <p>Tenants: {{ count($user["tenants"]) }}</p>
        @endsection
    ';
    
    $this->createTestView('test-user-dashboard', $viewContent);
    
    // ビューレンダリングテスト
    $userData = [
        'email' => 'test@example.com',
        'tenants' => ['tenant1', 'tenant2']
    ];
    
    $view = view('test-user-dashboard', ['user' => $userData]);
    $rendered = $view->render();
    
    $this->assertStringContains('Welcome test@example.com', $rendered);
    $this->assertStringContains('Tenants: 2', $rendered);
}

/**
 * @test
 * 認証情報の適切な表示
 */
public function testAuthenticationInfoDisplay()
{
    Route::middleware([Auth::class])->get('/user-info', function (Request $request) {
        return view('user-info', ['userinfo' => $request->get('userinfo')]);
    });
    
    $this->mockApiClient('getUserInfo', [
        'user_id' => 'display_test_user',
        'email' => 'display@example.com',
        'tenants' => [
            ['id' => 'tenant1', 'name' => 'Tenant One'],
            ['id' => 'tenant2', 'name' => 'Tenant Two']
        ]
    ]);
    
    $response = $this->withHeader('Authorization', 'Bearer valid_token')
                     ->get('/user-info');
    
    $response->assertStatus(200);
    $response->assertSeeText('display@example.com');
    $response->assertSeeText('Tenant One');
    $response->assertSeeText('Tenant Two');
}
```

### C. エンドツーエンド（E2E）テスト

#### E2E-1. 完全な認証フローテスト

**テストクラス**: `AuthenticationE2ETest`

**テスト内容**:
- ユーザー登録からログイン、API利用までの完全フロー

**テストシナリオ**:

##### 1. Web認証フロー E2E テスト
```php
/**
 * @test
 * Web認証の完全フロー
 * @group e2e
 */
public function testCompleteWebAuthenticationFlow()
{
    // 1. 未認証状態でのアクセス
    $response = $this->get('/dashboard');
    $response->assertRedirect(); // ログインページへのリダイレクト
    
    // 2. ログインページアクセス（外部サービス）
    // 実際のテストでは、ブラウザ自動化ツール（Selenium等）を使用
    
    // 3. OAuth認証完了後のコールバック
    $this->mockExternalAuthService();
    
    $callbackResponse = $this->get('/callback?code=e2e_auth_code');
    $callbackResponse->assertStatus(200);
    $callbackResponse->assertCookie('SaaSus_idToken');
    
    // 4. 認証済み状態でのダッシュボードアクセス
    $this->mockApiClient('getUserInfo', [
        'user_id' => 'e2e_user',
        'email' => 'e2e@example.com',
        'tenants' => [
            ['id' => 'e2e_tenant', 'name' => 'E2E Test Tenant']
        ]
    ]);
    
    $dashboardResponse = $this->get('/dashboard');
    $dashboardResponse->assertStatus(200);
    $dashboardResponse->assertSeeText('e2e@example.com');
    $dashboardResponse->assertSeeText('E2E Test Tenant');
    
    // 5. API利用
    $apiResponse = $this->get('/api/user-profile');
    $apiResponse->assertStatus(200);
    $apiResponse->assertJson(['user_id' => 'e2e_user']);
    
    // 6. ログアウト
    $logoutResponse = $this->post('/logout');
    $logoutResponse->assertRedirect('/');
    $logoutResponse->assertCookieExpired('SaaSus_idToken');
}
```

##### 2. API認証フロー E2E テスト
```php
/**
 * @test
 * API認証の完全フロー
 * @group e2e
 */
public function testCompleteApiAuthenticationFlow()
{
    // 1. 認証コード取得
    $this->mockExternalAuthService();
    
    $authResponse = $this->get('/api/auth/callback?code=e2e_api_code');
    $authResponse->assertStatus(200);
    
    $authData = $authResponse->json();
    $idToken = $authData['id_token'];
    $refreshToken = $authData['refresh_token'];
    
    // 2. API呼び出し（Bearer認証）
    $this->mockApiClient('getUserInfo', [
        'user_id' => 'e2e_api_user',
        'email' => 'e2e-api@example.com'
    ]);
    
    $userResponse = $this->withHeader('Authorization', 'Bearer ' . $idToken)
                         ->get('/api/user');
    
    $userResponse->assertStatus(200);
    $userResponse->assertJson(['user_id' => 'e2e_api_user']);
    
    // 3. トークンリフレッシュ
    $this->mockApiClient('getAuthCredentials', [
        'id_token' => 'refreshed_e2e_token',
        'access_token' => 'refreshed_e2e_access'
    ]);
    
    $refreshResponse = $this->withCookie('saasus_refresh_token', $refreshToken)
                            ->post('/api/token/refresh');
    
    $refreshResponse->assertStatus(200);
    $refreshData = $refreshResponse->json();
    
    // 4. 新しいトークンでのAPI利用
    $newUserResponse = $this->withHeader('Authorization', 'Bearer ' . $refreshData['id_token'])
                            ->get('/api/user');
    
    $newUserResponse->assertStatus(200);
}
```

#### E2E-2. マルチテナント機能テスト

**テストクラス**: `MultiTenantE2ETest`

**テスト内容**:
- マルチテナント環境での完全な動作確認

**テストシナリオ**:

##### 1. テナント管理フロー E2E テスト
```php
/**
 * @test
 * テナント管理の完全フロー
 * @group e2e
 */
public function testCompleteMultiTenantFlow()
{
    // 管理者として認証
    $this->authenticateAsAdmin();
    
    // 1. テナント作成
    $tenantData = [
        'name' => 'E2E Test Company',
        'back_office_staff_email' => 'admin@e2e-test.com'
    ];
    
    $createResponse = $this->post('/admin/tenants', $tenantData);
    $createResponse->assertStatus(201);
    
    $tenantId = $createResponse->json()['id'];
    
    // 2. ユーザーのテナント割り当て
    $userAssignData = [
        'user_email' => 'user@e2e-test.com',
        'role' => 'member'
    ];
    
    $assignResponse = $this->post("/admin/tenants/{$tenantId}/users", $userAssignData);
    $assignResponse->assertStatus(200);
    
    // 3. テナントユーザーとしてログイン
    $this->authenticateAsTenantUser('user@e2e-test.com', $tenantId);
    
    // 4. テナント固有の設定確認
    $settingsResponse = $this->get('/tenant/settings');
    $settingsResponse->assertStatus(200);
    $settingsResponse->assertJson(['tenant_id' => $tenantId]);
    
    // 5. テナント間のデータ分離確認
    $dataResponse =
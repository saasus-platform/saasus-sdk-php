# 単体テスト設計（続き）

## C. 自動生成APIクライアント単体テスト（続き）

**テストケース**:
```php
/**
 * @test
 * Auth\Client getUserInfo メソッドの正常呼び出し
 */
public function testAuthClientGetUserInfo()
{
    $client = $this->createMockAuthClient();
    
    $mockUserInfo = [
        'id' => 'user123',
        'email' => 'test@example.com',
        'tenants' => ['tenant1', 'tenant2']
    ];
    
    $client->method('getUserInfo')
           ->willReturn($mockUserInfo);
    
    $result = $client->getUserInfo(['token' => 'valid_token']);
    
    $this->assertEquals($mockUserInfo, $result);
    $this->assertArrayHasKey('id', $result);
    $this->assertArrayHasKey('email', $result);
}

/**
 * @test
 * Pricing\Client getPricingPlans メソッドの正常呼び出し
 */
public function testPricingClientGetPricingPlans()
{
    $client = $this->createMockPricingClient();
    
    $mockPlans = [
        [
            'plan_id' => 'basic',
            'name' => 'Basic Plan',
            'price' => 1000
        ],
        [
            'plan_id' => 'premium',
            'name' => 'Premium Plan',
            'price' => 5000
        ]
    ];
    
    $client->method('getPricingPlans')
           ->willReturn($mockPlans);
    
    $result = $client->getPricingPlans();
    
    $this->assertCount(2, $result);
    $this->assertEquals('basic', $result[0]['plan_id']);
    $this->assertEquals('premium', $result[1]['plan_id']);
}

/**
 * @test
 * 不正なパラメータでのAPI呼び出し異常系テスト
 */
public function testApiClientWithInvalidParameters()
{
    $client = $this->createMockAuthClient();
    
    $client->method('getUserInfo')
           ->willThrowException(new BadRequestException('Invalid token format'));
    
    $this->expectException(BadRequestException::class);
    $this->expectExceptionMessage('Invalid token format');
    
    $client->getUserInfo(['token' => 'invalid_token_format']);
}

/**
 * @test
 * ネットワークエラー時の例外処理
 */
public function testApiClientNetworkError()
{
    $client = $this->createMockAuthClient();
    
    $client->method('getTenants')
           ->willThrowException(new NetworkException('Connection timeout'));
    
    $this->expectException(NetworkException::class);
    $this->expectExceptionMessage('Connection timeout');
    
    $client->getTenants();
}

/**
 * @test
 * 認証エラー時の適切な例外発生
 */
public function testApiClientAuthenticationError()
{
    $client = $this->createMockAuthClient();
    
    $client->method('createTenant')
           ->willThrowException(new UnauthorizedException('Invalid API credentials'));
    
    $this->expectException(UnauthorizedException::class);
    $this->expectExceptionMessage('Invalid API credentials');
    
    $client->createTenant(['name' => 'Test Tenant']);
}
```

**注意**: 自動生成コードは基本的にOpenAPI仕様に準拠しているため、テストは統合テストレベルで実施することを推奨します。

## テスト実装方針

### テストフレームワーク
- **PHPUnit**: メインのテストフレームワーク
- **Mockery**: より柔軟なモック・スタブ作成
- **Laravel Testing**: Laravel統合機能のテスト支援

### モック・スタブ戦略
```php
// APIクライアントのモック作成例
protected function mockApiClient($method, $returnValue)
{
    $mock = $this->createMock(ApiClient::class);
    $authClient = $this->createMock(Auth\Client::class);
    
    $authClient->method($method)->willReturn($returnValue);
    $mock->method('getAuthClient')->willReturn($authClient);
    
    // 依存性注入でモックを使用
    $this->app->instance(ApiClient::class, $mock);
}

// HTTPリクエストのモック作成例
protected function createRequestWithBearerToken($token)
{
    $request = Request::create('/test', 'GET');
    $request->headers->set('Authorization', 'Bearer ' . $token);
    return $request;
}

// 例外を発生させるモック作成例
protected function mockApiClientWithException($exception)
{
    $mock = $this->createMock(ApiClient::class);
    $authClient = $this->createMock(Auth\Client::class);
    
    $authClient->method('getUserInfo')->willThrowException($exception);
    $mock->method('getAuthClient')->willReturn($authClient);
    
    $this->app->instance(ApiClient::class, $mock);
}
```

### テストデータ管理
```php
// Fixtureファイルの使用例
class TestDataFixtures
{
    public static function validUserInfo()
    {
        return [
            'id' => 'user_123',
            'email' => 'test@example.com',
            'tenants' => [
                ['id' => 'tenant_1', 'name' => 'Test Tenant 1'],
                ['id' => 'tenant_2', 'name' => 'Test Tenant 2']
            ]
        ];
    }
    
    public static function validPricingPlan()
    {
        return [
            'plan_id' => 'basic_plan',
            'name' => 'Basic Plan',
            'pricing_menus' => [
                [
                    'menu_id' => 'menu_1',
                    'units' => [
                        [
                            'metering_unit_name' => 'api_calls',
                            'upper_count' => 1000
                        ]
                    ]
                ]
            ]
        ];
    }
}
```

### カバレッジ目標
- **コアライブラリ**: 95%以上
- **Laravel統合機能**: 90%以上
- **自動生成コード**: 対象外（統合テストで確認）

### テストディレクトリ構造
```
test/
├── Unit/
│   ├── Api/
│   │   ├── ClientTest.php
│   │   ├── GuzzleMiddlewareTest.php
│   │   └── LibTest.php
│   ├── Laravel/
│   │   ├── Middleware/
│   │   │   └── AuthTest.php
│   │   └── Controllers/
│   │       ├── CallbackControllerTest.php
│   │       ├── CallbackApiControllerTest.php
│   │       └── TokenRefreshApiControllerTest.php
│   └── Generated/
│       └── ApiClientSampleTest.php
├── Integration/
├── Fixtures/
│   ├── UserInfoFixture.php
│   ├── PricingPlanFixture.php
│   └── TenantFixture.php
├── Helpers/
│   ├── MockHelper.php
│   └── RequestHelper.php
└── bootstrap.php
```

## テスト実行設定

### PHPUnit設定 (phpunit.xml)
```xml
<?xml version="1.0" encoding="UTF-8"?>
<phpunit xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
         xsi:noNamespaceSchemaLocation="https://schema.phpunit.de/10.0/phpunit.xsd"
         bootstrap="test/bootstrap.php"
         colors="true"
         processIsolation="false"
         stopOnFailure="false"
         cacheDirectory=".phpunit.cache"
         backupGlobals="false"
         backupStaticProperties="false">
    
    <testsuites>
        <testsuite name="Unit">
            <directory>test/Unit</directory>
        </testsuite>
        <testsuite name="Integration">
            <directory>test/Integration</directory>
        </testsuite>
    </testsuites>
    
    <source>
        <include>
            <directory>src</directory>
        </include>
        <exclude>
            <directory>generated</directory>
        </exclude>
    </source>
    
    <coverage>
        <report>
            <html outputDirectory="coverage-html"/>
            <clover outputFile="coverage.xml"/>
        </report>
    </coverage>
    
    <php>
        <env name="SAASUS_SAAS_ID" value="test_saas_id"/>
        <env name="SAASUS_API_KEY" value="test_api_key"/>
        <env name="SAASUS_SECRET_KEY" value="test_secret_key"/>
        <env name="SAASUS_API_URL_BASE" value="https://api-test.saasus.io"/>
        <env name="SAASUS_LOGIN_URL" value="https://auth-test.saasus.io/"/>
        <env name="SAASUS_AUTH_MODE" value="api"/>
    </php>
</phpunit>
```

### Composer Scripts設定
```json
{
    "scripts": {
        "test": "phpunit",
        "test:unit": "phpunit --testsuite=Unit",
        "test:integration": "phpunit --testsuite=Integration",
        "test:coverage": "phpunit --coverage-html coverage-html",
        "test:coverage-text": "phpunit --coverage-text",
        "test:watch": "phpunit-watcher watch"
    }
}
```

## 品質保証チェックリスト

### コードレビューチェックポイント
- [ ] テストケース名が明確で理解しやすい
- [ ] 正常系・異常系・境界値テストが適切にカバーされている
- [ ] モックの使用が適切で、テストが独立している
- [ ] アサーションが具体的で意味のある検証を行っている
- [ ] テストデータが適切に管理されている
- [ ] テストの実行時間が合理的である

### テスト品質メトリクス
- **テストカバレッジ**: 目標値以上
- **テスト実行時間**: 単体テスト全体で5分以内
- **テスト成功率**: 99%以上（不安定なテストの排除）
- **テストコードの保守性**: 複雑度指標の監視

### 継続的改善
- 定期的なテストコードレビュー
- テスト実行時間の監視と最適化
- 新機能追加時のテストケース追加
- テストデータの定期的な更新
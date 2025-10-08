# 結合テスト設計（続き）

## E2E-2. マルチテナント機能テスト（続き）

##### 1. テナント管理フロー E2E テスト（続き）
```php
/**
 * @test
 * テナント管理の完全フロー（続き）
 * @group e2e
 */
public function testCompleteMultiTenantFlow()
{
    // ... 前の部分は省略 ...
    
    // 5. テナント間のデータ分離確認
    $dataResponse = $this->get('/tenant/data');
    $dataResponse->assertStatus(200);
    
    $tenantData = $dataResponse->json();
    $this->assertEquals($tenantId, $tenantData['tenant_id']);
    
    // 他のテナントのデータにアクセスできないことを確認
    $otherTenantResponse = $this->get('/tenant/data?tenant_id=other_tenant');
    $otherTenantResponse->assertStatus(403); // Forbidden
    
    // 6. テナント設定の更新
    $updateData = [
        'company_name' => 'Updated E2E Test Company',
        'settings' => ['feature_x' => true]
    ];
    
    $updateResponse = $this->put("/tenant/settings", $updateData);
    $updateResponse->assertStatus(200);
    
    // 7. 更新確認
    $updatedSettingsResponse = $this->get('/tenant/settings');
    $updatedSettings = $updatedSettingsResponse->json();
    $this->assertEquals('Updated E2E Test Company', $updatedSettings['company_name']);
    
    // 8. テナント削除（管理者として）
    $this->authenticateAsAdmin();
    
    $deleteResponse = $this->delete("/admin/tenants/{$tenantId}");
    $deleteResponse->assertStatus(200);
    
    // 削除確認
    $verifyResponse = $this->get("/admin/tenants/{$tenantId}");
    $verifyResponse->assertStatus(404);
}
```

##### 2. 料金・課金フロー E2E テスト
```php
/**
 * @test
 * 料金・課金の完全フロー
 * @group e2e
 */
public function testCompletePricingBillingFlow()
{
    // 管理者として認証
    $this->authenticateAsAdmin();
    
    // 1. 料金プラン設定
    $pricingUnitData = [
        'unit_name' => 'e2e_api_calls',
        'display_name' => 'API Calls',
        'unit_type' => 'quantity'
    ];
    
    $unitResponse = $this->post('/admin/pricing/units', $pricingUnitData);
    $unitResponse->assertStatus(201);
    $unitId = $unitResponse->json()['unit_id'];
    
    $planData = [
        'plan_name' => 'e2e_basic_plan',
        'display_name' => 'E2E Basic Plan',
        'pricing_menus' => [
            [
                'menu_name' => 'basic_menu',
                'units' => [
                    [
                        'unit_id' => $unitId,
                        'upper_count' => 1000,
                        'price' => 1000
                    ]
                ]
            ]
        ]
    ];
    
    $planResponse = $this->post('/admin/pricing/plans', $planData);
    $planResponse->assertStatus(201);
    $planId = $planResponse->json()['plan_id'];
    
    // 2. テナントにプラン割り当て
    $tenantId = $this->createTestTenant();
    
    $assignPlanData = ['plan_id' => $planId];
    $assignResponse = $this->put("/admin/tenants/{$tenantId}/plan", $assignPlanData);
    $assignResponse->assertStatus(200);
    
    // 3. メータリング情報更新（テナントユーザーとして）
    $this->authenticateAsTenantUser('user@e2e-test.com', $tenantId);
    
    // API使用量をシミュレート
    for ($i = 0; $i < 100; $i++) {
        $meteringResponse = $this->post('/api/usage/increment', [
            'unit_name' => 'e2e_api_calls',
            'count' => 1
        ]);
        $meteringResponse->assertStatus(200);
    }
    
    // 4. 使用量確認
    $usageResponse = $this->get('/api/usage/current');
    $usageResponse->assertStatus(200);
    
    $usage = $usageResponse->json();
    $this->assertGreaterThanOrEqual(100, $usage['e2e_api_calls']);
    
    // 5. 課金情報の正確な計算確認
    $billingResponse = $this->get('/api/billing/current');
    $billingResponse->assertStatus(200);
    
    $billing = $billingResponse->json();
    $this->assertArrayHasKey('total_amount', $billing);
    $this->assertGreaterThan(0, $billing['total_amount']);
    
    // 6. 上限値チェック
    // 上限を超える使用量を試行
    $overLimitResponse = $this->post('/api/usage/increment', [
        'unit_name' => 'e2e_api_calls',
        'count' => 1000 // 上限1000を超える
    ]);
    
    // 上限エラーまたは警告が返されることを確認
    $this->assertContains($overLimitResponse->getStatusCode(), [400, 429]);
    
    // クリーンアップ
    $this->authenticateAsAdmin();
    $this->delete("/admin/tenants/{$tenantId}");
    $this->delete("/admin/pricing/plans/{$planId}");
    $this->delete("/admin/pricing/units/{$unitId}");
}
```

## 結合テストの実装方針

### テスト環境設定

#### Docker環境での統一テスト実行
```yaml
# docker-compose.test.yml
version: '3.8'
services:
  php-test:
    build:
      context: .
      dockerfile: docker/Dockerfile.test
    volumes:
      - .:/var/www/html
    environment:
      - SAASUS_SAAS_ID=${TEST_SAASUS_SAAS_ID}
      - SAASUS_API_KEY=${TEST_SAASUS_API_KEY}
      - SAASUS_SECRET_KEY=${TEST_SAASUS_SECRET_KEY}
      - SAASUS_API_URL_BASE=https://api-test.saasus.io
      - SAASUS_LOGIN_URL=https://auth-test.saasus.io/
      - DB_CONNECTION=sqlite
      - DB_DATABASE=:memory:
    depends_on:
      - redis-test
      
  redis-test:
    image: redis:7-alpine
    ports:
      - "6380:6379"
      
  nginx-test:
    image: nginx:alpine
    ports:
      - "8080:80"
    volumes:
      - ./docker/nginx-test.conf:/etc/nginx/conf.d/default.conf
      - .:/var/www/html
    depends_on:
      - php-test
```

#### SaaSus Platform テスト環境との連携
```php
// tests/Integration/SaasusPlatformTestCase.php
abstract class SaasusPlatformTestCase extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        
        // テスト環境の可用性チェック
        if (!$this->isTestEnvironmentAvailable()) {
            $this->markTestSkipped('SaaSus test environment is not available');
        }
        
        // テストデータのセットアップ
        $this->setupTestData();
    }
    
    protected function tearDown(): void
    {
        // テストデータのクリーンアップ
        $this->cleanupTestData();
        
        parent::tearDown();
    }
    
    protected function isTestEnvironmentAvailable(): bool
    {
        try {
            $client = $this->createTestApiClient();
            $client->getAuthClient()->getBasicInfo();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }
    
    protected function createTestApiClient(): Client
    {
        return new Client(
            getenv('TEST_SAASUS_SECRET_KEY'),
            getenv('TEST_SAASUS_API_KEY'),
            getenv('TEST_SAASUS_SAAS_ID'),
            'https://api-test.saasus.io'
        );
    }
}
```

### テストデータ管理

#### 自動セットアップ・クリーンアップ
```php
// tests/Integration/TestDataManager.php
class TestDataManager
{
    private Client $apiClient;
    private array $createdResources = [];
    
    public function __construct(Client $apiClient)
    {
        $this->apiClient = $apiClient;
    }
    
    public function createTestTenant(array $data = []): array
    {
        $defaultData = [
            'name' => 'Integration Test Tenant ' . time(),
            'back_office_staff_email' => 'test@example.com'
        ];
        
        $tenantData = array_merge($defaultData, $data);
        $tenant = $this->apiClient->getAuthClient()->createTenant($tenantData);
        
        $this->createdResources['tenants'][] = $tenant['id'];
        
        return $tenant;
    }
    
    public function createTestUser(string $tenantId, array $data = []): array
    {
        $defaultData = [
            'email' => 'testuser' . time() . '@example.com',
            'password' => 'TestPassword123!'
        ];
        
        $userData = array_merge($defaultData, $data);
        $user = $this->apiClient->getAuthClient()->createTenantUser($tenantId, $userData);
        
        $this->createdResources['users'][] = ['tenant_id' => $tenantId, 'user_id' => $user['id']];
        
        return $user;
    }
    
    public function cleanup(): void
    {
        // ユーザー削除
        foreach ($this->createdResources['users'] ?? [] as $userInfo) {
            try {
                $this->apiClient->getAuthClient()->deleteTenantUser(
                    $userInfo['tenant_id'], 
                    $userInfo['user_id']
                );
            } catch (Exception $e) {
                // ログに記録するが、テストは継続
                error_log("Failed to cleanup user: " . $e->getMessage());
            }
        }
        
        // テナント削除
        foreach ($this->createdResources['tenants'] ?? [] as $tenantId) {
            try {
                $this->apiClient->getAuthClient()->deleteTenant($tenantId);
            } catch (Exception $e) {
                error_log("Failed to cleanup tenant: " . $e->getMessage());
            }
        }
        
        $this->createdResources = [];
    }
}
```

### 外部API呼び出し回数の制限管理

#### レート制限対応
```php
// tests/Integration/RateLimitManager.php
class RateLimitManager
{
    private static int $requestCount = 0;
    private static float $lastRequestTime = 0;
    private const MAX_REQUESTS_PER_MINUTE = 60;
    private const MIN_REQUEST_INTERVAL = 1.0; // 秒
    
    public static function waitIfNeeded(): void
    {
        $now = microtime(true);
        
        // 1分間のリクエスト数制限チェック
        if (self::$requestCount >= self::MAX_REQUESTS_PER_MINUTE) {
            $waitTime = 60 - ($now - self::$lastRequestTime);
            if ($waitTime > 0) {
                sleep((int)ceil($waitTime));
                self::$requestCount = 0;
            }
        }
        
        // 最小間隔チェック
        $timeSinceLastRequest = $now - self::$lastRequestTime;
        if ($timeSinceLastRequest < self::MIN_REQUEST_INTERVAL) {
            $waitTime = self::MIN_REQUEST_INTERVAL - $timeSinceLastRequest;
            usleep((int)($waitTime * 1000000));
        }
        
        self::$requestCount++;
        self::$lastRequestTime = microtime(true);
    }
}
```

### CI/CD統合

#### GitHub Actions設定
```yaml
# .github/workflows/integration-tests.yml
name: Integration Tests

on:
  push:
    branches: [ main, develop ]
  pull_request:
    branches: [ main ]
  schedule:
    - cron: '0 2 * * *' # 毎日午前2時に実行

jobs:
  integration-tests:
    runs-on: ubuntu-latest
    
    strategy:
      matrix:
        php-version: [8.0, 8.1, 8.2, 8.3]
        laravel-version: [9.x, 10.x, 11.x]
    
    services:
      redis:
        image: redis:7-alpine
        ports:
          - 6379:6379
    
    steps:
    - uses: actions/checkout@v3
    
    - name: Setup PHP
      uses: shivammathur/setup-php@v2
      with:
        php-version: ${{ matrix.php-version }}
        extensions: mbstring, xml, ctype, iconv, intl, pdo_sqlite, redis
        coverage: xdebug
    
    - name: Cache Composer packages
      id: composer-cache
      uses: actions/cache@v3
      with:
        path: vendor
        key: ${{ runner.os }}-php-${{ hashFiles('**/composer.lock') }}
        restore-keys: |
          ${{ runner.os }}-php-
    
    - name: Install dependencies
      run: |
        composer install --prefer-dist --no-progress
        composer require "laravel/framework:${{ matrix.laravel-version }}" --no-update
        composer update
    
    - name: Setup test environment
      run: |
        cp .env.testing.example .env.testing
        php artisan key:generate --env=testing
    
    - name: Run integration tests
      env:
        TEST_SAASUS_SAAS_ID: ${{ secrets.TEST_SAASUS_SAAS_ID }}
        TEST_SAASUS_API_KEY: ${{ secrets.TEST_SAASUS_API_KEY }}
        TEST_SAASUS_SECRET_KEY: ${{ secrets.TEST_SAASUS_SECRET_KEY }}
      run: |
        vendor/bin/phpunit --testsuite=Integration --coverage-clover=coverage.xml
    
    - name: Upload coverage to Codecov
      uses: codecov/codecov-action@v3
      with:
        file: ./coverage.xml
        flags: integration
        name: codecov-umbrella
```

### テスト実行コマンド

#### Makefileでの統一コマンド
```makefile
# Makefile
.PHONY: test test-unit test-integration test-e2e test-coverage

# 全テスト実行
test:
	docker-compose -f docker-compose.test.yml run --rm php-test vendor/bin/phpunit

# 単体テスト実行
test-unit:
	docker-compose -f docker-compose.test.yml run --rm php-test vendor/bin/phpunit --testsuite=Unit

# 結合テスト実行
test-integration:
	docker-compose -f docker-compose.test.yml run --rm php-test vendor/bin/phpunit --testsuite=Integration

# E2Eテスト実行
test-e2e:
	docker-compose -f docker-compose.test.yml run --rm php-test vendor/bin/phpunit --group=e2e

# カバレッジレポート生成
test-coverage:
	docker-compose -f docker-compose.test.yml run --rm php-test vendor/bin/phpunit --coverage-html coverage-html

# テスト環境セットアップ
test-setup:
	docker-compose -f docker-compose.test.yml build
	docker-compose -f docker-compose.test.yml up -d

# テスト環境クリーンアップ
test-cleanup:
	docker-compose -f docker-compose.test.yml down -v
```

## 品質保証メトリクス

### 結合テストの成功基準
- **テスト成功率**: 95%以上
- **テスト実行時間**: 結合テスト全体で30分以内
- **外部API依存テスト**: 環境問題による失敗を適切にハンドリング
- **データ整合性**: テスト後のクリーンアップ完了率100%

### 監視項目
- 外部API応答時間の監視
- テストデータクリーンアップの成功率
- CI/CD実行時間の推移
- テスト環境の可用性

### 継続的改善
- 月次でのテスト実行時間レビュー
- 外部API変更への対応プロセス
- テストデータ管理の最適化
- 不安定なテストの特定と修正
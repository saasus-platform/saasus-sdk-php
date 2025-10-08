# 実装ガイドライン

## 概要

このドキュメントは、SaaSus SDK for PHPのテスト実装を行う際の具体的なガイドラインを提供します。コーディング規約、ベストプラクティス、実装手順、品質保証プロセスを含みます。

## 実装優先順位

### フェーズ1（高優先度）- 基盤テストの実装
**期間**: 2-3週間
**目標**: コアライブラリの品質保証

#### 実装対象
1. **[`ClientTest.php`](../../src/Api/Client.php)** - 統合管理クラステスト
   - 環境変数検証テスト
   - APIクライアント初期化テスト
   - エラーハンドリングテスト

2. **[`GuzzleMiddlewareTest.php`](../../src/Api/GuzzleMiddleware.php)** - 認証ミドルウェアテスト
   - 署名生成テスト
   - ヘッダー処理テスト
   - 異常系テスト

3. **[`LibTest.php`](../../src/Api/Lib.php)** - ユーティリティ関数テスト
   - メータリングユニット検索テスト
   - 境界値テスト

4. **[`AuthMiddlewareTest.php`](../../src/Laravel/Middleware/Auth.php)** - Laravel認証ミドルウェアテスト
   - 認証成功・失敗パターンテスト
   - ヘッダー処理テスト

5. **基本的な結合テスト**
   - Client + GuzzleMiddleware 結合テスト

#### 成功基準
- [ ] 単体テストカバレッジ95%以上
- [ ] 全テストケースが5分以内で完了
- [ ] CI/CDパイプラインでの自動実行成功

### フェーズ2（中優先度）- Laravel統合機能の実装
**期間**: 2-3週間
**目標**: Laravel統合機能の品質保証

#### 実装対象
1. **Laravelコントローラーテスト**
   - [`CallbackControllerTest.php`](../../src/Laravel/Controllers/CallbackController.php)
   - [`CallbackApiControllerTest.php`](../../src/Laravel/Controllers/CallbackApiController.php)
   - [`TokenRefreshApiControllerTest.php`](../../src/Laravel/Controllers/TokenRefreshApiController.php)

2. **Laravel統合機能結合テスト**
   - 認証フロー統合テスト
   - ルーティング統合テスト
   - ビュー統合テスト

3. **主要APIクライアント結合テスト**
   - Auth API結合テスト
   - Pricing API結合テスト

#### 成功基準
- [ ] Laravel統合機能カバレッジ90%以上
- [ ] 複数Laravelバージョンでの動作確認
- [ ] 実際のSaaSus Platform APIとの通信確認

### フェーズ3（中優先度）- E2Eテストの実装
**期間**: 2-3週間
**目標**: 実際のSaaSus Platform APIとの統合テスト

#### 実装対象
1. **Auth モジュール E2Eテスト** ✅ **完了**
   - [`AuthTenantCrudE2ETest.php`](../../test/E2E/Auth/AuthTenantCrudE2ETest.php) - テナントCRUD操作
   - [`AuthUserCrudE2ETest.php`](../../test/E2E/Auth/AuthUserCrudE2ETest.php) - ユーザーCRUD操作
   - [`AuthRoleCrudE2ETest.php`](../../test/E2E/Auth/AuthRoleCrudE2ETest.php) - ロールCRUD操作

2. **Pricing モジュール E2Eテスト**
   - `PricingPlanCrudE2ETest.php` - 料金プランCRUD操作
   - `PricingUnitCrudE2ETest.php` - 料金ユニットCRUD操作
   - `MeteringUnitCrudE2ETest.php` - メータリングユニットCRUD操作

3. **Billing モジュール E2Eテスト**
   - `BillingStripeInfoE2ETest.php` - Stripe連携情報管理

4. **Integration モジュール E2Eテスト**
   - `IntegrationEventBridgeE2ETest.php` - EventBridge設定・イベント送信

5. **Communication モジュール E2Eテスト**
   - `CommunicationFeedbackE2ETest.php` - フィードバック管理・コメント・投票

6. **AwsMarketplace モジュール E2Eテスト**
   - `AwsMarketplaceCustomerE2ETest.php` - 顧客管理
   - `AwsMarketplacePlanE2ETest.php` - プラン管理

7. **ApiLog モジュール E2Eテスト**
   - `ApiLogRetrievalE2ETest.php` - ログ取得機能

#### 成功基準
- [ ] 全モジュールのE2Eテスト実装完了
- [ ] Docker環境での自動実行成功
- [ ] カバレッジレポート生成（generatedディレクトリ含む）
- [ ] 実際のSaaSus Platform APIとの通信確認

### フェーズ4（低優先度）- 包括的テストの実装
**期間**: 3-4週間
**目標**: 完全なテストカバレッジとパフォーマンス最適化

#### 実装対象
1. **自動生成APIクライアントサンプルテスト**
2. **パフォーマンステスト**
3. **セキュリティテスト**
4. **負荷テスト**

#### 成功基準
- [ ] パフォーマンス基準の達成
- [ ] セキュリティ脆弱性の検出・修正
- [ ] 大量データでの動作確認

## コーディング規約

### テストクラス命名規約
```php
// 単体テスト
class ClientTest extends TestCase
class GuzzleMiddlewareTest extends TestCase
class LibTest extends TestCase

// 結合テスト
class ClientMiddlewareIntegrationTest extends TestCase
class LaravelIntegrationTest extends TestCase

// E2Eテスト
class AuthTenantCrudE2ETest extends TestCase
class PricingPlanCrudE2ETest extends TestCase
class BillingStripeInfoE2ETest extends TestCase
```

### テストメソッド命名規約
```php
// 正常系テスト
public function testConstructorWithValidEnvironmentVariables()
public function testGetSignAsHeaderWithValidParameters()

// 異常系テスト
public function testConstructorThrowsExceptionWhenRequiredEnvVarsMissing()
public function testGetSignAsHeaderReturnsEmptyStringWhenRequiredParamsMissing()

// 境界値テスト
public function testConstructorWithEmptyStringEnvVars()
public function testFindUpperCountWithLargeValue()

// 統合テスト
public function testCompleteWebAuthenticationFlow()
public function testClientInitializationToApiCall()

// E2Eテスト（実際のAPI通信）
public function testCompleteTenantCrudFlow()
public function testTenantCrudValidationErrors()
public function testNonExistentTenantOperations()
public function testBulkTenantOperationsPerformance()
```

### アサーション規約
```php
// 具体的で意味のあるアサーション
$this->assertEquals('expected_value', $actual);
$this->assertInstanceOf(ExpectedClass::class, $object);
$this->assertArrayHasKey('expected_key', $array);
$this->assertStringStartsWith('prefix', $string);

// 複数のアサーションを組み合わせて包括的に検証
$this->assertIsArray($result);
$this->assertCount(2, $result);
$this->assertEquals('expected_id', $result[0]['id']);

// エラーメッセージ付きアサーション
$this->assertTrue($condition, 'Condition should be true because...');
```

### モック・スタブ規約
```php
// PHPUnit Mock Objects使用例
protected function createMockApiClient(): Client
{
    $mock = $this->createMock(Client::class);
    $authClient = $this->createMock(Auth\Client::class);
    
    $authClient->method('getUserInfo')
               ->willReturn(['user_id' => 'test_user']);
    
    $mock->method('getAuthClient')
         ->willReturn($authClient);
    
    return $mock;
}

// Mockery使用例（より複雑なモック）
protected function createMockeryApiClient(): Client
{
    $mock = Mockery::mock(Client::class);
    $mock->shouldReceive('getAuthClient')
         ->once()
         ->andReturn(Mockery::mock(Auth\Client::class, function ($authMock) {
             $authMock->shouldReceive('getUserInfo')
                      ->with(['token' => 'valid_token'])
                      ->once()
                      ->andReturn(['user_id' => 'test_user']);
         }));
    
    return $mock;
}
```

### テストデータ管理規約
```php
// Fixtureクラスの使用
class UserInfoFixture
{
    public static function validUserInfo(): array
    {
        return [
            'user_id' => 'test_user_123',
            'email' => 'test@example.com',
            'tenants' => [
                ['id' => 'tenant_1', 'name' => 'Test Tenant 1'],
                ['id' => 'tenant_2', 'name' => 'Test Tenant 2']
            ],
            'roles' => ['member'],
            'created_at' => '2024-01-01T00:00:00Z'
        ];
    }
    
    public static function invalidUserInfo(): array
    {
        return [
            'user_id' => '',
            'email' => 'invalid-email',
            'tenants' => null
        ];
    }
}

// テストケースでの使用
public function testGetUserInfoWithValidData()
{
    $expectedUserInfo = UserInfoFixture::validUserInfo();
    $this->mockApiClient('getUserInfo', $expectedUserInfo);
    
    $result = $this->client->getAuthClient()->getUserInfo(['token' => 'valid_token']);
    
    $this->assertEquals($expectedUserInfo, $result);
}
```

## ベストプラクティス

### 1. テストの独立性確保
```php
class ClientTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        
        // 各テストで環境変数をクリア
        putenv('SAASUS_SECRET_KEY=');
        putenv('SAASUS_SAAS_ID=');
        putenv('SAASUS_API_KEY=');
        
        // テスト用の一時ファイル作成
        $this->tempDir = sys_get_temp_dir() . '/saasus_test_' . uniqid();
        mkdir($this->tempDir);
    }
    
    protected function tearDown(): void
    {
        // テスト後のクリーンアップ
        if (is_dir($this->tempDir)) {
            $this->removeDirectory($this->tempDir);
        }
        
        // グローバル状態のリセット
        Mockery::close();
        
        parent::tearDown();
    }
}
```

### 2. 意味のあるテストケース設計
```php
/**
 * @test
 * 必須環境変数が未設定の場合、適切なエラーメッセージと共に例外が発生することを確認
 * 
 * 背景: SaaSus Platform APIとの通信には認証情報が必須
 * 期待動作: 不足している環境変数名を含むエラーメッセージ
 */
public function testConstructorThrowsExceptionWithSpecificMessageWhenRequiredEnvVarsMissing()
{
    // Given: 必須環境変数が未設定
    putenv('SAASUS_SECRET_KEY=');
    putenv('SAASUS_SAAS_ID=test_saas_id'); // 一部のみ設定
    putenv('SAASUS_API_KEY=');
    
    // When & Then: 適切な例外とメッセージが発生
    $this->expectException(Exception::class);
    $this->expectExceptionMessage('SAASUS_SECRET_KEY,SAASUS_API_KEY are required');
    
    new Client();
}
```

### 3. パラメータ化テスト
```php
/**
 * @test
 * @dataProvider httpMethodProvider
 */
public function testGetSignAsHeaderWithDifferentHttpMethods(string $method, string $expectedPattern)
{
    $signature = GuzzleMiddleware::getSignAsHeader(
        'secret', 'apikey', 'saasid', $method, 'host', '/path', '', ''
    );
    
    $this->assertStringStartsWith('SAASUSSIGV1', $signature);
    $this->assertMatchesRegularExpression($expectedPattern, $signature);
}

public function httpMethodProvider(): array
{
    return [
        'GET method' => ['GET', '/Sig=[a-f0-9]{64}/'],
        'POST method' => ['POST', '/Sig=[a-f0-9]{64}/'],
        'PUT method' => ['PUT', '/Sig=[a-f0-9]{64}/'],
        'DELETE method' => ['DELETE', '/Sig=[a-f0-9]{64}/'],
    ];
}
```

### 4. 例外テストのベストプラクティス
```php
public function testApiCallThrowsSpecificExceptionOnAuthenticationFailure()
{
    // 具体的な例外クラスと詳細なメッセージを検証
    $this->expectException(HttpException::class);
    $this->expectExceptionCode(401);
    $this->expectExceptionMessage('Invalid API credentials');
    
    // モックで401エラーを設定
    $this->mockApiClientWithHttpException(401, [
        'type' => 'UNAUTHORIZED',
        'message' => 'Invalid API credentials'
    ]);
    
    $this->client->getAuthClient()->getUserInfo(['token' => 'invalid_token']);
}
```

### 5. 非同期・時間依存テストの処理
```php
public function testSignatureChangesWithTime()
{
    // 時刻をモック化
    $mockTime = 1640995200; // 2022-01-01 00:00:00 UTC
    
    // Carbon::nowをモック（Laravelの場合）
    Carbon::setTestNow(Carbon::createFromTimestamp($mockTime));
    
    $signature1 = GuzzleMiddleware::getSignAsHeader(
        'secret', 'apikey', 'saasid', 'GET', 'host', '/path', '', ''
    );
    
    // 1分後
    Carbon::setTestNow(Carbon::createFromTimestamp($mockTime + 60));
    
    $signature2 = GuzzleMiddleware::getSignAsHeader(
        'secret', 'apikey', 'saasid', 'GET', 'host', '/path', '', ''
    );
    
    $this->assertNotEquals($signature1, $signature2);
    
    // テスト後のクリーンアップ
    Carbon::setTestNow();
}
```

## 品質保証プロセス

### 1. コードレビューチェックリスト

#### テストコード品質
- [ ] テストメソッド名が明確で理解しやすい
- [ ] Given-When-Then構造が明確
- [ ] アサーションが具体的で意味がある
- [ ] エラーメッセージが適切
- [ ] テストデータが適切に管理されている

#### テストカバレッジ
- [ ] 正常系テストが実装されている
- [ ] 異常系テストが実装されている
- [ ] 境界値テストが実装されている
- [ ] エラーハンドリングテストが実装されている

#### テストの保守性
- [ ] テストが独立している（他のテストに依存しない）
- [ ] モックの使用が適切
- [ ] テストデータの再利用性が高い
- [ ] テスト実行時間が合理的

### 2. 自動品質チェック

#### 静的解析設定
```php
// phpstan.neon
parameters:
    level: 8
    paths:
        - src
        - test
    excludePaths:
        - generated
    ignoreErrors:
        - '#Call to an undefined method.*#'
    checkMissingIterableValueType: false
```

#### コードスタイル設定
```php
// .php-cs-fixer.php
<?php

$finder = PhpCsFixer\Finder::create()
    ->in(__DIR__ . '/src')
    ->in(__DIR__ . '/test')
    ->exclude('generated');

return (new PhpCsFixer\Config())
    ->setRules([
        '@PSR12' => true,
        'array_syntax' => ['syntax' => 'short'],
        'ordered_imports' => true,
        'no_unused_imports' => true,
        'trailing_comma_in_multiline' => true,
        'phpdoc_scalar' => true,
        'phpdoc_single_line_var_spacing' => true,
        'phpdoc_var_without_name' => true,
    ])
    ->setFinder($finder);
```

### 3. 継続的改善プロセス

#### 週次レビュー項目
- [ ] テスト実行時間の監視
- [ ] テスト成功率の確認
- [ ] カバレッジレポートの確認
- [ ] 不安定なテストの特定

#### 月次レビュー項目
- [ ] テストコードの技術的負債確認
- [ ] テストデータの整理・更新
- [ ] テスト環境の最適化
- [ ] 新機能に対するテスト追加

#### 四半期レビュー項目
- [ ] テスト戦略の見直し
- [ ] テストツール・フレームワークの更新検討
- [ ] テストプロセスの改善提案
- [ ] チーム内でのベストプラクティス共有

## 実装手順

### 1. 環境セットアップ
```bash
# 1. リポジトリクローン
git clone https://github.com/saasus-platform/saasus-sdk-php.git
cd saasus-sdk-php

# 2. 依存関係インストール
composer install

# 3. テスト環境設定
cp .env.testing.example .env.testing
# .env.testingファイルを編集して適切な値を設定

# 4. Docker環境セットアップ（オプション）
make docker-setup

# 5. 初回テスト実行
make test-unit
```

### 2. テストクラス作成テンプレート

#### 単体テストテンプレート
```php
<?php

namespace AntiPatternInc\Saasus\Test\Unit\Api;

use PHPUnit\Framework\TestCase;
use AntiPatternInc\Saasus\Api\Client;

class ClientTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        
        // テスト前の初期化処理
        $this->clearEnvironmentVariables();
    }
    
    protected function tearDown(): void
    {
        // テスト後のクリーンアップ処理
        $this->restoreEnvironmentVariables();
        
        parent::tearDown();
    }
    
    /**
     * @test
     * テストの説明をここに記述
     */
    public function testMethodName()
    {
        // Given: テストの前提条件
        $this->setValidEnvironmentVariables();
        
        // When: テスト対象の実行
        $client = new Client();
        
        // Then: 結果の検証
        $this->assertInstanceOf(Client::class, $client);
    }
    
    // ヘルパーメソッド
    private function clearEnvironmentVariables(): void
    {
        putenv('SAASUS_SECRET_KEY=');
        putenv('SAASUS_SAAS_ID=');
        putenv('SAASUS_API_KEY=');
    }
    
    private function setValidEnvironmentVariables(): void
    {
        putenv('SAASUS_SECRET_KEY=test_secret');
        putenv('SAASUS_SAAS_ID=test_saas_id');
        putenv('SAASUS_API_KEY=test_api_key');
    }
}
```

#### E2Eテストテンプレート
```php
<?php

namespace AntiPatternInc\Saasus\Test\E2E\Pricing;

use PHPUnit\Framework\TestCase;
use AntiPatternInc\Saasus\Api\Client;
use AntiPatternInc\Saasus\Test\Helpers\E2ETestHelper;
use AntiPatternInc\Saasus\Test\Helpers\TestDataManager;

/**
 * @group e2e
 * @group pricing
 * @group pricing-plan-crud
 */
class PricingPlanCrudE2ETest extends TestCase
{
    private Client $client;
    private TestDataManager $testDataManager;

    protected function setUp(): void
    {
        parent::setUp();
        
        // E2E環境検証
        E2ETestHelper::validateE2EEnvironment();
        
        // SaaSus APIクライアント初期化
        $this->client = new Client();
        
        // テストデータ管理初期化
        $this->testDataManager = new TestDataManager();
    }

    protected function tearDown(): void
    {
        // テストデータクリーンアップ
        $this->testDataManager->cleanup();
        
        parent::tearDown();
    }

    /**
     * @test
     * 料金プランの完全なCRUDフローをテスト
     *
     * 1. プラン作成
     * 2. プラン取得・検証
     * 3. プラン更新
     * 4. プラン削除
     */
    public function testCompletePricingPlanCrudFlow()
    {
        $pricingClient = $this->client->getPricingClient();
        
        // === プラン作成 ===
        $planData = [
            'name' => 'E2E Test Plan ' . time(),
            'display_name' => 'E2E Test Plan Display',
            'description' => 'E2E Test Plan Description',
            'currency' => 'JPY'
        ];
        
        $createdPlan = $pricingClient->createPricingPlan($planData);
        $this->testDataManager->trackPricingPlan($createdPlan['id']);
        
        $this->assertArrayHasKey('id', $createdPlan);
        $this->assertEquals($planData['name'], $createdPlan['name']);
        
        // === プラン取得 ===
        $retrievedPlan = $pricingClient->getPricingPlan($createdPlan['id']);
        $this->assertEquals($createdPlan['id'], $retrievedPlan['id']);
        $this->assertEquals($planData['name'], $retrievedPlan['name']);
        
        // === プラン更新 ===
        $updateData = [
            'display_name' => 'Updated E2E Test Plan Display'
        ];
        
        $pricingClient->updatePricingPlan($createdPlan['id'], $updateData);
        $updatedPlan = $pricingClient->getPricingPlan($createdPlan['id']);
        $this->assertEquals($updateData['display_name'], $updatedPlan['display_name']);
        
        // === プラン削除 ===
        $pricingClient->deletePricingPlan($createdPlan['id']);
        $this->testDataManager->untrackPricingPlan($createdPlan['id']);
        
        // 削除確認
        $this->expectException(\Exception::class);
        $pricingClient->getPricingPlan($createdPlan['id']);
    }

    /**
     * @test
     * バリデーションエラーのテスト
     */
    public function testPricingPlanValidationErrors()
    {
        $pricingClient = $this->client->getPricingClient();
        
        // 必須フィールド欠如
        $this->expectException(\Exception::class);
        $pricingClient->createPricingPlan([]);
    }

    /**
     * @test
     * 存在しないプランに対する操作のテスト
     */
    public function testNonExistentPricingPlanOperations()
    {
        $pricingClient = $this->client->getPricingClient();
        $nonExistentId = 'non-existent-plan-' . time();
        
        // 取得エラー
        $this->expectException(\Exception::class);
        $pricingClient->getPricingPlan($nonExistentId);
    }

    /**
     * @test
     * 大量プラン操作のパフォーマンステスト
     */
    public function testBulkPricingPlanOperationsPerformance()
    {
        $pricingClient = $this->client->getPricingClient();
        $planCount = 5;
        $createdPlans = [];
        
        // 作成パフォーマンス測定
        $startTime = microtime(true);
        
        for ($i = 0; $i < $planCount; $i++) {
            $planData = [
                'name' => "E2E Bulk Test Plan {$i} " . time(),
                'display_name' => "E2E Bulk Test Plan {$i}",
                'currency' => 'JPY'
            ];
            
            $plan = $pricingClient->createPricingPlan($planData);
            $createdPlans[] = $plan;
            $this->testDataManager->trackPricingPlan($plan['id']);
        }
        
        $creationTime = microtime(true) - $startTime;
        $this->assertLessThan(10.0, $creationTime, "プラン作成が10秒以内に完了すること");
        
        // 削除パフォーマンス測定
        $startTime = microtime(true);
        
        foreach ($createdPlans as $plan) {
            $pricingClient->deletePricingPlan($plan['id']);
            $this->testDataManager->untrackPricingPlan($plan['id']);
        }
        
        $deletionTime = microtime(true) - $startTime;
        $this->assertLessThan(10.0, $deletionTime, "プラン削除が10秒以内に完了すること");
    }
}
```

### 3. 実装進捗管理

#### GitHub Issues テンプレート
```markdown
## テスト実装タスク

### 対象クラス
- [ ] `src/Api/Client.php`

### 実装するテストケース
- [ ] 正常系: 環境変数が正しく設定されている場合の初期化
- [ ] 異常系: 必須環境変数未設定時の例外発生
- [ ] 境界値: 空文字列環境変数の処理

### 完了基準
- [ ] テストカバレッジ95%以上
- [ ] 全テストケースが通る
- [ ] コードレビュー完了

### 見積もり時間
3日

### 関連ドキュメント
- [単体テスト設計](docs/test-design/01-unit-tests.md)
```

#### プルリクエストテンプレート
```markdown
## テスト実装PR

### 実装内容
- [ ] `ClientTest.php` の実装
- [ ] テストカバレッジ: XX%
- [ ] 実行時間: XX秒

### チェックリスト
- [ ] 全テストが通る
- [ ] コードスタイルチェック通過
- [ ] 静的解析通過
- [ ] ドキュメント更新

### レビューポイント
- テストケースの網羅性
- アサーションの適切性
- モックの使用方法
```

## トラブルシューティング

### よくある問題と解決方法

#### 1. 環境変数関連の問題
```bash
# 問題: 環境変数が読み込まれない
# 解決: .env.testingファイルの確認
cp .env.testing.example .env.testing
# ファイル内容を確認・編集

# 問題: Docker環境で環境変数が反映されない
# 解決: docker-compose.test.ymlの環境変数設定確認
docker-compose -f docker-compose.test.yml config
```

#### 2. テスト実行時間の問題
```bash
# 問題: テストが遅い
# 解決: 並列実行の利用
composer require --dev brianium/paratest
vendor/bin/paratest --processes=4

# 問題: 外部API呼び出しが遅い
# 解決: モックの使用、グループ分け
phpunit --exclude-group=external-api
```

#### 3. メモリ不足の問題
```bash
# 問題: メモリ不足エラー
# 解決: PHP設定の調整
php -d memory_limit=512M vendor/bin/phpunit

# Docker環境での解決
# docker/php/php.test.ini で memory_limit を調整
```

#### 4. カバレッジレポート生成の問題
```bash
# 問題: Xdebugが有効でない
# 解決: Xdebug設定確認
php -m | grep xdebug

# Docker環境での解決
# Dockerfile.e2eでXdebugインストール確認
```

#### 5. E2Eテスト実行とカバレッジ生成
```bash
# E2Eテスト実行（Docker環境）
./scripts/run-e2e-docker.sh

# 高速実行（ビルドチェックをスキップ）
./scripts/run-e2e-docker.sh --skip-build

# カバレッジ付き高速実行
./scripts/run-e2e-docker.sh --skip-build -c

# 特定のテストグループのみ実行
./scripts/run-e2e-docker.sh --skip-build auth

# カバレッジレポート確認
open coverage-html-e2e/index.html

# 問題: 毎回イメージ再ビルドで時間がかかる
# 解決: --skip-buildオプションを使用
./scripts/run-e2e-docker.sh --skip-build

# 問題: カバレッジレポートが生成されない
# 解決: PHPUnit設定ファイルの形式確認
# PHPUnit 10形式 → PHPUnit 9形式に変更が必要な場合がある

# 問題: Dockerコンテナ内でファイルが生成されない
# 解決: ボリュームマウント設定とディレクトリ権限確認
docker-compose -f docker-compose.e2e.yml config
```

#### 6. パフォーマンス最適化
```bash
# 初回実行（イメージビルドが必要）
./scripts/run-e2e-docker.sh --build

# 2回目以降の実行（高速）
./scripts/run-e2e-docker.sh --skip-build

# 開発中の頻繁なテスト実行
./scripts/run-e2e-docker.sh --skip-build auth

# 強制的にイメージを再ビルドが必要な場合
./scripts/run-e2e-docker.sh --build --no-cache
```

## E2Eテスト実装パターン（Authモジュール実装経験より）

### 実装済みAuthモジュールE2Eテスト

#### 1. [`AuthTenantCrudE2ETest.php`](../../test/E2E/Auth/AuthTenantCrudE2ETest.php) ✅
- **テストケース**: 4つのテストメソッド、14のアサーション
- **実装パターン**:
  - 完全なCRUDフロー（作成→取得→更新→削除）
  - バリデーションエラーテスト
  - 存在しないリソースに対する操作テスト
  - パフォーマンステスト（大量操作）
- **特徴**: テナント属性の自動作成機能を含む

#### 2. [`AuthUserCrudE2ETest.php`](../../test/E2E/Auth/AuthUserCrudE2ETest.php) ✅
- **テストケース**: ユーザーCRUD操作
- **実装パターン**: Authモジュールと同様のCRUDパターン

#### 3. [`AuthRoleCrudE2ETest.php`](../../test/E2E/Auth/AuthRoleCrudE2ETest.php) ✅
- **テストケース**: ロールCRUD操作
- **実装パターン**: Authモジュールと同様のCRUDパターン

### E2Eテスト実行環境

#### Docker設定
```yaml
# docker-compose.e2e.yml
version: '3.8'
services:
  php-e2e:
    build:
      context: .
      dockerfile: docker/Dockerfile.e2e
    volumes:
      - .:/app
      - ./coverage-html-e2e:/app/coverage-html-e2e
    environment:
      - SAASUS_SAAS_ID=${SAASUS_SAAS_ID}
      - SAASUS_API_KEY=${SAASUS_API_KEY}
      - SAASUS_SECRET_KEY=${SAASUS_SECRET_KEY}
```

#### PHPUnit設定（E2E用）
```xml
<!-- test/phpunit.e2e.xml -->
<?xml version="1.0" encoding="UTF-8"?>
<phpunit xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
         xsi:noNamespaceSchemaLocation="https://schema.phpunit.de/9.3/phpunit.xsd"
         bootstrap="bootstrap.php"
         colors="true">
    <testsuites>
        <testsuite name="E2E">
            <directory>E2E</directory>
        </testsuite>
    </testsuites>
    
    <coverage includeUncoveredFiles="true" processUncoveredFiles="false">
        <include>
            <directory suffix=".php">../src</directory>
            <directory suffix=".php">../generated</directory>
        </include>
        <exclude>
            <directory>../generated/*/Runtime</directory>
            <directory>../generated/*/Normalizer</directory>
            <directory>../generated/*/Exception</directory>
        </exclude>
        <report>
            <html outputDirectory="../coverage-html-e2e"/>
        </report>
    </coverage>
</phpunit>
```

### カバレッジ結果（実装完了後）

#### 基本カバレッジ（srcディレクトリのみ）
- **Classes**: 19 (100.00%)
- **Methods**: 19 (100.00%)
- **Lines**: 202 (100.00%)

#### 拡張カバレッジ（generatedディレクトリ含む）
- **Classes**: 344 (100.00%)
- **Methods**: 2,485 (100.00%)
- **Lines**: 4,940 (100.00%)

### 他モジュール実装時の注意点

#### 1. API応答形式の違い
```php
// SaaSus APIは配列またはオブジェクト形式で応答する場合がある
$response = $client->getResource($id);
if (is_array($response)) {
    $this->assertArrayHasKey('id', $response);
} else {
    $this->assertObjectHasAttribute('id', $response);
}
```

#### 2. エラーコードの違い
```php
// 404ではなく400エラーが返される場合がある
$this->expectException(\Exception::class);
// 具体的なエラーコードやメッセージの確認が必要
```

#### 3. 必須フィールドの確認
```php
// APIによって必須フィールドが異なる
$requiredFields = [
    'name',        // 多くのリソースで必須
    'display_name', // 表示名が必要な場合
    'currency'     // 料金関連リソースで必須
];
```

このガイドラインに従って実装することで、高品質で保守性の高いテストコードを作成できます。
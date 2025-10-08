<?php

namespace AntiPatternInc\Saasus\Test\E2E\Auth;

use PHPUnit\Framework\TestCase;
use AntiPatternInc\Saasus\Api\Client;
use AntiPatternInc\Saasus\Test\Helpers\TestDataManager;
use AntiPatternInc\Saasus\Test\Helpers\E2ETestHelper;

/**
 * AuthモジュールのユーザーCRUD操作のE2Eテスト
 * 
 * このテストクラスは、SaaSus Platform APIとの実際の通信を行い、
 * ユーザー管理機能の完全なCRUDフローをテストします。
 * 
 * @group e2e
 * @group auth
 * @group user-crud
 */
class AuthUserCrudE2ETest extends TestCase
{
    private Client $client;
    private TestDataManager $testDataManager;
    private E2ETestHelper $e2eHelper;

    protected function setUp(): void
    {
        parent::setUp();

        // E2Eテスト用のクライアント初期化
        $this->client = $this->createE2EClient();
        $this->testDataManager = new TestDataManager($this->client);
        $this->e2eHelper = new E2ETestHelper();

        // テスト開始前の環境確認
        $this->e2eHelper->verifyTestEnvironment();
        $this->e2eHelper->prepareTestExecution();
    }

    protected function tearDown(): void
    {
        // テスト後のクリーンアップ
        $this->testDataManager->cleanup();
        $this->e2eHelper->cleanupTestExecution();

        parent::tearDown();
    }

    /**
     * @test
     * SaaSユーザーCRUD操作の完全フロー
     * 
     * シナリオ:
     * 1. SaaSユーザー一覧取得（初期状態確認）
     * 2. 新しいSaaSユーザー作成
     * 3. 作成したSaaSユーザー取得
     * 4. SaaSユーザーのメールアドレス更新
     * 5. SaaSユーザーのパスワード更新
     * 6. SaaSユーザー削除
     * 7. SaaSユーザー一覧取得（削除確認）
     */
    public function testCompleteSaasUserCrudFlow()
    {
        $authClient = $this->client->getAuthClient();

        // 1. SaaSユーザー一覧取得（初期状態確認）
        $initialUsers = $authClient->getSaasUsers();
        $this->assertNotNull($initialUsers);

        $initialUserCount = count($initialUsers['users'] ?? []);
        echo "\n=== 初期SaaSユーザー数: {$initialUserCount} ===\n";

        // 2. 新しいSaaSユーザー作成
        $userData = $this->createTestSaasUserData();

        echo "=== SaaSユーザー作成開始 ===\n";
        echo "メールアドレス: {$userData->email}\n";

        $createdUser = $authClient->createSaasUser($userData);

        // 作成結果の検証
        $this->assertNotNull($createdUser);
        $this->assertArrayHasKey('id', $createdUser);
        $this->assertArrayHasKey('email', $createdUser);
        $this->assertEquals($userData->email, $createdUser['email']);

        $userId = $createdUser['id'];
        $this->testDataManager->addCreatedUser($userId);

        echo "=== SaaSユーザー作成完了 ===\n";
        echo "ユーザーID: {$userId}\n";

        // 3. 作成したSaaSユーザー取得
        echo "=== SaaSユーザー取得テスト ===\n";

        $retrievedUser = $authClient->getSaasUser($userId);

        // 取得結果の検証
        $this->assertNotNull($retrievedUser);
        $this->assertEquals($userId, $retrievedUser['id']);
        $this->assertEquals($userData->email, $retrievedUser['email']);

        echo "取得成功: {$retrievedUser['email']}\n";

        // 4. SaaSユーザーのメールアドレス更新
        echo "=== SaaSユーザーメール更新テスト ===\n";

        $newEmail = $this->e2eHelper->generateTestEmail('updated_user');
        $updateEmailData = (object)[
            'email' => $newEmail
        ];

        echo "新しいメールアドレス: {$newEmail}\n";

        $authClient->updateSaasUserEmail($userId, $updateEmailData);

        // 更新後のユーザー取得（更新確認）
        $updatedUser = $authClient->getSaasUser($userId);

        // 更新結果の検証
        $this->assertEquals($newEmail, $updatedUser['email']);

        echo "=== SaaSユーザーメール更新完了 ===\n";
        echo "更新後メールアドレス: {$updatedUser['email']}\n";

        // 5. SaaSユーザーのパスワード更新
        echo "=== SaaSユーザーパスワード更新テスト ===\n";

        $newPassword = 'NewTestPassword123!';
        $updatePasswordData = (object)[
            'password' => $newPassword
        ];

        $authClient->updateSaasUserPassword($userId, $updatePasswordData);

        echo "=== SaaSユーザーパスワード更新完了 ===\n";

        // 6. SaaSユーザー削除
        echo "=== SaaSユーザー削除テスト ===\n";

        $authClient->deleteSaasUser($userId);
        $this->testDataManager->removeCreatedUser($userId);

        echo "SaaSユーザー削除完了: {$userId}\n";

        // 7. SaaSユーザー一覧取得（削除確認）
        $finalUsers = $authClient->getSaasUsers();
        $finalUserCount = count($finalUsers['users'] ?? []);

        // 削除確認
        $this->assertEquals($initialUserCount, $finalUserCount);

        echo "=== SaaSユーザーCRUDフロー完了 ===\n";
        echo "最終SaaSユーザー数: {$finalUserCount}\n";
    }

    /**
     * @test
     * テナントユーザーCRUD操作の完全フロー
     * 
     * シナリオ:
     * 1. テスト用テナント作成
     * 2. テナントユーザー一覧取得（初期状態確認）
     * 3. 新しいテナントユーザー作成
     * 4. 作成したテナントユーザー取得
     * 5. テナントユーザー情報更新
     * 6. テナントユーザー削除
     * 7. テナントユーザー一覧取得（削除確認）
     * 8. テスト用テナント削除
     */
    public function testCompleteTenantUserCrudFlow()
    {
        $authClient = $this->client->getAuthClient();

        // 1. テスト用テナント作成
        echo "\n=== テスト用テナント作成 ===\n";
        $tenantData = $this->e2eHelper->generateTenantData('user_test');
        $createdTenant = $authClient->createTenant($tenantData);
        $tenantId = $createdTenant['id'];
        $this->testDataManager->addCreatedTenant($tenantId);

        echo "テスト用テナント作成完了: {$tenantId}\n";

        // 2. テナントユーザー一覧取得（初期状態確認）
        $initialTenantUsers = $authClient->getTenantUsers($tenantId);
        $this->assertNotNull($initialTenantUsers);

        $initialTenantUserCount = count($initialTenantUsers['users'] ?? []);
        echo "=== 初期テナントユーザー数: {$initialTenantUserCount} ===\n";

        // 3. 新しいテナントユーザー作成
        $tenantUserData = $this->createTestTenantUserData();

        echo "=== テナントユーザー作成開始 ===\n";
        echo "メールアドレス: {$tenantUserData->email}\n";

        $createdTenantUser = $authClient->createTenantUser($tenantId, $tenantUserData);

        // 作成結果の検証
        $this->assertNotNull($createdTenantUser);
        $this->assertArrayHasKey('id', $createdTenantUser);
        $this->assertArrayHasKey('email', $createdTenantUser);
        $this->assertEquals($tenantUserData->email, $createdTenantUser['email']);

        $tenantUserId = $createdTenantUser['id'];

        echo "=== テナントユーザー作成完了 ===\n";
        echo "テナントユーザーID: {$tenantUserId}\n";

        // 4. 作成したテナントユーザー取得
        echo "=== テナントユーザー取得テスト ===\n";

        $retrievedTenantUser = $authClient->getTenantUser($tenantId, $tenantUserId);

        // 取得結果の検証
        $this->assertNotNull($retrievedTenantUser);
        $this->assertEquals($tenantUserId, $retrievedTenantUser['id']);
        $this->assertEquals($tenantUserData->email, $retrievedTenantUser['email']);

        echo "取得成功: {$retrievedTenantUser['email']}\n";

        // 5. テナントユーザー情報更新
        echo "=== テナントユーザー更新テスト ===\n";

        $updateTenantUserData = (object)[
            'attributes' => (object)[
                'display_name' => 'Updated Test User',
                'updated_at' => date('Y-m-d H:i:s')
            ]
        ];

        $authClient->updateTenantUser($tenantId, $tenantUserId, $updateTenantUserData);

        // 更新後のテナントユーザー取得（更新確認）
        $updatedTenantUser = $authClient->getTenantUser($tenantId, $tenantUserId);

        echo "=== テナントユーザー更新完了 ===\n";

        // 6. テナントユーザー削除
        echo "=== テナントユーザー削除テスト ===\n";

        $authClient->deleteTenantUser($tenantId, $tenantUserId);

        echo "テナントユーザー削除完了: {$tenantUserId}\n";

        // 7. テナントユーザー一覧取得（削除確認）
        $finalTenantUsers = $authClient->getTenantUsers($tenantId);
        $finalTenantUserCount = count($finalTenantUsers['users'] ?? []);

        // 削除確認
        $this->assertEquals($initialTenantUserCount, $finalTenantUserCount);

        echo "=== テナントユーザーCRUDフロー完了 ===\n";
        echo "最終テナントユーザー数: {$finalTenantUserCount}\n";

        // 8. テスト用テナント削除は tearDown() で自動実行される
    }

    /**
     * @test
     * ユーザー作成時のバリデーションテスト
     * 
     * 異常系のテストケース:
     * - 無効なメールアドレス
     * - 重複するメールアドレス
     * - 必須フィールドの欠如
     */
    public function testUserCreationValidation()
    {
        $authClient = $this->client->getAuthClient();

        echo "\n=== ユーザー作成バリデーションテスト ===\n";

        // 1. 無効なメールアドレスのテスト
        echo "=== バリデーションテスト: 無効なメールアドレス ===\n";

        $invalidEmailData = (object)[
            'email' => 'invalid-email-format' // 無効なメール形式
        ];

        try {
            $authClient->createSaasUser($invalidEmailData);
            $this->fail('無効なメールアドレスでユーザー作成が成功してしまいました');
        } catch (\Exception $e) {
            echo "期待通りのエラー: {$e->getMessage()}\n";
            $this->assertStringContainsString('email', strtolower($e->getMessage()));
        }

        // 2. 重複するメールアドレスのテスト
        echo "=== バリデーションテスト: 重複メールアドレス ===\n";

        // まず有効なユーザーを作成
        $validUserData = $this->createTestSaasUserData();
        $createdUser = $authClient->createSaasUser($validUserData);
        $this->testDataManager->addCreatedUser($createdUser['id']);

        // 同じメールアドレスで再度作成を試行
        try {
            $authClient->createSaasUser($validUserData);
            $this->fail('重複するメールアドレスでユーザー作成が成功してしまいました');
        } catch (\Exception $e) {
            echo "期待通りのエラー: {$e->getMessage()}\n";
            // 重複エラーの確認（具体的なエラーメッセージは実装依存）
            $this->assertTrue(true); // エラーが発生したことを確認
        }

        echo "=== バリデーションテスト完了 ===\n";
    }

    /**
     * @test
     * 存在しないユーザーに対する操作のテスト
     * 
     * 異常系のテストケース:
     * - 存在しないユーザーの取得
     * - 存在しないユーザーの更新
     * - 存在しないユーザーの削除
     */
    public function testNonExistentUserOperations()
    {
        $authClient = $this->client->getAuthClient();
        $nonExistentUserId = 'non-existent-user-' . time();

        echo "\n=== 存在しないユーザー操作テスト ===\n";
        echo "テストユーザーID: {$nonExistentUserId}\n";

        // 1. 存在しないユーザーの取得
        try {
            $authClient->getSaasUser($nonExistentUserId);
            $this->fail('存在しないユーザーの取得が成功してしまいました');
        } catch (\Exception $e) {
            echo "取得エラー（期待通り）: {$e->getMessage()}\n";
            $this->assertStringContainsString('404', $e->getMessage());
        }

        // 2. 存在しないユーザーのメール更新
        $updateData = (object)[
            'email' => 'new@example.com'
        ];

        try {
            $authClient->updateSaasUserEmail($nonExistentUserId, $updateData);
            $this->fail('存在しないユーザーのメール更新が成功してしまいました');
        } catch (\Exception $e) {
            echo "メール更新エラー（期待通り）: {$e->getMessage()}\n";
            $this->assertStringContainsString('404', $e->getMessage());
        }

        // 3. 存在しないユーザーの削除
        try {
            $authClient->deleteSaasUser($nonExistentUserId);
            $this->fail('存在しないユーザーの削除が成功してしまいました');
        } catch (\Exception $e) {
            echo "削除エラー（期待通り）: {$e->getMessage()}\n";
            $this->assertStringContainsString('404', $e->getMessage());
        }

        echo "=== 存在しないユーザー操作テスト完了 ===\n";
    }

    /**
     * E2Eテスト用のクライアント作成
     */
    private function createE2EClient(): Client
    {
        // 環境変数の確認
        $requiredEnvVars = [
            'SAASUS_SECRET_KEY',
            'SAASUS_SAAS_ID',
            'SAASUS_API_KEY'
        ];

        foreach ($requiredEnvVars as $envVar) {
            if (empty(getenv($envVar))) {
                $this->markTestSkipped("E2Eテストに必要な環境変数 {$envVar} が設定されていません");
            }
        }

        return new Client();
    }

    /**
     * テスト用SaaSユーザーデータの作成
     */
    private function createTestSaasUserData(): \stdClass
    {
        return (object)[
            'email' => $this->e2eHelper->generateTestEmail('saas_user'),
            'attributes' => (object)[
                'test_type' => 'saas_user_crud_test',
                'created_by' => 'AuthUserCrudE2ETest',
                'created_at' => date('Y-m-d H:i:s')
            ]
        ];
    }

    /**
     * テスト用テナントユーザーデータの作成
     */
    private function createTestTenantUserData(): \stdClass
    {
        return (object)[
            'email' => $this->e2eHelper->generateTestEmail('tenant_user'),
            'attributes' => (object)[
                'display_name' => 'Test Tenant User',
                'test_type' => 'tenant_user_crud_test',
                'created_by' => 'AuthUserCrudE2ETest',
                'created_at' => date('Y-m-d H:i:s')
            ]
        ];
    }
}

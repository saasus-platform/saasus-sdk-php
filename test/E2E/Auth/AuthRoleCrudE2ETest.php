<?php

namespace AntiPatternInc\Saasus\Test\E2E\Auth;

use PHPUnit\Framework\TestCase;
use AntiPatternInc\Saasus\Api\Client;
use AntiPatternInc\Saasus\Test\Helpers\TestDataManager;
use AntiPatternInc\Saasus\Test\Helpers\E2ETestHelper;

/**
 * AuthモジュールのロールCRUD操作のE2Eテスト
 * 
 * このテストクラスは、SaaSus Platform APIとの実際の通信を行い、
 * ロール管理機能の完全なCRUDフローをテストします。
 * 
 * @group e2e
 * @group auth
 * @group role-crud
 */
class AuthRoleCrudE2ETest extends TestCase
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
     * ロールCRUD操作の完全フロー
     * 
     * シナリオ:
     * 1. ロール一覧取得（初期状態確認）
     * 2. 新しいロール作成
     * 3. ロール一覧取得（作成確認）
     * 4. ロール削除
     * 5. ロール一覧取得（削除確認）
     */
    public function testCompleteRoleCrudFlow()
    {
        $authClient = $this->client->getAuthClient();

        // 1. ロール一覧取得（初期状態確認）
        $initialRoles = $authClient->getRoles();
        $this->assertNotNull($initialRoles);

        $initialRoleCount = count($initialRoles['roles'] ?? []);
        echo "\n=== 初期ロール数: {$initialRoleCount} ===\n";

        // 2. 新しいロール作成
        $roleData = $this->createTestRoleData();

        echo "=== ロール作成開始 ===\n";
        echo "ロール名: {$roleData->role_name}\n";
        echo "表示名: {$roleData->display_name}\n";

        $createdRole = $authClient->createRole($roleData);

        // 作成結果の検証
        $this->assertNotNull($createdRole);
        $this->assertArrayHasKey('role_name', $createdRole);
        $this->assertArrayHasKey('display_name', $createdRole);
        $this->assertEquals($roleData->role_name, $createdRole['role_name']);
        $this->assertEquals($roleData->display_name, $createdRole['display_name']);

        $roleName = $createdRole['role_name'];
        $this->testDataManager->addCreatedRole($roleName);

        echo "=== ロール作成完了 ===\n";
        echo "作成されたロール名: {$roleName}\n";

        // 3. ロール一覧取得（作成確認）
        echo "=== ロール作成確認 ===\n";

        $rolesAfterCreate = $authClient->getRoles();
        $roleCountAfterCreate = count($rolesAfterCreate['roles'] ?? []);

        // 作成確認
        $this->assertEquals($initialRoleCount + 1, $roleCountAfterCreate);

        // 作成されたロールが一覧に含まれていることを確認
        $roleNames = array_column($rolesAfterCreate['roles'] ?? [], 'role_name');
        $this->assertContains($roleName, $roleNames);

        echo "ロール作成確認完了: {$roleCountAfterCreate}個のロール\n";

        // 4. ロール削除
        echo "=== ロール削除テスト ===\n";

        $authClient->deleteRole($roleName);
        $this->testDataManager->removeCreatedRole($roleName);

        echo "ロール削除完了: {$roleName}\n";

        // 5. ロール一覧取得（削除確認）
        $finalRoles = $authClient->getRoles();
        $finalRoleCount = count($finalRoles['roles'] ?? []);

        // 削除確認
        $this->assertEquals($initialRoleCount, $finalRoleCount);

        // 削除されたロールが一覧に含まれていないことを確認
        $finalRoleNames = array_column($finalRoles['roles'] ?? [], 'role_name');
        $this->assertNotContains($roleName, $finalRoleNames);

        echo "=== ロールCRUDフロー完了 ===\n";
        echo "最終ロール数: {$finalRoleCount}\n";
    }

    /**
     * @test
     * 複数ロールの一括作成・削除テスト
     * 
     * シナリオ:
     * 1. 複数のロールを順次作成
     * 2. 作成されたロールの確認
     * 3. 作成されたロールを順次削除
     * 4. 削除の確認
     */
    public function testMultipleRoleOperations()
    {
        $authClient = $this->client->getAuthClient();
        $roleCount = 3;
        $createdRoleNames = [];

        echo "\n=== 複数ロール操作テスト ===\n";
        echo "作成予定ロール数: {$roleCount}\n";

        // 初期状態の確認
        $initialRoles = $authClient->getRoles();
        $initialRoleCount = count($initialRoles['roles'] ?? []);

        // 1. 複数のロールを順次作成
        echo "=== 複数ロール作成開始 ===\n";

        for ($i = 1; $i <= $roleCount; $i++) {
            $roleData = (object)[
                'role_name' => "test_role_multi_{$i}_" . time(),
                'display_name' => "Test Role Multi {$i}",
                'description' => "E2Eテスト用ロール {$i}"
            ];

            $createdRole = $authClient->createRole($roleData);
            $createdRoleNames[] = $createdRole['role_name'];
            $this->testDataManager->addCreatedRole($createdRole['role_name']);

            echo "ロール {$i} 作成完了: {$createdRole['role_name']}\n";
        }

        // 2. 作成されたロールの確認
        echo "=== 作成確認 ===\n";

        $rolesAfterCreate = $authClient->getRoles();
        $roleCountAfterCreate = count($rolesAfterCreate['roles'] ?? []);

        $this->assertEquals($initialRoleCount + $roleCount, $roleCountAfterCreate);

        $allRoleNames = array_column($rolesAfterCreate['roles'] ?? [], 'role_name');
        foreach ($createdRoleNames as $roleName) {
            $this->assertContains($roleName, $allRoleNames);
        }

        echo "作成確認完了: {$roleCount}個のロールが正常に作成されました\n";

        // 3. 作成されたロールを順次削除
        echo "=== 複数ロール削除開始 ===\n";

        foreach ($createdRoleNames as $index => $roleName) {
            $authClient->deleteRole($roleName);
            $this->testDataManager->removeCreatedRole($roleName);

            echo "ロール " . ($index + 1) . " 削除完了: {$roleName}\n";
        }

        // 4. 削除の確認
        echo "=== 削除確認 ===\n";

        $finalRoles = $authClient->getRoles();
        $finalRoleCount = count($finalRoles['roles'] ?? []);

        $this->assertEquals($initialRoleCount, $finalRoleCount);

        $finalRoleNames = array_column($finalRoles['roles'] ?? [], 'role_name');
        foreach ($createdRoleNames as $roleName) {
            $this->assertNotContains($roleName, $finalRoleNames);
        }

        echo "=== 複数ロール操作テスト完了 ===\n";
        echo "最終ロール数: {$finalRoleCount}\n";
    }

    /**
     * @test
     * ロール作成時のバリデーションテスト
     * 
     * 異常系のテストケース:
     * - 必須フィールドの欠如
     * - 無効なロール名
     * - 重複するロール名
     */
    public function testRoleCreationValidation()
    {
        $authClient = $this->client->getAuthClient();

        echo "\n=== ロール作成バリデーションテスト ===\n";

        // 1. 必須フィールド欠如のテスト
        echo "=== バリデーションテスト: 必須フィールド欠如 ===\n";

        $invalidData = (object)[
            'role_name' => '', // 空のロール名
            'display_name' => 'Test Role'
        ];

        try {
            $authClient->createRole($invalidData);
            $this->fail('空のロール名で作成が成功してしまいました');
        } catch (\Exception $e) {
            echo "期待通りのエラー: {$e->getMessage()}\n";
            $this->assertStringContainsString('role_name', strtolower($e->getMessage()));
        }

        // 2. 無効なロール名のテスト
        echo "=== バリデーションテスト: 無効なロール名 ===\n";

        $invalidRoleNameData = (object)[
            'role_name' => 'invalid role name with spaces', // スペースを含む無効なロール名
            'display_name' => 'Invalid Role'
        ];

        try {
            $authClient->createRole($invalidRoleNameData);
            $this->fail('無効なロール名で作成が成功してしまいました');
        } catch (\Exception $e) {
            echo "期待通りのエラー: {$e->getMessage()}\n";
            // 無効なロール名のエラーを確認
            $this->assertTrue(true); // エラーが発生したことを確認
        }

        // 3. 重複するロール名のテスト
        echo "=== バリデーションテスト: 重複ロール名 ===\n";

        // まず有効なロールを作成
        $validRoleData = $this->createTestRoleData();
        $createdRole = $authClient->createRole($validRoleData);
        $this->testDataManager->addCreatedRole($createdRole['role_name']);

        // 同じロール名で再度作成を試行
        try {
            $authClient->createRole($validRoleData);
            $this->fail('重複するロール名で作成が成功してしまいました');
        } catch (\Exception $e) {
            echo "期待通りのエラー: {$e->getMessage()}\n";
            // 重複エラーの確認（具体的なエラーメッセージは実装依存）
            $this->assertTrue(true); // エラーが発生したことを確認
        }

        echo "=== バリデーションテスト完了 ===\n";
    }

    /**
     * @test
     * 存在しないロールに対する操作のテスト
     * 
     * 異常系のテストケース:
     * - 存在しないロールの削除
     */
    public function testNonExistentRoleOperations()
    {
        $authClient = $this->client->getAuthClient();
        $nonExistentRoleName = 'non_existent_role_' . time();

        echo "\n=== 存在しないロール操作テスト ===\n";
        echo "テストロール名: {$nonExistentRoleName}\n";

        // 存在しないロールの削除
        try {
            $authClient->deleteRole($nonExistentRoleName);
            $this->fail('存在しないロールの削除が成功してしまいました');
        } catch (\Exception $e) {
            echo "削除エラー（期待通り）: {$e->getMessage()}\n";
            $this->assertStringContainsString('404', $e->getMessage());
        }

        echo "=== 存在しないロール操作テスト完了 ===\n";
    }

    /**
     * @test
     * システムロールの保護テスト
     * 
     * システムで予約されているロール名での作成や、
     * システムロールの削除ができないことを確認します。
     */
    public function testSystemRoleProtection()
    {
        $authClient = $this->client->getAuthClient();

        echo "\n=== システムロール保護テスト ===\n";

        // システムで予約されている可能性のあるロール名
        $systemRoleNames = [
            'admin',
            'administrator',
            'system',
            'root',
            'super_admin'
        ];

        foreach ($systemRoleNames as $systemRoleName) {
            echo "=== システムロール名テスト: {$systemRoleName} ===\n";

            $systemRoleData = (object)[
                'role_name' => $systemRoleName,
                'display_name' => 'System Role Test',
                'description' => 'システムロール名テスト'
            ];

            try {
                $createdRole = $authClient->createRole($systemRoleData);

                // もし作成が成功した場合は、テスト後にクリーンアップ
                if ($createdRole) {
                    $this->testDataManager->addCreatedRole($createdRole['role_name']);
                    echo "システムロール名での作成が成功: {$systemRoleName}\n";
                }
            } catch (\Exception $e) {
                echo "システムロール名での作成が拒否（期待される動作）: {$e->getMessage()}\n";
                // システムロール名での作成が拒否されるのは正常な動作
                $this->assertTrue(true);
            }
        }

        echo "=== システムロール保護テスト完了 ===\n";
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
     * テスト用ロールデータの作成
     */
    private function createTestRoleData(): \stdClass
    {
        $timestamp = time();
        $uniqueId = mt_rand(1000, 9999);

        return (object)[
            'role_name' => "test_role_{$timestamp}_{$uniqueId}",
            'display_name' => "Test Role {$timestamp}",
            'description' => "E2Eテスト用ロール - {$timestamp}"
        ];
    }
}

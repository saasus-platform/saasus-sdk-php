<?php

namespace AntiPatternInc\Saasus\Test\Helpers;

use AntiPatternInc\Saasus\Api\Client;

/**
 * テストデータ管理クラス
 * 
 * E2Eテストで作成されたリソースの追跡と自動クリーンアップを行います。
 */
class TestDataManager
{
    private array $createdTenants = [];
    private array $createdUsers = [];
    private array $createdRoles = [];
    private array $createdEnvs = [];
    private ?Client $client = null;

    public function __construct(?Client $client = null)
    {
        $this->client = $client;
    }

    /**
     * 作成されたテナントIDを追跡に追加
     */
    public function addCreatedTenant(string $tenantId): void
    {
        $this->createdTenants[] = $tenantId;
        echo "[TestDataManager] テナント追跡追加: {$tenantId}\n";
    }

    /**
     * 削除されたテナントIDを追跡から除去
     */
    public function removeCreatedTenant(string $tenantId): void
    {
        $this->createdTenants = array_filter($this->createdTenants, function ($id) use ($tenantId) {
            return $id !== $tenantId;
        });
        echo "[TestDataManager] テナント追跡除去: {$tenantId}\n";
    }

    /**
     * 作成されたユーザーIDを追跡に追加
     */
    public function addCreatedUser(string $userId): void
    {
        $this->createdUsers[] = $userId;
        echo "[TestDataManager] ユーザー追跡追加: {$userId}\n";
    }

    /**
     * 削除されたユーザーIDを追跡から除去
     */
    public function removeCreatedUser(string $userId): void
    {
        $this->createdUsers = array_filter($this->createdUsers, function ($id) use ($userId) {
            return $id !== $userId;
        });
        echo "[TestDataManager] ユーザー追跡除去: {$userId}\n";
    }

    /**
     * 作成されたロール名を追跡に追加
     */
    public function addCreatedRole(string $roleName): void
    {
        $this->createdRoles[] = $roleName;
        echo "[TestDataManager] ロール追跡追加: {$roleName}\n";
    }

    /**
     * 削除されたロール名を追跡から除去
     */
    public function removeCreatedRole(string $roleName): void
    {
        $this->createdRoles = array_filter($this->createdRoles, function ($name) use ($roleName) {
            return $name !== $roleName;
        });
        echo "[TestDataManager] ロール追跡除去: {$roleName}\n";
    }

    /**
     * 作成された環境IDを追跡に追加
     */
    public function addCreatedEnv(int $envId): void
    {
        $this->createdEnvs[] = $envId;
        echo "[TestDataManager] 環境追跡追加: {$envId}\n";
    }

    /**
     * 削除された環境IDを追跡から除去
     */
    public function removeCreatedEnv(int $envId): void
    {
        $this->createdEnvs = array_filter($this->createdEnvs, function ($id) use ($envId) {
            return $id !== $envId;
        });
        echo "[TestDataManager] 環境追跡除去: {$envId}\n";
    }

    /**
     * 追跡中のリソース数を取得
     */
    public function getTrackedResourceCounts(): array
    {
        return [
            'tenants' => count($this->createdTenants),
            'users' => count($this->createdUsers),
            'roles' => count($this->createdRoles),
            'envs' => count($this->createdEnvs)
        ];
    }

    /**
     * 全ての追跡中リソースをクリーンアップ
     */
    public function cleanup(): void
    {
        $counts = $this->getTrackedResourceCounts();
        $totalResources = array_sum($counts);

        if ($totalResources === 0) {
            echo "[TestDataManager] クリーンアップ対象なし\n";
            return;
        }

        echo "[TestDataManager] クリーンアップ開始 - 対象リソース数: {$totalResources}\n";
        echo "  - テナント: {$counts['tenants']}\n";
        echo "  - ユーザー: {$counts['users']}\n";
        echo "  - ロール: {$counts['roles']}\n";
        echo "  - 環境: {$counts['envs']}\n";

        if ($this->client === null) {
            echo "[TestDataManager] 警告: クライアントが設定されていないため、自動クリーンアップをスキップします\n";
            $this->clearTracking();
            return;
        }

        $this->cleanupTenants();
        $this->cleanupUsers();
        $this->cleanupRoles();
        $this->cleanupEnvs();

        echo "[TestDataManager] クリーンアップ完了\n";
    }

    /**
     * 追跡中のテナントをクリーンアップ
     */
    private function cleanupTenants(): void
    {
        if (empty($this->createdTenants)) {
            return;
        }

        echo "[TestDataManager] テナントクリーンアップ開始\n";
        $authClient = $this->client->getAuthClient();

        foreach ($this->createdTenants as $tenantId) {
            try {
                $authClient->deleteTenant($tenantId);
                echo "[TestDataManager] テナント削除成功: {$tenantId}\n";
            } catch (\Exception $e) {
                echo "[TestDataManager] テナント削除失敗: {$tenantId} - {$e->getMessage()}\n";
            }
        }

        $this->createdTenants = [];
    }

    /**
     * 追跡中のユーザーをクリーンアップ
     */
    private function cleanupUsers(): void
    {
        if (empty($this->createdUsers)) {
            return;
        }

        echo "[TestDataManager] ユーザークリーンアップ開始\n";
        $authClient = $this->client->getAuthClient();

        foreach ($this->createdUsers as $userId) {
            try {
                $authClient->deleteSaasUser($userId);
                echo "[TestDataManager] ユーザー削除成功: {$userId}\n";
            } catch (\Exception $e) {
                echo "[TestDataManager] ユーザー削除失敗: {$userId} - {$e->getMessage()}\n";
            }
        }

        $this->createdUsers = [];
    }

    /**
     * 追跡中のロールをクリーンアップ
     */
    private function cleanupRoles(): void
    {
        if (empty($this->createdRoles)) {
            return;
        }

        echo "[TestDataManager] ロールクリーンアップ開始\n";
        $authClient = $this->client->getAuthClient();

        foreach ($this->createdRoles as $roleName) {
            try {
                $authClient->deleteRole($roleName);
                echo "[TestDataManager] ロール削除成功: {$roleName}\n";
            } catch (\Exception $e) {
                echo "[TestDataManager] ロール削除失敗: {$roleName} - {$e->getMessage()}\n";
            }
        }

        $this->createdRoles = [];
    }

    /**
     * 追跡中の環境をクリーンアップ
     */
    private function cleanupEnvs(): void
    {
        if (empty($this->createdEnvs)) {
            return;
        }

        echo "[TestDataManager] 環境クリーンアップ開始\n";
        $authClient = $this->client->getAuthClient();

        foreach ($this->createdEnvs as $envId) {
            try {
                // 環境ID 3は削除できないのでスキップ
                if ($envId === 3) {
                    echo "[TestDataManager] 環境削除スキップ（削除不可）: {$envId}\n";
                    continue;
                }

                $authClient->deleteEnv($envId);
                echo "[TestDataManager] 環境削除成功: {$envId}\n";
            } catch (\Exception $e) {
                echo "[TestDataManager] 環境削除失敗: {$envId} - {$e->getMessage()}\n";
            }
        }

        $this->createdEnvs = [];
    }

    /**
     * 追跡情報をクリア（リソースの削除は行わない）
     */
    private function clearTracking(): void
    {
        $this->createdTenants = [];
        $this->createdUsers = [];
        $this->createdRoles = [];
        $this->createdEnvs = [];
        echo "[TestDataManager] 追跡情報をクリアしました\n";
    }
}

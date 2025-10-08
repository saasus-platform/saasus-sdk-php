<?php

namespace AntiPatternInc\Saasus\Test\Helpers;

use AntiPatternInc\Saasus\Api\Client;

/**
 * E2Eテストヘルパークラス
 * 
 * E2Eテストで共通して使用される機能を提供します。
 */
class E2ETestHelper
{
    private array $requiredEnvVars = [
        'SAASUS_SECRET_KEY',
        'SAASUS_SAAS_ID',
        'SAASUS_API_KEY'
    ];

    /**
     * テスト環境の検証
     *
     * 必要な環境変数が設定されているかチェックします。
     */
    public function verifyTestEnvironment(): void
    {
        echo "[E2ETestHelper] テスト環境検証開始\n";

        // .envファイルの読み込みを試行
        $this->loadEnvFile();

        $missingVars = [];
        foreach ($this->requiredEnvVars as $envVar) {
            $value = getenv($envVar);
            if (empty($value)) {
                $missingVars[] = $envVar;
            } else {
                echo "[E2ETestHelper] ✓ {$envVar}: 設定済み\n";
            }
        }

        if (!empty($missingVars)) {
            $message = "E2Eテストに必要な環境変数が設定されていません: " . implode(', ', $missingVars);
            echo "[E2ETestHelper] ✗ {$message}\n";
            echo "[E2ETestHelper] プロジェクトルートに .env または .env.testing ファイルを作成するか、\n";
            echo "[E2ETestHelper] 環境変数を直接設定してください。\n";
            throw new \Exception($message);
        }

        // API接続テスト
        $this->verifyApiConnection();

        echo "[E2ETestHelper] テスト環境検証完了\n";
    }

    /**
     * .envファイルの読み込み
     */
    private function loadEnvFile(): void
    {
        $envFiles = ['.env.testing', '.env'];
        $projectRoot = dirname(dirname(__DIR__)); // test/Helpers から2階層上

        foreach ($envFiles as $envFile) {
            $envPath = $projectRoot . '/' . $envFile;
            if (file_exists($envPath)) {
                echo "[E2ETestHelper] .envファイル読み込み: {$envFile}\n";

                $lines = file($envPath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
                foreach ($lines as $line) {
                    $line = trim($line);

                    // コメント行をスキップ
                    if (strpos($line, '#') === 0 || empty($line)) {
                        continue;
                    }

                    // KEY=VALUE形式の処理
                    if (strpos($line, '=') !== false) {
                        list($name, $value) = explode('=', $line, 2);
                        $name = trim($name);
                        $value = trim($value, " \t\n\r\0\x0B\"'"); // 前後の空白と引用符を除去

                        // 既に環境変数が設定されていない場合のみ設定
                        if (getenv($name) === false) {
                            putenv("$name=$value");
                            $_ENV[$name] = $value;
                            $_SERVER[$name] = $value;
                        }
                    }
                }

                echo "[E2ETestHelper] .envファイル読み込み完了: {$envFile}\n";
                break; // 最初に見つかったファイルのみ読み込み
            }
        }
    }

    /**
     * API接続の検証
     */
    private function verifyApiConnection(): void
    {
        echo "[E2ETestHelper] API接続テスト開始\n";

        try {
            $client = new Client();
            $authClient = $client->getAuthClient();

            // 基本情報取得でAPI接続をテスト
            $basicInfo = $authClient->getBasicInfo();

            if ($basicInfo !== null) {
                echo "[E2ETestHelper] ✓ API接続: 成功\n";
            } else {
                throw new \Exception("API接続は成功したが、レスポンスがnullです");
            }
        } catch (\Exception $e) {
            $message = "API接続テストに失敗しました: " . $e->getMessage();
            echo "[E2ETestHelper] ✗ {$message}\n";
            throw new \Exception($message);
        }
    }

    /**
     * テスト用のユニークな文字列を生成
     */
    public function generateUniqueString(string $prefix = 'test'): string
    {
        return $prefix . '_' . time() . '_' . mt_rand(1000, 9999);
    }

    /**
     * テスト用のメールアドレスを生成
     */
    public function generateTestEmail(string $prefix = 'test'): string
    {
        return $this->generateUniqueString($prefix) . '@example.com';
    }

    /**
     * テスト実行時間を測定
     */
    public function measureExecutionTime(callable $callback): array
    {
        $startTime = microtime(true);
        $startMemory = memory_get_usage(true);

        $result = $callback();

        $endTime = microtime(true);
        $endMemory = memory_get_usage(true);

        return [
            'result' => $result,
            'execution_time' => $endTime - $startTime,
            'memory_usage' => $endMemory - $startMemory,
            'peak_memory' => memory_get_peak_usage(true)
        ];
    }

    /**
     * レスポンス構造の検証
     */
    public function validateResponseStructure(array $response, array $requiredFields): bool
    {
        foreach ($requiredFields as $field) {
            if (!array_key_exists($field, $response)) {
                echo "[E2ETestHelper] ✗ 必須フィールドが不足: {$field}\n";
                return false;
            }
        }

        echo "[E2ETestHelper] ✓ レスポンス構造: 正常\n";
        return true;
    }

    /**
     * テスト結果のサマリーを出力
     */
    public function outputTestSummary(array $metrics): void
    {
        echo "\n=== テスト実行サマリー ===\n";

        if (isset($metrics['execution_time'])) {
            echo "実行時間: " . round($metrics['execution_time'], 3) . "秒\n";
        }

        if (isset($metrics['memory_usage'])) {
            echo "メモリ使用量: " . $this->formatBytes($metrics['memory_usage']) . "\n";
        }

        if (isset($metrics['peak_memory'])) {
            echo "ピークメモリ: " . $this->formatBytes($metrics['peak_memory']) . "\n";
        }

        if (isset($metrics['api_calls'])) {
            echo "API呼び出し回数: " . $metrics['api_calls'] . "\n";
        }

        echo "========================\n\n";
    }

    /**
     * バイト数を人間が読みやすい形式に変換
     */
    private function formatBytes(int $bytes): string
    {
        $units = ['B', 'KB', 'MB', 'GB'];
        $unitIndex = 0;

        while ($bytes >= 1024 && $unitIndex < count($units) - 1) {
            $bytes /= 1024;
            $unitIndex++;
        }

        return round($bytes, 2) . ' ' . $units[$unitIndex];
    }

    /**
     * テスト用のテナントデータを生成
     */
    public function generateTenantData(string $suffix = ''): \stdClass
    {
        $uniqueId = $this->generateUniqueString('tenant');
        if (!empty($suffix)) {
            $uniqueId .= '_' . $suffix;
        }

        return (object)[
            'name' => "Test Tenant {$uniqueId}",
            'back_office_staff_email' => $this->generateTestEmail('tenant'),
            'attributes' => (object)[
                'description' => "E2Eテスト用テナント - {$uniqueId}",
                'test_type' => 'e2e_test',
                'created_by' => 'E2ETestHelper',
                'created_at' => date('Y-m-d H:i:s')
            ]
        ];
    }

    /**
     * テスト用のユーザーデータを生成
     */
    public function generateUserData(string $suffix = ''): \stdClass
    {
        $uniqueId = $this->generateUniqueString('user');
        if (!empty($suffix)) {
            $uniqueId .= '_' . $suffix;
        }

        return (object)[
            'email' => $this->generateTestEmail('user'),
            'attributes' => (object)[
                'username' => "testuser_{$uniqueId}",
                'display_name' => "Test User {$uniqueId}",
                'test_type' => 'e2e_test',
                'created_by' => 'E2ETestHelper',
                'created_at' => date('Y-m-d H:i:s')
            ]
        ];
    }

    /**
     * テスト用のロールデータを生成
     */
    public function generateRoleData(string $suffix = ''): \stdClass
    {
        $uniqueId = $this->generateUniqueString('role');
        if (!empty($suffix)) {
            $uniqueId .= '_' . $suffix;
        }

        return (object)[
            'role_name' => "test_role_{$uniqueId}",
            'display_name' => "Test Role {$uniqueId}",
            'description' => "E2Eテスト用ロール - {$uniqueId}"
        ];
    }

    /**
     * テスト用の環境データを生成
     */
    public function generateEnvData(string $suffix = ''): \stdClass
    {
        $uniqueId = $this->generateUniqueString('env');
        if (!empty($suffix)) {
            $uniqueId .= '_' . $suffix;
        }

        return (object)[
            'name' => "test_env_{$uniqueId}",
            'display_name' => "Test Environment {$uniqueId}",
            'description' => "E2Eテスト用環境 - {$uniqueId}"
        ];
    }

    /**
     * APIエラーの詳細情報を取得
     */
    public function getApiErrorDetails(\Exception $exception): array
    {
        $details = [
            'message' => $exception->getMessage(),
            'code' => $exception->getCode(),
            'file' => $exception->getFile(),
            'line' => $exception->getLine()
        ];

        // HTTPクライアント例外の場合、追加情報を取得
        if (method_exists($exception, 'getResponse')) {
            $response = $exception->getResponse();
            if ($response !== null) {
                $details['http_status'] = $response->getStatusCode();
                $details['response_body'] = (string)$response->getBody();
            }
        }

        return $details;
    }

    /**
     * テスト実行前の準備処理
     */
    public function prepareTestExecution(): void
    {
        echo "[E2ETestHelper] テスト実行準備開始\n";

        // メモリ制限の確認
        $memoryLimit = ini_get('memory_limit');
        echo "[E2ETestHelper] メモリ制限: {$memoryLimit}\n";

        // 実行時間制限の確認
        $timeLimit = ini_get('max_execution_time');
        echo "[E2ETestHelper] 実行時間制限: {$timeLimit}秒\n";

        // タイムゾーンの確認
        $timezone = date_default_timezone_get();
        echo "[E2ETestHelper] タイムゾーン: {$timezone}\n";

        echo "[E2ETestHelper] テスト実行準備完了\n";
    }

    /**
     * テスト実行後のクリーンアップ処理
     */
    public function cleanupTestExecution(): void
    {
        echo "[E2ETestHelper] テスト実行クリーンアップ開始\n";

        // ガベージコレクション実行
        $collected = gc_collect_cycles();
        if ($collected > 0) {
            echo "[E2ETestHelper] ガベージコレクション: {$collected}オブジェクト回収\n";
        }

        echo "[E2ETestHelper] テスト実行クリーンアップ完了\n";
    }
}

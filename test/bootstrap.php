<?php

/**
 * SaaSus SDK for PHP - E2Eテストブートストラップ
 * 
 * E2Eテスト実行時の初期化処理を行います。
 */

// Composerオートローダーの読み込み
require_once __DIR__ . '/../vendor/autoload.php';

// テスト実行フラグの設定
if (!defined('PHPUNIT_RUNNING')) {
    define('PHPUNIT_RUNNING', true);
}

// E2Eテスト実行フラグの設定
if (!defined('E2E_TEST_RUNNING')) {
    define('E2E_TEST_RUNNING', true);
}

// 環境変数の読み込み
// 優先順位: .env.testing > .env
$envFiles = ['.env.testing', '.env'];
foreach ($envFiles as $envFile) {
    $envPath = __DIR__ . '/../' . $envFile;
    if (file_exists($envPath)) {
        // シンプルな.env読み込み（vlucas/phpdotenvを使わない）
        $lines = file($envPath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lines as $line) {
            if (strpos(trim($line), '#') === 0) {
                continue; // コメント行をスキップ
            }

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
        echo "環境変数ファイル読み込み完了: $envFile\n";
        break; // 最初に見つかったファイルのみ読み込み
    }
}

// タイムゾーンの設定
date_default_timezone_set('Asia/Tokyo');

// エラーレポートの設定
error_reporting(E_ALL);
ini_set('display_errors', 1);

// メモリ制限の設定（E2Eテストは大量のメモリを使用する可能性があります）
ini_set('memory_limit', '512M');

// 実行時間制限の設定（E2Eテストは時間がかかる場合があります）
ini_set('max_execution_time', 600); // 10分

// テストヘルパーの読み込み
require_once __DIR__ . '/Helpers/TestDataManager.php';
require_once __DIR__ . '/Helpers/E2ETestHelper.php';

// グローバルテスト設定
$GLOBALS['test_start_time'] = microtime(true);
$GLOBALS['test_data_managers'] = [];

// E2Eテスト環境の検証
function verifyE2EEnvironment(): void
{
    echo "\n=== E2Eテスト環境検証 ===\n";

    $requiredEnvVars = [
        'SAASUS_SECRET_KEY',
        'SAASUS_SAAS_ID',
        'SAASUS_API_KEY'
    ];

    $missingVars = [];
    foreach ($requiredEnvVars as $envVar) {
        $value = getenv($envVar);
        if (empty($value)) {
            $missingVars[] = $envVar;
        } else {
            echo "✓ {$envVar}: 設定済み\n";
        }
    }

    if (!empty($missingVars)) {
        echo "✗ 不足している環境変数: " . implode(', ', $missingVars) . "\n";
        echo "\n環境変数を設定してからテストを実行してください。\n";
        echo "詳細は README.md を参照してください。\n\n";
        exit(1);
    }

    // API接続テスト
    try {
        $client = new \AntiPatternInc\Saasus\Api\Client();
        $authClient = $client->getAuthClient();
        $basicInfo = $authClient->getBasicInfo();

        if ($basicInfo !== null) {
            echo "✓ SaaSus Platform API: 接続成功\n";
        } else {
            throw new Exception("API接続は成功したが、レスポンスがnullです");
        }
    } catch (Exception $e) {
        echo "✗ SaaSus Platform API接続エラー: " . $e->getMessage() . "\n";
        echo "\nAPI接続設定を確認してください。\n\n";
        exit(1);
    }

    echo "=== E2Eテスト環境検証完了 ===\n\n";
}

// テスト終了時のクリーンアップ処理
function cleanupE2EResources(): void
{
    echo "\n=== E2Eテストクリーンアップ開始 ===\n";

    $execution_time = microtime(true) - $GLOBALS['test_start_time'];
    echo "総テスト実行時間: " . round($execution_time, 2) . "秒\n";

    // 登録されたTestDataManagerのクリーンアップ
    if (isset($GLOBALS['test_data_managers']) && !empty($GLOBALS['test_data_managers'])) {
        echo "残存リソースのクリーンアップを実行中...\n";

        foreach ($GLOBALS['test_data_managers'] as $manager) {
            if ($manager instanceof \AntiPatternInc\Saasus\Test\Helpers\TestDataManager) {
                $manager->cleanup();
            }
        }
    }

    // ガベージコレクション実行
    $collected = gc_collect_cycles();
    if ($collected > 0) {
        echo "ガベージコレクション: {$collected}オブジェクト回収\n";
    }

    echo "=== E2Eテストクリーンアップ完了 ===\n";
}

// TestDataManagerの登録関数
function registerTestDataManager(\AntiPatternInc\Saasus\Test\Helpers\TestDataManager $manager): void
{
    if (!isset($GLOBALS['test_data_managers'])) {
        $GLOBALS['test_data_managers'] = [];
    }

    $GLOBALS['test_data_managers'][] = $manager;
}

// テスト実行前の環境検証（E2Eテストの場合のみ）
if (defined('E2E_TEST_RUNNING') && E2E_TEST_RUNNING) {
    verifyE2EEnvironment();
}

// テスト終了時のクリーンアップ処理を登録
register_shutdown_function('cleanupE2EResources');

// 例外ハンドラーの設定
set_exception_handler(function ($exception) {
    echo "\n=== 未処理の例外が発生しました ===\n";
    echo "例外: " . get_class($exception) . "\n";
    echo "メッセージ: " . $exception->getMessage() . "\n";
    echo "ファイル: " . $exception->getFile() . ":" . $exception->getLine() . "\n";
    echo "スタックトレース:\n" . $exception->getTraceAsString() . "\n";
    echo "================================\n";

    // クリーンアップ処理を実行
    cleanupE2EResources();

    exit(1);
});

// エラーハンドラーの設定
set_error_handler(function ($severity, $message, $file, $line) {
    // E_DEPRECATED と E_USER_DEPRECATED は無視
    if ($severity === E_DEPRECATED || $severity === E_USER_DEPRECATED) {
        return true;
    }

    echo "\n=== PHPエラーが発生しました ===\n";
    echo "重要度: {$severity}\n";
    echo "メッセージ: {$message}\n";
    echo "ファイル: {$file}:{$line}\n";
    echo "=============================\n";

    return false; // 通常のエラーハンドリングを継続
});

echo "E2Eテストブートストラップ完了\n";

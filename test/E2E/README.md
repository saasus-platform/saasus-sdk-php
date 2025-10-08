# SaaSus SDK for PHP - E2Eテストガイド

## 概要

このディレクトリには、SaaSus SDK for PHPのエンドツーエンド（E2E）テストが含まれています。E2Eテストは、実際のSaaSus Platform APIとの通信を行い、SDKの機能が期待通りに動作することを確認します。

## テスト構成

### ディレクトリ構造

```
test/E2E/
├── README.md                    # このファイル
├── Auth/                        # Auth モジュールのE2Eテスト
│   ├── AuthTenantCrudE2ETest.php   # テナントCRUD操作テスト
│   ├── AuthUserCrudE2ETest.php     # ユーザーCRUD操作テスト
│   └── AuthRoleCrudE2ETest.php     # ロールCRUD操作テスト
└── Helpers/                     # テストヘルパークラス
    ├── TestDataManager.php         # テストデータ管理
    └── E2ETestHelper.php           # E2Eテスト共通機能
```

### テストクラス一覧

#### Auth モジュール

| テストクラス | 対象機能 | テストケース数 | 説明 |
|-------------|----------|---------------|------|
| `AuthTenantCrudE2ETest` | テナント管理 | 4 | テナントの作成・取得・更新・削除の完全フロー |
| `AuthUserCrudE2ETest` | ユーザー管理 | 4 | SaaSユーザーとテナントユーザーのCRUD操作 |
| `AuthRoleCrudE2ETest` | ロール管理 | 5 | ロールの作成・削除、バリデーション、システムロール保護 |

## 環境設定

### 必須環境変数

E2Eテストを実行するには、以下の環境変数が必要です：

```bash
# SaaSus Platform API認証情報
export SAASUS_SECRET_KEY="your_secret_key"
export SAASUS_SAAS_ID="your_saas_id"
export SAASUS_API_KEY="your_api_key"

# オプション設定
export SAASUS_API_URL_BASE="https://api-test.saasus.io"  # テスト環境URL
export SAASUS_LOGIN_URL="https://auth-test.saasus.io/"
export SAASUS_AUTH_MODE="api"
```

### .envファイルによる設定（推奨）

プロジェクトルートに `.env` または `.env.testing` ファイルを作成することで、環境変数を自動的に読み込むことができます：

**優先順位**: `.env.testing` > `.env`

```bash
# .env または .env.testing
SAASUS_SECRET_KEY="your_secret_key"
SAASUS_SAAS_ID="your_saas_id"
SAASUS_API_KEY="your_api_key"
SAASUS_API_URL_BASE=https://api-test.saasus.io
SAASUS_LOGIN_URL=https://auth-test.saasus.io/
SAASUS_AUTH_MODE=api
```

**注意**:
- 引用符は省略可能ですが、値にスペースが含まれる場合は必要です
- `#` で始まる行はコメントとして扱われます
- 既に環境変数が設定されている場合、.envファイルの値は無視されます

## テスト実行方法

### 1. Docker環境での実行（推奨）

PHPやComposerのローカルインストールが不要で、統一された環境でテストを実行できます：

```bash
# 全てのE2Eテストを実行
./scripts/run-e2e-docker.sh

# 特定のテストグループのみ実行
./scripts/run-e2e-docker.sh auth           # Auth関連テスト
./scripts/run-e2e-docker.sh tenant-crud    # テナントCRUDテスト
./scripts/run-e2e-docker.sh user-crud      # ユーザーCRUDテスト
./scripts/run-e2e-docker.sh role-crud      # ロールCRUDテスト

# カバレッジレポート付きで実行
./scripts/run-e2e-docker.sh -c auth

# テスト結果をWebブラウザで確認
./scripts/run-e2e-docker.sh --web
# → http://localhost:8080 でカバレッジレポートとテスト結果を確認

# 設定確認のみ
./scripts/run-e2e-docker.sh --dry-run

# コンテナのシェルに接続（デバッグ用）
./scripts/run-e2e-docker.sh --shell
```

**詳細**: [Docker環境でのE2Eテスト実行ガイド](../../docs/DOCKER_E2E_SETUP.md)

### 2. ローカル環境での実行

PHP 8.1以上とComposerがインストールされている場合：

```bash
# 全てのE2Eテストを実行
./test/run-e2e-tests.sh

# 特定のテストグループのみ実行
./test/run-e2e-tests.sh auth           # Auth関連テスト
./test/run-e2e-tests.sh tenant-crud    # テナントCRUDテスト
./test/run-e2e-tests.sh user-crud      # ユーザーCRUDテスト
./test/run-e2e-tests.sh role-crud      # ロールCRUDテスト

# カバレッジレポート付きで実行
./test/run-e2e-tests.sh -c auth

# 詳細出力モードで実行
./test/run-e2e-tests.sh -v tenant-crud

# 設定確認のみ（実際のテストは実行しない）
./test/run-e2e-tests.sh --dry-run
```

### 2. PHPUnitを直接使用

```bash
# E2E用PHPUnit設定で実行
cd test
../vendor/bin/phpunit --configuration phpunit.e2e.xml

# 特定のテストクラスのみ実行
../vendor/bin/phpunit --configuration phpunit.e2e.xml E2E/Auth/AuthTenantCrudE2ETest.php

# 特定のテストメソッドのみ実行
../vendor/bin/phpunit --configuration phpunit.e2e.xml E2E/Auth/AuthTenantCrudE2ETest.php::testCompleteTenantCrudFlow
```

### 3. Composerスクリプト（要設定）

```bash
# composer.jsonにスクリプトを追加後
composer test:e2e
composer test:e2e:auth
```

## テストケース詳細

### AuthTenantCrudE2ETest

**テナント管理の完全CRUD操作をテスト**

- `testCompleteTenantCrudFlow()`: テナントの作成→取得→更新→削除の完全フロー
- `testTenantCreationValidation()`: テナント作成時のバリデーション（異常系）
- `testNonExistentTenantOperations()`: 存在しないテナントに対する操作（異常系）
- `testBulkTenantOperationsPerformance()`: 大量テナント操作のパフォーマンステスト

### AuthUserCrudE2ETest

**ユーザー管理の完全CRUD操作をテスト**

- `testCompleteSaasUserCrudFlow()`: SaaSユーザーの作成→取得→更新→削除
- `testCompleteTenantUserCrudFlow()`: テナントユーザーの作成→取得→更新→削除
- `testUserCreationValidation()`: ユーザー作成時のバリデーション（異常系）
- `testNonExistentUserOperations()`: 存在しないユーザーに対する操作（異常系）

### AuthRoleCrudE2ETest

**ロール管理の完全CRUD操作をテスト**

- `testCompleteRoleCrudFlow()`: ロールの作成→確認→削除の基本フロー
- `testMultipleRoleOperations()`: 複数ロールの一括作成・削除
- `testRoleCreationValidation()`: ロール作成時のバリデーション（異常系）
- `testNonExistentRoleOperations()`: 存在しないロールに対する操作（異常系）
- `testSystemRoleProtection()`: システムロールの保護機能テスト

## テスト実行時の注意事項

### 1. テスト環境の使用

- E2Eテストは**テスト環境**のSaaSus Platform APIを使用してください
- 本番環境での実行は絶対に避けてください
- テスト用のSaaS IDとAPIキーを使用してください

### 2. データのクリーンアップ

- テストで作成されたリソース（テナント、ユーザー、ロール等）は自動的にクリーンアップされます
- `TestDataManager`クラスが作成されたリソースを追跡し、テスト終了時に削除します
- 万が一クリーンアップが失敗した場合は、手動でリソースを削除してください

### 3. テスト実行時間

- E2Eテストは実際のAPI通信を行うため、単体テストより時間がかかります
- 全テスト実行には5-10分程度かかる場合があります
- ネットワーク状況により実行時間が変動します

### 4. 並列実行の制限

- E2Eテストは並列実行に対応していません
- 同じリソースに対する競合状態を避けるため、順次実行してください

## トラブルシューティング

### よくある問題と解決方法

#### 1. 環境変数エラー

```
[ERROR] 必要な環境変数が設定されていません: SAASUS_SECRET_KEY
```

**解決方法**: 必要な環境変数を設定してください

```bash
export SAASUS_SECRET_KEY="your_secret_key"
export SAASUS_SAAS_ID="your_saas_id"
export SAASUS_API_KEY="your_api_key"
```

#### 2. API接続エラー

```
[ERROR] SaaSus Platform API接続エラー: Connection timeout
```

**解決方法**:
- ネットワーク接続を確認してください
- API URLが正しいことを確認してください
- APIキーが有効であることを確認してください

#### 3. 認証エラー

```
HTTP 401 Unauthorized
```

**解決方法**:
- APIキーとシークレットキーが正しいことを確認してください
- SaaS IDが正しいことを確認してください
- APIキーの有効期限を確認してください

#### 4. テストデータのクリーンアップ失敗

```
[TestDataManager] テナント削除失敗: tenant_123 - HTTP 404 Not Found
```

**解決方法**:
- 通常は404エラーは問題ありません（既に削除済み）
- 手動でリソースを確認し、必要に応じて削除してください

#### 5. メモリ不足エラー

```
PHP Fatal error: Allowed memory size exhausted
```

**解決方法**:
- PHPのメモリ制限を増加してください

```bash
php -d memory_limit=512M vendor/bin/phpunit --configuration test/phpunit.e2e.xml
```

## カスタマイズ

### 新しいE2Eテストの追加

1. 適切なディレクトリにテストクラスを作成
2. `TestCase`を継承し、必要なアノテーションを追加
3. `TestDataManager`と`E2ETestHelper`を使用
4. 適切なクリーンアップ処理を実装

```php
<?php

namespace AntiPatternInc\Saasus\Test\E2E\YourModule;

use PHPUnit\Framework\TestCase;
use AntiPatternInc\Saasus\Api\Client;
use AntiPatternInc\Saasus\Test\Helpers\TestDataManager;
use AntiPatternInc\Saasus\Test\Helpers\E2ETestHelper;

/**
 * @group e2e
 * @group your-module
 */
class YourModuleE2ETest extends TestCase
{
    private Client $client;
    private TestDataManager $testDataManager;
    private E2ETestHelper $e2eHelper;
    
    protected function setUp(): void
    {
        parent::setUp();
        
        $this->client = new Client();
        $this->testDataManager = new TestDataManager($this->client);
        $this->e2eHelper = new E2ETestHelper();
        
        $this->e2eHelper->verifyTestEnvironment();
    }
    
    protected function tearDown(): void
    {
        $this->testDataManager->cleanup();
        parent::tearDown();
    }
    
    /**
     * @test
     */
    public function testYourFeature()
    {
        // テスト実装
    }
}
```

### テスト設定のカスタマイズ

`test/phpunit.e2e.xml`を編集して、テスト設定をカスタマイズできます：

- タイムアウト設定
- メモリ制限
- 環境変数
- カバレッジ設定
- ログ設定

## 継続的インテグレーション

### GitHub Actions設定例

```yaml
name: E2E Tests

on:
  push:
    branches: [ main, develop ]
  pull_request:
    branches: [ main ]
  schedule:
    - cron: '0 2 * * *'  # 毎日午前2時に実行

jobs:
  e2e-tests:
    runs-on: ubuntu-latest
    
    steps:
    - uses: actions/checkout@v4
    
    - name: Setup PHP
      uses: shivammathur/setup-php@v2
      with:
        php-version: 8.1
        extensions: mbstring, xml, ctype, iconv, intl
    
    - name: Install dependencies
      run: composer install --prefer-dist --no-progress
    
    - name: Run E2E tests
      env:
        SAASUS_SECRET_KEY: ${{ secrets.SAASUS_SECRET_KEY }}
        SAASUS_SAAS_ID: ${{ secrets.SAASUS_SAAS_ID }}
        SAASUS_API_KEY: ${{ secrets.SAASUS_API_KEY }}
      run: ./test/run-e2e-tests.sh -c
    
    - name: Upload coverage reports
      uses: codecov/codecov-action@v3
      with:
        file: ./coverage-e2e.xml
        flags: e2e
```

## 貢献ガイドライン

### E2Eテストの品質基準

1. **テストの独立性**: 各テストは他のテストに依存しない
2. **適切なクリーンアップ**: 作成したリソースは必ず削除する
3. **明確なテスト名**: テストの目的が分かりやすい名前を使用
4. **包括的なアサーション**: 期待する結果を詳細に検証
5. **エラーハンドリング**: 異常系のテストも含める

### コードレビューポイント

- [ ] 環境変数の適切な使用
- [ ] TestDataManagerによるリソース管理
- [ ] 適切なアサーションの使用
- [ ] エラーケースのテスト
- [ ] テスト実行時間の妥当性
- [ ] ドキュメントの更新

## 参考資料

- [SaaSus Platform API Documentation](https://docs.saasus.io/)
- [PHPUnit Documentation](https://phpunit.de/documentation.html)
- [テスト設計書](../docs/test-design/)

---

**最終更新**: 2024年8月25日  
**バージョン**: 1.0.0  
**作成者**: Anti-Pattern Inc.
# SaaSus SDK for PHP - Docker環境でのE2Eテスト実行ガイド

## 概要

このドキュメントでは、Dockerコンテナを使用してSaaSus SDK for PHPのE2Eテストを実行する方法を説明します。ローカル環境にPHPやComposerをインストールする必要がなく、統一された環境でテストを実行できます。

## 前提条件

### 必要なソフトウェア

- **Docker**: 20.x以上
- **Docker Compose**: 2.x以上（または `docker compose` コマンド）

### インストール確認

```bash
# Dockerのバージョン確認
docker --version

# Docker Composeのバージョン確認
docker-compose --version
# または
docker compose version

# Dockerデーモンの起動確認
docker info
```

## 環境設定

### 1. 環境変数の設定

プロジェクトルートに `.env` ファイルを作成：

```bash
# .env
SAASUS_SECRET_KEY="your_secret_key"
SAASUS_SAAS_ID="your_saas_id"
SAASUS_API_KEY="your_api_key"
SAASUS_API_URL_BASE=https://dev.saasus.io
SAASUS_LOGIN_URL=https://auth.dev.saasus.io/
SAASUS_AUTH_MODE=api
```

### 2. Docker環境の構成

作成されるDockerファイル：

```
docker/
├── Dockerfile.e2e          # E2Eテスト実行環境
└── nginx/
    └── e2e.conf            # テスト結果表示用Nginx設定

docker-compose.e2e.yml      # Docker Compose設定
scripts/
└── run-e2e-docker.sh       # Docker実行スクリプト
```

## テスト実行方法

### 1. 基本的な実行

```bash
# 全てのE2Eテストを実行
./scripts/run-e2e-docker.sh

# 特定のテストグループのみ実行
./scripts/run-e2e-docker.sh auth           # Auth関連テスト
./scripts/run-e2e-docker.sh tenant-crud    # テナントCRUDテスト
./scripts/run-e2e-docker.sh user-crud      # ユーザーCRUDテスト
./scripts/run-e2e-docker.sh role-crud      # ロールCRUDテスト
```

### 2. オプション付き実行

```bash
# カバレッジレポート付きで実行
./scripts/run-e2e-docker.sh -c auth

# 詳細出力モードで実行
./scripts/run-e2e-docker.sh -v tenant-crud

# Dockerイメージを強制的に再ビルド
./scripts/run-e2e-docker.sh --build

# テスト結果表示用Webサーバーも起動
./scripts/run-e2e-docker.sh --web

# 設定確認のみ（実際のテストは実行しない）
./scripts/run-e2e-docker.sh --dry-run
```

### 3. 開発・デバッグ用

```bash
# テストコンテナのシェルに接続
./scripts/run-e2e-docker.sh --shell

# Docker環境をクリーンアップ
./scripts/run-e2e-docker.sh --cleanup
```

## Docker環境の詳細

### コンテナ構成

#### saasus-e2e-test コンテナ

- **ベースイメージ**: `php:8.1-cli-alpine`
- **インストール済み**:
  - PHP 8.1 + 必要な拡張（PDO, SQLite, XML, GD, BCMath, Xdebug）
  - Composer
  - Git, Curl, その他開発ツール
- **機能**:
  - E2Eテストの実行
  - カバレッジレポートの生成
  - テスト結果の出力

#### saasus-e2e-web コンテナ（オプション）

- **ベースイメージ**: `nginx:alpine`
- **機能**:
  - カバレッジレポートのWeb表示
  - テスト結果のWeb表示
  - アクセス先: http://localhost:8080

### ボリュームマウント

```yaml
volumes:
  - .:/app                              # ソースコード
  - composer-cache:/home/appuser/.composer  # Composerキャッシュ
  - ./test-results:/app/test-results    # テスト結果
  - ./coverage-html-e2e:/app/coverage-html-e2e  # カバレッジレポート
```

## テスト結果の確認

### 1. ファイルでの確認

```bash
# テスト結果ディレクトリ
ls -la test-results/

# カバレッジレポート
open coverage-html-e2e/index.html
```

### 2. Webブラウザでの確認

```bash
# Webサーバー付きでテスト実行
./scripts/run-e2e-docker.sh --web

# ブラウザでアクセス
open http://localhost:8080
```

Webインターフェースでは以下が確認できます：

- **カバレッジレポート**: `/coverage/`
- **テスト結果**: `/results/`
- **実行ログ**: JUnit XML形式

## トラブルシューティング

### よくある問題と解決方法

#### 1. Dockerデーモンエラー

```
[ERROR] Dockerデーモンが起動していません
```

**解決方法**:
```bash
# macOS/Windows: Docker Desktopを起動
# Linux: Dockerサービスを起動
sudo systemctl start docker
```

#### 2. 環境変数エラー

```
[ERROR] 必要な環境変数が設定されていません: SAASUS_SECRET_KEY
```

**解決方法**:
```bash
# .envファイルを作成または確認
cat .env

# 環境変数を直接設定
export SAASUS_SECRET_KEY="your_secret_key"
```

#### 3. ポート競合エラー

```
Error: Port 8080 is already in use
```

**解決方法**:
```bash
# 使用中のプロセスを確認
lsof -i :8080

# Docker環境をクリーンアップ
./scripts/run-e2e-docker.sh --cleanup
```

#### 4. Dockerイメージビルドエラー

```
Error building Docker image
```

**解決方法**:
```bash
# キャッシュをクリアして再ビルド
./scripts/run-e2e-docker.sh --build

# Docker環境を完全にクリーンアップ
docker system prune -a
```

#### 5. メモリ不足エラー

```
PHP Fatal error: Allowed memory size exhausted
```

**解決方法**:
- Docker Desktopのメモリ設定を増加（推奨: 4GB以上）
- または、Dockerfileの `PHP_MEMORY_LIMIT` を調整

### デバッグ方法

#### 1. コンテナ内でのデバッグ

```bash
# コンテナのシェルに接続
./scripts/run-e2e-docker.sh --shell

# コンテナ内でテスト実行
./test/run-e2e-tests.sh --dry-run
./test/run-e2e-tests.sh tenant-crud
```

#### 2. ログの確認

```bash
# Docker Composeログの確認
docker-compose -f docker-compose.e2e.yml logs

# 特定のコンテナのログ
docker-compose -f docker-compose.e2e.yml logs saasus-e2e-test
```

#### 3. 環境情報の確認

```bash
# コンテナ内の環境確認
./scripts/run-e2e-docker.sh --shell
php --version
composer --version
env | grep SAASUS
```

## パフォーマンス最適化

### 1. Composerキャッシュの活用

```bash
# キャッシュボリュームの確認
docker volume ls | grep composer-cache
```

### 2. Docker Buildキャッシュの活用

```bash
# 通常のビルド（キャッシュ使用）
./scripts/run-e2e-docker.sh

# 強制再ビルド（キャッシュクリア）
./scripts/run-e2e-docker.sh --build
```

### 3. 並列実行の制限

E2Eテストは実際のAPI通信を行うため、並列実行は推奨されません。順次実行してください。

## CI/CD統合

### GitHub Actions設定例

```yaml
name: E2E Tests (Docker)

on:
  push:
    branches: [ main, develop ]
  pull_request:
    branches: [ main ]

jobs:
  e2e-tests:
    runs-on: ubuntu-latest
    
    steps:
    - uses: actions/checkout@v4
    
    - name: Create .env file
      run: |
        echo "SAASUS_SECRET_KEY=${{ secrets.SAASUS_SECRET_KEY }}" >> .env
        echo "SAASUS_SAAS_ID=${{ secrets.SAASUS_SAAS_ID }}" >> .env
        echo "SAASUS_API_KEY=${{ secrets.SAASUS_API_KEY }}" >> .env
    
    - name: Run E2E tests
      run: ./scripts/run-e2e-docker.sh -c
    
    - name: Upload coverage reports
      uses: codecov/codecov-action@v3
      with:
        file: ./coverage-e2e.xml
        flags: e2e-docker
```

## まとめ

Docker環境を使用することで：

✅ **環境の統一**: 開発者間で同じ環境でテスト実行  
✅ **簡単セットアップ**: PHPやComposerのローカルインストール不要  
✅ **分離された環境**: ホストシステムに影響を与えない  
✅ **再現性**: 同じ結果を保証  
✅ **CI/CD統合**: 自動化パイプラインに組み込み可能  

これにより、誰でも簡単にE2Eテストを実行できる環境が整いました。

---

**最終更新**: 2024年8月25日  
**バージョン**: 1.0.0  
**作成者**: Anti-Pattern Inc.
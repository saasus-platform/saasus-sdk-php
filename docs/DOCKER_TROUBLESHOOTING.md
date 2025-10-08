# Docker環境でのトラブルシューティング

## PHPUnitインストール問題

### 問題
Docker環境でE2Eテストを実行する際に、以下のエラーが発生する場合があります：

```
[ERROR] PHPUnitがインストールされていません
[INFO] composer install --dev を実行してください
[ERROR] E2Eテスト実行失敗
```

### 原因
- Dockerfileで`composer install --no-dev`を実行した後に開発依存関係が正しくインストールされていない
- PHPUnitが`require-dev`セクションに定義されているが、開発依存関係のインストールが不完全

### 解決方法

#### 1. Dockerイメージの強制再ビルド
```bash
./scripts/run-e2e-docker.sh --build
```

#### 2. Docker環境のクリーンアップ後に再実行
```bash
./scripts/run-e2e-docker.sh --cleanup
./scripts/run-e2e-docker.sh --build
```

#### 3. 手動でのコンテナ確認
```bash
# コンテナのシェルに接続
./scripts/run-e2e-docker.sh --shell

# コンテナ内でPHPUnitの存在確認
ls -la /app/vendor/bin/phpunit

# 手動でcomposer installを実行
composer install --optimize-autoloader --no-interaction
```

### 修正内容

#### Dockerfile.e2e
- `composer install --no-dev`を削除し、開発依存関係も含めてインストール
- インストール結果の確認コマンドを追加

#### test/run-e2e-tests.sh
- PHPUnitが見つからない場合の自動復旧処理を追加
- `composer install --no-dev`を`composer install`に変更

#### scripts/run-e2e-docker.sh
- 既存イメージが存在する場合でも自動的に再ビルドするように変更

## その他のDocker関連問題

### Xdebugインストールエラー
```
configure: error: rtnetlink.h is required, install the linux-headers package
```

**解決方法**: `linux-headers`パッケージを追加済み

### メモリ不足エラー
```
Fatal error: Allowed memory size exhausted
```

**解決方法**: Dockerfileで`memory_limit = 512M`を設定済み

### 権限エラー
```
Permission denied
```

**解決方法**: 
- Dockerfileで適切なユーザー権限を設定済み
- テストスクリプトに実行権限を付与済み

## 予防策

1. **定期的なイメージ再ビルド**
   ```bash
   ./scripts/run-e2e-docker.sh --build
   ```

2. **環境のクリーンアップ**
   ```bash
   ./scripts/run-e2e-docker.sh --cleanup
   ```

3. **設定確認**
   ```bash
   ./scripts/run-e2e-docker.sh --dry-run
   ```

## サポート

問題が解決しない場合は、以下の情報を含めて報告してください：

1. エラーメッセージの全文
2. 実行したコマンド
3. Docker環境の情報（`docker --version`, `docker-compose --version`）
4. OS情報
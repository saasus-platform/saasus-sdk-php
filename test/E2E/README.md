# モジュールE2Eテスト

このテストは実際のSaaSus環境へ接続し、環境の状態を変更する可能性があります。
テスト専用のSaaS環境と、Stripeのテストモード用シークレットキーを使用してください。

`.env`に以下の値を設定します。

```dotenv
SAASUS_SAAS_ID=...
SAASUS_API_KEY=...
SAASUS_SECRET_KEY=...
STRIPE_SECRET_KEY=sk_test_...
```

Go SDK と同じ Cognito依存のAuthテストも実行する場合は、Cognitoを管理できる
AWS認証情報を追加します。PHP 8.0互換のAWS SDKに既知の脆弱性があるため、
テスト専用のSigV4クライアントを使用しています。

```dotenv
E2E_COGNITO_USER_POOL_ID=...
E2E_COGNITO_CLIENT_ID=...
E2E_COGNITO_USERNAME=...
E2E_COGNITO_PASSWORD=...
E2E_COGNITO_REGION=ap-northeast-1
E2E_COGNITO_ENDPOINT=... # LocalStack利用時のみ

AWS_ACCESS_KEY_ID=...
AWS_SECRET_ACCESS_KEY=...
AWS_SESSION_TOKEN=...    # 一時認証情報の場合
```

上記が未設定の場合、Cognito ID TokenとMFA/TOTPに依存するステップだけを
理由付きでスキップします。テナント招待フローは、招待者を対象テナントへ
所属させる外部JWTフィクスチャが未整備のため、Go SDKと同様に常時スキップします。

共有Cognito環境のメール送信上限を保護するため、サインアップ系はデフォルトで
スキップします。Go SDKと同様に明示的に有効化する場合:

```dotenv
AUTH_E2E_SKIP_SIGNUP_ON_COGNITO_EMAIL_LIMIT=false
```

## Billing E2Eテスト

```bash
SAASUS_E2E=true vendor/bin/phpunit \
  --configuration test/phpunit.xml \
  test/E2E/BillingApiTest.php
```

DockerとPHP 8.0を使用する場合:

```bash
docker compose run --rm \
  -e SAASUS_E2E=true \
  php vendor/bin/phpunit \
  --configuration test/phpunit.xml \
  test/E2E/BillingApiTest.php
```

## Auth E2Eテスト

Auth API テストは、専用の SaaS 環境に一意なユーザー、ロール、属性、環境、
テナントを作成し、取得・更新後に逆順で削除します。テスト途中で失敗した場合も
ベストエフォートで後始末を行います。

```bash
SAASUS_E2E=true vendor/bin/phpunit \
  --configuration test/phpunit.xml \
  test/E2E/AuthApiTest.php
```

Docker と PHP 8.0 を使用する場合:

```bash
docker compose run --rm \
  -e SAASUS_E2E=true \
  php vendor/bin/phpunit \
  --configuration test/phpunit.xml \
  test/E2E/AuthApiTest.php
```

`SAASUS_E2E` を指定しない通常の PHPUnit 実行でも、生成された Auth クライアントの
全公開 API がストーリーに定義されていることをオフラインで検証します。Go SDK の
新しい OpenAPI 出力にのみ存在する `CreateSaasUserAttribute`、
`UpdateSaasUserAttributes`、`GetStripeCustomer` は、同じ SaaSus 署名
ミドルウェアを使うテスト用 parity クライアントで実行します。
次の機能は外部サービスまたは共有 SaaS 設定を必要とするため、理由を記録した
スキップステップとして管理します。

- Cognito の ID・Access・Refresh token、TOTP、メール確認コードを必要とする操作
- Stripe / Pricing および AWS Marketplace 連携
- テナント SAML Identity Provider

Auth のスナップショットを取得する場合:

```bash
docker compose run --rm \
  -e SAASUS_E2E=true \
  -e E2E_SNAPSHOT_MODE=capture \
  -e E2E_SNAPSHOT_TAG=auth-v1 \
  php vendor/bin/phpunit \
  --configuration test/phpunit.xml \
  test/E2E/AuthSnapshotTest.php
```

スナップショットは `test/E2E/Snapshots/auth/` 以下へ保存されます。

## Communication E2Eテスト

Communication API テストは、Go SDK の E2E と同じフィードバック、コメント、投票の
ライフサイクルを、PHP SDK のオブジェクトレスポンスと raw PSR-7 レスポンスの両方で
実行します。テストが作成したフィードバックは、途中で失敗した場合も後始末します。

`TEST_USER_ID` を省略した場合は、Go SDK と同じ
`00000000-0000-0000-0000-000000000000` を使用します。

```bash
SAASUS_E2E=true vendor/bin/phpunit \
  --configuration test/phpunit.xml \
  test/E2E/CommunicationApiTest.php
```

スナップショットを取得する場合:

```bash
SAASUS_E2E=true \
E2E_SNAPSHOT_MODE=capture \
E2E_SNAPSHOT_TAG=communication-v1 \
vendor/bin/phpunit \
  --configuration test/phpunit.xml \
  test/E2E/CommunicationSnapshotTest.php
```

スナップショットは `test/E2E/Snapshots/communication/` 以下へ保存されます。

## Integration E2Eテスト

Integration API テストは、Go SDK の E2E と同じ Amazon EventBridge 設定の
保存・取得・削除、テストイベント送信、イベント送信のフローを、PHP SDK の
オブジェクトレスポンスと raw PSR-7 レスポンスの両方で実行します。
テスト途中で失敗した場合も EventBridge 設定をベストエフォートで削除します。

`TEST_AWS_ACCOUNT_ID` と `TEST_AWS_REGION` を省略した場合は、Go SDK と同じ
テスト値を使用します。

```bash
SAASUS_E2E=true vendor/bin/phpunit \
  --configuration test/phpunit.xml \
  test/E2E/IntegrationApiTest.php
```

スナップショットを取得する場合:

```bash
SAASUS_E2E=true \
E2E_SNAPSHOT_MODE=capture \
E2E_SNAPSHOT_TAG=integration-v1 \
vendor/bin/phpunit \
  --configuration test/phpunit.xml \
  test/E2E/IntegrationSnapshotTest.php
```

スナップショットは `test/E2E/Snapshots/integration/` 以下へ保存されます。

## Pricing E2Eテスト

Pricing API テストは、Go SDK の E2E と同じ Pricing Unit、Menu、Plan、Tax Rate、
Metering Unit／カウントのライフサイクルを、PHP SDK のオブジェクトレスポンスと
raw PSR-7レスポンスの両方で実行します。各ストーリーの開始時と終了時に Pricing の
全リソースを削除するため、必ずテスト専用の SaaS 環境で実行してください。
Pricing Unit は `fixed` と、Metering Unit・tiersを使用する `tiered_usage` の
作成・取得・更新を検証します。

メータリング操作の対象テナントは `TEST_TENANT_ID` で指定します。省略時は Go SDK と
同じ `test-tenant-id` を使用します。

```bash
SAASUS_E2E=true \
TEST_TENANT_ID=... \
vendor/bin/phpunit \
  --configuration test/phpunit.xml \
  test/E2E/PricingApiTest.php
```

スナップショットを取得する場合:

```bash
SAASUS_E2E=true \
TEST_TENANT_ID=... \
E2E_SNAPSHOT_MODE=capture \
E2E_SNAPSHOT_TAG=pricing-v1 \
vendor/bin/phpunit \
  --configuration test/phpunit.xml \
  test/E2E/PricingSnapshotTest.php
```

スナップショットは `test/E2E/Snapshots/pricing/` 以下へ保存されます。

## バージョン付きスナップショット

タグごとのスナップショットは以下へ保存されます。

```text
test/E2E/Snapshots/billing/story_snapshots/tags/
```

ファイル配置とJSON形式はGo SDKに合わせています。

```text
story_snapshots/tags/story_snapshot_<tag>_<story_name>.json
story_validations/story_validation_<story_name>_<tag>.json
```

タグ付きスナップショットとvalidationはレビュー対象としてGitで管理します。
比較結果とHTML/JSONレポートは実行時に生成され、Gitでは無視されます。

`E2E_SNAPSHOT_TAG`を省略した場合、Go SDKと同じ優先順位でタグを決定します。

1. 現在のコミットに完全一致するGitタグ
2. `git describe --tags --always`の結果
3. Git情報を取得できない場合は、日時を含む`dev-*`タグ

CLIラッパーでもGo E2Eと同様のスナップショットオプションを指定できます。

```bash
SAASUS_E2E=true php test/E2E/snapshot.php \
  --snapshot-mode capture \
  --snapshot-tag billing-v1
```

利用できるモード:

- `capture`: 実APIを呼び出し、タグ付きスナップショットを保存します。
- `compare`: 実APIを呼ばず、保存済みの2つのタグを比較します。
- `report`: 保存済みの2つのタグを比較し、JSON・HTMLレポートを生成します。
- `full`: スナップショット作成、タグ間比較、validation、レポート生成を一括実行します。

`capture`と`full`には`SAASUS_E2E=true`が必要です。
`compare`と`report`はオフラインで実行され、SaaSusの認証情報を必要としません。

### ベースラインを作成する

```bash
docker compose run --rm \
  -e SAASUS_E2E=true \
  -e E2E_SNAPSHOT_MODE=capture \
  -e E2E_SNAPSHOT_TAG=billing-v1 \
  php vendor/bin/phpunit \
  --configuration test/phpunit.xml \
  test/E2E/BillingSnapshotTest.php
```

### タグをオフラインで比較する

```bash
docker compose run --rm \
  -e E2E_SNAPSHOT_MODE=compare \
  -e E2E_SNAPSHOT_OLD_TAG=billing-v1 \
  -e E2E_SNAPSHOT_NEW_TAG=billing-v2 \
  php vendor/bin/phpunit \
  --configuration test/phpunit.xml \
  test/E2E/BillingSnapshotTest.php
```

比較結果は以下の3段階で判定されます。

- `compatible`: 互換性に問題はありません。
- `warning`: 実行時間など、確認が必要な差分です。テストは成功します。
- `breaking`: ステータスコードやレスポンス構造などの破壊的変更です。テストは失敗します。

### レポートをオフラインで生成する

上記の比較コマンドで`E2E_SNAPSHOT_MODE=report`を指定します。
レポートは以下へ保存されます。

```text
test/E2E/Snapshots/billing/story_reports/billing-v1_vs_billing-v2/
```

### 作成・比較・validation・レポート生成を一括実行する

```bash
docker compose run --rm \
  -e SAASUS_E2E=true \
  -e E2E_SNAPSHOT_MODE=full \
  -e E2E_SNAPSHOT_TAG=billing-v2 \
  -e E2E_SNAPSHOT_OLD_TAG=billing-v1 \
  php vendor/bin/phpunit \
  --configuration test/phpunit.xml \
  test/E2E/BillingSnapshotTest.php
```

## 設定

環境変数、CLIラッパーのオプション、または以下のJSON設定ファイルを使用できます。

```text
E2E_SNAPSHOT_CONFIG=test/E2E/snapshot-config.example.json
```

主な設定:

- `E2E_SNAPSHOT_CAPTURE_LEVEL`: `FULL`、`STORY`、`STEP`、`RESPONSE`
- `E2E_SNAPSHOT_STORIES`: 対象とするストーリー名または部分一致文字列。複数の場合はカンマで区切ります。
- `E2E_SNAPSHOT_COMPARISON_MODE`: `release`、`manual`、`skip`
- `E2E_SNAPSHOT_VERBOSE=true`: 解決後のスナップショット設定を表示します。
- `SDK_VERSION`: スナップショットへ記録するSDKバージョン
- `E2E_TEST_ENVIRONMENT`: スナップショットへ記録するテスト環境名

`manual`比較では旧タグと新タグを明示する必要があります。
`skip`を指定すると、`full`実行時のタグ間比較を省略します。

## スナップショットの内容

キャプチャレベルに応じて、以下の情報を記録します。

- ストーリーとステップの実行結果
- パラメータ
- SDKの戻り値
- HTTPレスポンス
- JSONレスポンス
- 状態遷移
- 実行時間
- エラー情報
- validation結果
- Gitタグ、Gitコミット、SDKバージョン、テスト環境

durationはGo SDKと同様にナノ秒の整数として保存します。
`Date`や`X-Saasus-Trace-Id`などの動的ヘッダーもGo SDKと同様に記録しますが、
タグ間比較では無視します。

secret、token、password、authorization、APIキー、credentialなどの値は、
Go SDKと同じ`[MASKED len=<length>]`形式でマスクされます。

validationのルールと重要度はJSON設定ファイルで変更できます。

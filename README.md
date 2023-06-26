# PHP SDK for SaaSus Platform

[English page is here.](./README_en.md)

---

## SDK 利用の準備

### セットアップ

```
composer config repositories.saasus-platform/saasus-sdk-php vcs https://github.com/saasus-platform/saasus-sdk-php
```

### SDK 追加

```
composer require saasus-platform/saasus-sdk-php
```

### 環境変数を定義

```ini
### for SaaSus Platform
SAASUS_SAAS_ID="（画面のSaaS ID）"
SAASUS_API_KEY="（画面のAPI KEY）"
SAASUS_SECRET_KEY="（画面のクライアントシークレット）"
SAASUS_LOGIN_URL="https://auth.sample.saasus.jp/（ログイン画面のURL）"
```

SAASUS_SAAS_ID, SAASUS_API_KEY, SAASUS_SECRET_KEY は SaaS 開発コンソール画面に表示されている SaaS ID、 API キー 　と　クライアントシークレットを、
SAASUS_LOGIN_URL は、SaaS 開発コンソールで作成したログイン画面の URL を設定します。

### 認証モジュールの組み込み

api/routes/web.php

```php
// SaaSus SDK標準のAuth Middlewareを利用する
Route::middleware(\AntiPatternInc\Saasus\Laravel\Middleware\Auth::class)->group(function () {
    // 固有のロジックを記載する

    Route::redirect('/', '/xxxxxx');
});
```

---

## PHP SDK

- [Auth](./generated/Auth/README.md)

  ユーザ情報、基本情報、認証情報、テナント情報、役割(ロール)情報などに参照・更新に利用します。

- [Pricing](./generated/Pricing/README.md)

  プライシングユニット、機能メニュー、料金プラン、メータリングユニットカウントなど料金に関連する情報の参照・更新に利用します。

- [Billing](./generated/Billing/README.md)

  請求業務で使う外部 SaaS との連携情報の参照・更新に利用します。

- [Integration](./generated/Integration/README.md)

  EventBridge 連携設定の参照・更新に利用します。

- [AwsMarketplace](./generated/AwsMarketplace/README.md)

  AWS Marketplace 連携設定の参照・更新に利用します。

---

## ユースケースサンプル

準備中・・・

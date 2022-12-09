# PHP SaaSus SDK

---
## SDK 利用の準備

### セットアップ
```
composer config repositories.anti-pattern-inc/saasus-sdk-php vcs https://github.com/saasus-platform/saasus-sdk-php
```
### SDK追加
```
composer require Anti-Pattern-Inc/saasus-sdk-php
```

### 環境変数を定義
```
### for SaaSus Platform
SAASUS_SAAS_ID="saasid_98tjo3wifaoua （画面のSaaS ID）"
SAASUS_API_KEY="apikey_kjntowjfoasnkjntwonsflajsno4as （画面のAPI KEY）"
SAASUS_SECRET_KEY="DuFMclufMf7OH2r4Ma3nB2TatvRufqja7V2yZrlz+xA （画面のクライアントシークレット）"
SAASUS_LOGIN_URL="https://auth.sample.saasus.jp/　（ログイン画面のURL）"
```
SAASUS_SAAS_ID, SAASUS_API_KEY は先ほど画面で表示した SaaS ID と API Keyを、
SAASUS_LOGIN_URL は、SaaSus コンソールで作成したログイン画面のURLを設定します。


### 認証モジュールの組み込み

api/routes/web.php

```
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

    請求業務で使う外部SaaSとの連携情報の参照・更新に利用します。


---
# ユースケースサンプル
　準備中・・・


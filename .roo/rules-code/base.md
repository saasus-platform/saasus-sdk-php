# SaaSus SDK for PHP - プロジェクト全体コンテキスト

## プロジェクト概要

**saasus-sdk-php**は、SaaSus Platform（Anti-Pattern Inc.が提供するSaaS開発プラットフォーム）のPHP用SDKです。マルチテナント対応のSaaSアプリケーション開発を支援する包括的なAPIクライアントライブラリです。

## 基本情報

- **パッケージ名**: `saasus-platform/saasus-sdk-php`
- **ライセンス**: Apache-2.0
- **PHP要件**: >=8.0.2
- **Laravel対応**: 9.x - 11.x
- **開発者**: Anti-Pattern Inc.
- **リポジトリ**: https://github.com/saasus-platform/saasus-sdk-php

## アーキテクチャ構成

### 1. コアライブラリ (`src/`)

#### [`src/Api/Client.php`](src/Api/Client.php)
- **役割**: 全APIクライアントの統合管理クラス
- **機能**: 
  - 環境変数からの認証情報取得（SAASUS_SECRET_KEY, SAASUS_SAAS_ID, SAASUS_API_KEY）
  - 各APIモジュールクライアントの初期化と管理
  - Guzzle HTTPクライアントの設定とミドルウェア適用

#### [`src/Api/GuzzleMiddleware.php`](src/Api/GuzzleMiddleware.php)
- **役割**: SaaSus Platform API認証用ミドルウェア
- **機能**:
  - SAASUSSIGV1署名方式による認証ヘッダー生成
  - HMAC-SHA256を使用したリクエスト署名
  - Refererヘッダーとx-saasus-refererヘッダーの管理

#### [`src/Api/Lib.php`](src/Api/Lib.php)
- **役割**: ユーティリティ関数集
- **機能**: メータリングユニットの上限値検索など

### 2. Laravel統合機能 (`src/Laravel/`)

#### 認証ミドルウェア
- **[`src/Laravel/Middleware/Auth.php`](src/Laravel/Middleware/Auth.php)**
  - IDトークンベースの認証処理
  - Cookieからのトークン取得
  - ユーザー情報の取得とリクエストへの注入
  - API/Web両モードでの認証エラーハンドリング

#### コントローラー群
- **[`CallbackController.php`](src/Laravel/Controllers/CallbackController.php)**: OAuth認証後のコールバック処理（Web用）
- **[`CallbackApiController.php`](src/Laravel/Controllers/CallbackApiController.php)**: OAuth認証後のコールバック処理（API用）
- **[`TokenRefreshApiController.php`](src/Laravel/Controllers/TokenRefreshApiController.php)**: リフレッシュトークンによるトークン更新
- **[`TokenTransferController.php`](src/Laravel/Controllers/TokenTransferController.php)**: クロスドメイン間でのトークン転送

#### ビューテンプレート
- **[`saasus_default_callback.blade.php`](src/Laravel/Views/saasus_default_callback.blade.php)**: 認証後のリダイレクト処理
- **[`saasus_default_token_transfer.blade.php`](src/Laravel/Views/saasus_default_token_transfer.blade.php)**: トークン転送用iframe

### 3. 自動生成APIクライアント (`generated/`)

OpenAPI仕様から自動生成された7つのAPIモジュール：

#### [`Auth`](generated/Auth/) - 認証・ユーザー管理
- **主要機能**:
  - ユーザー情報取得・管理（[`getUserInfo()`](generated/Auth/Client.php:23), [`getSaasUsers()`](generated/Auth/Client.php:84)）
  - テナント管理（[`getTenants()`](generated/Auth/Client.php:523), [`createTenant()`](generated/Auth/Client.php:536)）
  - ロール・権限管理（[`getRoles()`](generated/Auth/Client.php:403), [`createRole()`](generated/Auth/Client.php:419)）
  - 環境管理（[`getEnvs()`](generated/Auth/Client.php:883), [`createEnv()`](generated/Auth/Client.php:898)）
  - 認証設定（[`getSignInSettings()`](generated/Auth/Client.php:812), [`updateSignInSettings()`](generated/Auth/Client.php:827)）

#### [`Pricing`](generated/Pricing/) - 料金・プラン管理
- **主要機能**:
  - 料金プラン管理（[`getPricingPlans()`](generated/Pricing/Client.php:140), [`createPricingPlan()`](generated/Pricing/Client.php:153)）
  - 料金ユニット管理（[`getPricingUnits()`](generated/Pricing/Client.php:13), [`createPricingUnit()`](generated/Pricing/Client.php:26)）
  - メータリング管理（[`getMeteringUnits()`](generated/Pricing/Client.php:436), [`updateMeteringUnitTimestampCount()`](generated/Pricing/Client.php:273)）
  - 税率管理（[`getTaxRates()`](generated/Pricing/Client.php:379), [`createTaxRate()`](generated/Pricing/Client.php:393)）

#### [`Billing`](generated/Billing/) - 請求管理
- **主要機能**:
  - Stripe連携情報管理（[`getStripeInfo()`](generated/Billing/Client.php:23), [`updateStripeInfo()`](generated/Billing/Client.php:38)）

#### [`Integration`](generated/Integration/) - 外部連携
- **主要機能**:
  - EventBridge設定管理（[`getEventBridgeSettings()`](generated/Integration/Client.php:23), [`saveEventBridgeSettings()`](generated/Integration/Client.php:36)）
  - イベント送信（[`createEventBridgeEvent()`](generated/Integration/Client.php:49)）

#### [`Communication`](generated/Communication/) - フィードバック管理
- **主要機能**:
  - フィードバック管理（[`getFeedbacks()`](generated/Communication/Client.php:13), [`createFeedback()`](generated/Communication/Client.php:26)）
  - コメント機能（[`createFeedbackComment()`](generated/Communication/Client.php:129)）
  - 投票機能（[`createVoteUser()`](generated/Communication/Client.php:99)）

#### [`AwsMarketplace`](generated/AwsMarketplace/) - AWS Marketplace連携
#### [`ApiLog`](generated/ApiLog/) - APIログ管理

## 開発・運用環境

### 依存関係
- **HTTPクライアント**: Guzzle 7.x
- **OpenAPI Runtime**: Jane PHP 7.3
- **Laravel Framework**: 9.x - 11.x対応

### 開発ツール
- **テスト**: PHPUnit（[`test/SdkTest.php`](test/SdkTest.php)）
- **Docker**: PHP 8.0-fpm環境（[`docker/Dockerfile`](docker/Dockerfile)）
- **CI/CD**: GitHub Actions（Packagist自動公開）

### 設定要件
必要な環境変数：
```ini
SAASUS_SAAS_ID="（SaaS ID）"
SAASUS_API_KEY="（API KEY）"
SAASUS_SECRET_KEY="（クライアントシークレット）"
SAASUS_LOGIN_URL="https://auth.sample.saasus.jp/"
```

## 使用方法

### 基本的な使用例
```php
// クライアント初期化
$client = new \AntiPatternInc\Saasus\Api\Client();

// 認証情報取得
$userInfo = $client->getAuthClient()->getUserInfo(['token' => $idToken]);

// 料金プラン取得
$plans = $client->getPricingClient()->getPricingPlans();

// テナント管理
$tenants = $client->getAuthClient()->getTenants();
```

### Laravel統合
```php
// ルート設定
Route::middleware(\AntiPatternInc\Saasus\Laravel\Middleware\Auth::class)->group(function () {
    // 認証が必要なルート
});
```

## 特徴・強み

1. **包括的なSaaS機能**: 認証、課金、テナント管理、フィードバックなど、SaaS開発に必要な全機能をカバー
2. **Laravel完全統合**: ミドルウェア、コントローラー、ビューを提供し、Laravel開発者にとって使いやすい
3. **自動生成コード**: OpenAPI仕様からの自動生成により、API仕様変更への迅速な対応が可能
4. **セキュアな認証**: HMAC-SHA256による署名認証とIDトークンベースの認証を実装
5. **マルチテナント対応**: テナント管理、ロール管理、環境管理など、マルチテナントSaaSに必要な機能を完備

このSDKは、PHP/Laravelを使用してマルチテナント対応のSaaSアプリケーションを効率的に開発するための、非常に完成度の高いツールキットです。
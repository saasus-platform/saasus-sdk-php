# SaaSus SDK for PHP テスト設計書 - 概要

## プロジェクト概要

**saasus-sdk-php**は、SaaSus Platform（Anti-Pattern Inc.が提供するSaaS開発プラットフォーム）のPHP用SDKです。マルチテナント対応のSaaSアプリケーション開発を支援する包括的なAPIクライアントライブラリです。

### 基本情報

- **パッケージ名**: `saasus-platform/saasus-sdk-php`
- **ライセンス**: Apache-2.0
- **PHP要件**: >=8.0.2
- **Laravel対応**: 9.x - 11.x
- **開発者**: Anti-Pattern Inc.
- **リポジトリ**: https://github.com/saasus-platform/saasus-sdk-php

## アーキテクチャ構成

### 1. コアライブラリ (`src/`)

#### [`src/Api/Client.php`](../../src/Api/Client.php)
- **役割**: 全APIクライアントの統合管理クラス
- **機能**: 
  - 環境変数からの認証情報取得（SAASUS_SECRET_KEY, SAASUS_SAAS_ID, SAASUS_API_KEY）
  - 各APIモジュールクライアントの初期化と管理
  - Guzzle HTTPクライアントの設定とミドルウェア適用

#### [`src/Api/GuzzleMiddleware.php`](../../src/Api/GuzzleMiddleware.php)
- **役割**: SaaSus Platform API認証用ミドルウェア
- **機能**:
  - SAASUSSIGV1署名方式による認証ヘッダー生成
  - HMAC-SHA256を使用したリクエスト署名
  - Refererヘッダーとx-saasus-refererヘッダーの管理

#### [`src/Api/Lib.php`](../../src/Api/Lib.php)
- **役割**: ユーティリティ関数集
- **機能**: メータリングユニットの上限値検索など

### 2. Laravel統合機能 (`src/Laravel/`)

#### 認証ミドルウェア
- **[`src/Laravel/Middleware/Auth.php`](../../src/Laravel/Middleware/Auth.php)**
  - IDトークンベースの認証処理
  - Cookieからのトークン取得
  - ユーザー情報の取得とリクエストへの注入
  - API/Web両モードでの認証エラーハンドリング

#### コントローラー群
- **[`CallbackController.php`](../../src/Laravel/Controllers/CallbackController.php)**: OAuth認証後のコールバック処理（Web用）
- **[`CallbackApiController.php`](../../src/Laravel/Controllers/CallbackApiController.php)**: OAuth認証後のコールバック処理（API用）
- **[`TokenRefreshApiController.php`](../../src/Laravel/Controllers/TokenRefreshApiController.php)**: リフレッシュトークンによるトークン更新

### 3. 自動生成APIクライアント (`generated/`)

OpenAPI仕様から自動生成された7つのAPIモジュール：

- **[`Auth`](../../generated/Auth/)** - 認証・ユーザー管理
- **[`Pricing`](../../generated/Pricing/)** - 料金・プラン管理
- **[`Billing`](../../generated/Billing/)** - 請求管理
- **[`Integration`](../../generated/Integration/)** - 外部連携
- **[`Communication`](../../generated/Communication/)** - フィードバック管理
- **[`AwsMarketplace`](../../generated/AwsMarketplace/)** - AWS Marketplace連携
- **[`ApiLog`](../../generated/ApiLog/)** - APIログ管理

## 現在のテスト状況

### 既存テスト
- 基本的なテストファイル（[`test/SdkTest.php`](../../test/SdkTest.php)）が存在
- 署名認証とAPI呼び出しの基本テストのみ実装済み
- 包括的なテストカバレッジが不足

### 課題
1. **単体テストの不足**: コアライブラリとLaravel統合機能の詳細テストが未実装
2. **結合テストの不足**: コンポーネント間の連携テストが未実装
3. **エラーハンドリングテストの不足**: 異常系・境界値テストが不十分
4. **自動化の不足**: CI/CD統合とテスト自動化が未整備

## テスト設計の目標

### 品質目標
- **コードカバレッジ**: コアライブラリ95%以上、Laravel統合機能90%以上
- **機能カバレッジ**: 主要ユースケース100%、エラーハンドリング90%以上
- **保守性**: テストコードの可読性と保守性の確保

### 自動化目標
- **継続的テスト**: プルリクエスト時の自動テスト実行
- **環境統一**: Docker環境での統一されたテスト実行
- **回帰テスト**: 依存関係更新時の自動回帰テスト

## テスト設計ドキュメント構成

1. **[01-unit-tests.md](01-unit-tests.md)** - 単体テスト設計
2. **[02-integration-tests.md](02-integration-tests.md)** - 結合テスト設計
3. **[03-test-environment.md](03-test-environment.md)** - テスト環境・実行環境設計
4. **[04-implementation-guide.md](04-implementation-guide.md)** - 実装ガイドライン

## 実装優先順位

### フェーズ1（高優先度）
1. コアライブラリ単体テスト（Client, GuzzleMiddleware, Lib）
2. Laravel認証ミドルウェア単体テスト
3. 基本的な結合テスト（Client + Middleware）

### フェーズ2（中優先度）
1. Laravelコントローラー単体テスト
2. Laravel統合機能結合テスト
3. 主要APIクライアント結合テスト

### フェーズ3（低優先度）
1. 自動生成APIクライアントサンプルテスト
2. E2Eテスト
3. パフォーマンステスト

## 特徴・強み

1. **包括的なSaaS機能**: 認証、課金、テナント管理、フィードバックなど、SaaS開発に必要な全機能をカバー
2. **Laravel完全統合**: ミドルウェア、コントローラー、ビューを提供し、Laravel開発者にとって使いやすい
3. **自動生成コード**: OpenAPI仕様からの自動生成により、API仕様変更への迅速な対応が可能
4. **セキュアな認証**: HMAC-SHA256による署名認証とIDトークンベースの認証を実装
5. **マルチテナント対応**: テナント管理、ロール管理、環境管理など、マルチテナントSaaSに必要な機能を完備

このSDKは、PHP/Laravelを使用してマルチテナント対応のSaaSアプリケーションを効率的に開発するための、非常に完成度の高いツールキットです。
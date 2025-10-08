# SaaSus SDK for PHP テスト設計書

## 概要

このディレクトリには、SaaSus SDK for PHPの品質を担保するための包括的なテスト設計書が含まれています。単体テスト、結合テスト、テスト環境設定、実装ガイドラインを網羅し、高品質なSDKの開発・保守を支援します。

## ドキュメント構成

### [📋 00-overview.md](00-overview.md) - プロジェクト概要
- プロジェクトの基本情報とアーキテクチャ構成
- 現在のテスト状況と課題分析
- テスト設計の目標と実装優先順位
- 各ドキュメントの関連性

### [🔬 01-unit-tests.md](01-unit-tests.md) - 単体テスト設計
- コアライブラリ単体テスト設計
  - [`Client.php`](../../src/Api/Client.php) テスト
  - [`GuzzleMiddleware.php`](../../src/Api/GuzzleMiddleware.php) テスト
  - [`Lib.php`](../../src/Api/Lib.php) テスト
- Laravel統合機能単体テスト設計
  - 認証ミドルウェアテスト
  - コントローラーテスト

### [🔬 01-unit-tests-continued.md](01-unit-tests-continued.md) - 単体テスト設計（続き）
- 自動生成APIクライアント単体テスト
- テスト実装方針とフレームワーク設定
- モック・スタブ戦略
- テストディレクトリ構造
- 品質保証チェックリスト

### [🔗 02-integration-tests.md](02-integration-tests.md) - 結合テスト設計
- コンポーネント間結合テスト
  - Client + GuzzleMiddleware 結合テスト
  - Laravel統合機能結合テスト
- 外部システム結合テスト
  - SaaSus Platform API結合テスト
  - Laravel Framework結合テスト

### [🔗 02-integration-tests-continued.md](02-integration-tests-continued.md) - 結合テスト設計（続き）
- エンドツーエンド（E2E）テスト
  - 完全な認証フローテスト
  - マルチテナント機能テスト
- 結合テストの実装方針
- CI/CD統合とテスト自動化

### [🐳 03-test-environment.md](03-test-environment.md) - テスト環境・実行環境設計
- Docker環境設定
- PHPUnit設定とテストブートストラップ
- Composer Scripts設定
- CI/CD統合（GitHub Actions）
- 環境別設定ファイル
- Makefile統合

### [📝 04-implementation-guide.md](04-implementation-guide.md) - 実装ガイドライン
- 実装優先順位（3フェーズ）
- コーディング規約とベストプラクティス
- 品質保証プロセス
- 実装手順とテンプレート
- トラブルシューティング

## クイックスタート

### 1. 環境セットアップ
```bash
# リポジトリクローン
git clone https://github.com/saasus-platform/saasus-sdk-php.git
cd saasus-sdk-php

# 依存関係インストール
composer install

# テスト環境設定
cp .env.testing.example .env.testing
# .env.testingファイルを編集

# Docker環境セットアップ（推奨）
make docker-setup
```

### 2. テスト実行
```bash
# 全テスト実行
make test

# 単体テストのみ
make test-unit

# 結合テストのみ
make test-integration

# カバレッジレポート生成
make test-coverage
```

### 3. 開発フロー
1. **[実装ガイドライン](04-implementation-guide.md)** を確認
2. **[単体テスト設計](01-unit-tests.md)** に基づいてテスト実装
3. **[結合テスト設計](02-integration-tests.md)** に基づいて統合テスト実装
4. **[テスト環境設定](03-test-environment.md)** でCI/CD統合

## テスト設計の特徴

### 🎯 包括的なカバレッジ
- **単体テスト**: コアライブラリとLaravel統合機能の詳細テスト
- **結合テスト**: コンポーネント間連携と外部システム統合テスト
- **E2Eテスト**: 実際のユーザーシナリオに基づく完全フローテスト

### 🏗️ 段階的実装アプローチ
- **フェーズ1**: 基盤テスト（コアライブラリ）
- **フェーズ2**: Laravel統合機能テスト
- **フェーズ3**: 包括的テスト（E2E、パフォーマンス）

### 🔧 実用的な環境設定
- **Docker統合**: 統一された開発・テスト環境
- **CI/CD対応**: GitHub Actionsとの完全統合
- **複数バージョン対応**: PHP 8.0-8.3、Laravel 9.x-11.x

### 📊 品質保証メトリクス
- **コードカバレッジ**: コアライブラリ95%以上、Laravel統合90%以上
- **テスト実行時間**: 単体テスト5分以内、結合テスト30分以内
- **自動化率**: CI/CDでの完全自動テスト実行

## 対象読者

### 開発者
- SaaSus SDK for PHPの機能追加・修正を行う開発者
- テストコードの実装・保守を担当する開発者
- コードレビューを行う開発者

### QAエンジニア
- テスト戦略の策定・実行を担当するQAエンジニア
- テスト自動化の推進を行うエンジニア
- 品質メトリクスの監視・改善を行うエンジニア

### プロジェクトマネージャー
- 開発プロジェクトの品質管理を行うマネージャー
- テスト工数の見積もり・計画を行うマネージャー
- リリース判定を行うマネージャー

## 関連リソース

### 外部ドキュメント
- [SaaSus Platform API Documentation](https://docs.saasus.io/)
- [PHPUnit Documentation](https://phpunit.de/documentation.html)
- [Laravel Testing Documentation](https://laravel.com/docs/testing)

### 開発ツール
- [PHPUnit](https://phpunit.de/) - テストフレームワーク
- [Mockery](http://docs.mockery.io/) - モックライブラリ
- [PHP CS Fixer](https://cs.symfony.com/) - コードスタイル修正
- [PHPStan](https://phpstan.org/) - 静的解析ツール

### CI/CDツール
- [GitHub Actions](https://github.com/features/actions) - CI/CDプラットフォーム
- [Codecov](https://codecov.io/) - カバレッジレポート
- [Docker](https://www.docker.com/) - コンテナ化プラットフォーム

## 貢献ガイドライン

### テスト設計書の更新
1. 新機能追加時は対応するテスト設計を追加
2. 既存機能変更時はテスト設計を更新
3. 実装完了後は実際の結果を反映

### 品質改善提案
1. テスト実行時間の最適化提案
2. カバレッジ向上のための提案
3. テストプロセス改善提案

### ドキュメント保守
1. 月次でのドキュメント内容確認
2. 新しいベストプラクティスの反映
3. 古い情報の更新・削除

## ライセンス

このテスト設計書は、SaaSus SDK for PHPと同じApache-2.0ライセンスの下で提供されます。

## お問い合わせ

- **開発チーム**: saasus@anti-pattern.co.jp
- **GitHub Issues**: https://github.com/saasus-platform/saasus-sdk-php/issues
- **ドキュメント**: https://docs.saasus.io/

---

**最終更新**: 2024年8月25日  
**バージョン**: 1.0.0  
**作成者**: Anti-Pattern Inc.
#!/bin/bash

# PHP SDK生成スクリプト
# READMEファイルを保護しながらSDKを生成する

set -e

echo "=== PHP SDK Generation Started ==="

# 生成するモジュール名の配列
MODULES="Auth Pricing Billing AwsMarketplace Integration ApiLog Communication"

# 依存関係をインストール（開発依存関係も含む）
echo "Installing dependencies..."
composer install --no-interaction --dev

# READMEファイルをバックアップ（SDK生成前に実行）
echo "Backing up existing README files..."
BACKUP_DIR=$(mktemp -d)
for module in $MODULES; do
  if [ -f "generated/$module/README.md" ]; then
    echo "Backing up README.md for $module"
    mkdir -p "$BACKUP_DIR/$module"
    cp "generated/$module/README.md" "$BACKUP_DIR/$module/"
  fi
  if [ -f "generated/$module/README_en.md" ]; then
    echo "Backing up README_en.md for $module"
    mkdir -p "$BACKUP_DIR/$module"
    cp "generated/$module/README_en.md" "$BACKUP_DIR/$module/"
  fi
done

# SDK生成
echo "Starting SDK generation..."
for module in $MODULES; do
  # モジュール名を小文字に変換（設定ファイル名用）
  config_name=$(echo "$module" | tr '[:upper:]' '[:lower:]')
  echo "Generating SDK for $module (config: $config_name)..."
  php vendor/bin/jane-openapi generate --config-file=jane-config/jane-openapi-configuration-$config_name.php
done
echo "SDK generation completed."

# READMEファイルを復元
echo "Restoring README files..."
for module in $MODULES; do
  if [ -f "$BACKUP_DIR/$module/README.md" ]; then
    echo "Restoring README.md for $module"
    cp "$BACKUP_DIR/$module/README.md" "generated/$module/"
  fi
  if [ -f "$BACKUP_DIR/$module/README_en.md" ]; then
    echo "Restoring README_en.md for $module"
    cp "$BACKUP_DIR/$module/README_en.md" "generated/$module/"
  fi
done

# バックアップディレクトリを削除
echo "Cleaning up backup directory..."
rm -rf "$BACKUP_DIR"

echo "=== PHP SDK generation with README preservation completed ==="
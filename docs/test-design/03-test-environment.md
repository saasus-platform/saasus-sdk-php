# テスト環境・実行環境設計

## 概要

SaaSus SDK for PHPのテスト実行環境は、開発者の環境に依存しない統一された環境を提供し、継続的インテグレーション（CI/CD）との統合を実現します。Docker環境を基盤とし、複数のPHP・Laravelバージョンでのテストを自動化します。

## 環境要件

### 基本要件
- **PHP**: 8.0.2以上（8.0, 8.1, 8.2, 8.3での動作確認）
- **Laravel**: 9.x - 11.x
- **Composer**: 2.x
- **Docker**: 20.x以上
- **Docker Compose**: 2.x以上

### 必要な環境変数
```bash
# SaaSus Platform API認証情報
SAASUS_SAAS_ID="test_saas_id"
SAASUS_API_KEY="test_api_key"
SAASUS_SECRET_KEY="test_secret_key"

# API エンドポイント
SAASUS_API_URL_BASE="https://api-test.saasus.io"
SAASUS_LOGIN_URL="https://auth-test.saasus.io/"

# テストモード設定
SAASUS_AUTH_MODE="api"

# データベース設定（テスト用）
DB_CONNECTION="sqlite"
DB_DATABASE=":memory:"

# Redis設定（テスト用）
REDIS_HOST="redis-test"
REDIS_PORT="6379"
REDIS_PASSWORD=""
REDIS_DB="0"
```

## Docker環境設定

### 開発・テスト用 Docker Compose
```yaml
# docker-compose.test.yml
version: '3.8'

services:
  # PHP テスト実行環境
  php-test:
    build:
      context: .
      dockerfile: docker/Dockerfile.test
      args:
        PHP_VERSION: ${PHP_VERSION:-8.1}
    volumes:
      - .:/var/www/html
      - ./docker/php/php.ini:/usr/local/etc/php/php.ini
      - vendor:/var/www/html/vendor
    environment:
      # SaaSus SDK設定
      - SAASUS_SAAS_ID=${TEST_SAASUS_SAAS_ID}
      - SAASUS_API_KEY=${TEST_SAASUS_API_KEY}
      - SAASUS_SECRET_KEY=${TEST_SAASUS_SECRET_KEY}
      - SAASUS_API_URL_BASE=https://api-test.saasus.io
      - SAASUS_LOGIN_URL=https://auth-test.saasus.io/
      - SAASUS_AUTH_MODE=api
      
      # Laravel設定
      - APP_ENV=testing
      - APP_KEY=base64:YourTestAppKeyHere
      - APP_DEBUG=true
      
      # データベース設定
      - DB_CONNECTION=sqlite
      - DB_DATABASE=:memory:
      
      # Redis設定
      - REDIS_HOST=redis-test
      - REDIS_PORT=6379
      
      # テスト設定
      - PHPUNIT_RESULT_CACHE=.phpunit.result.cache
    depends_on:
      - redis-test
    working_dir: /var/www/html
    command: tail -f /dev/null

  # Redis テスト環境
  redis-test:
    image: redis:7-alpine
    ports:
      - "6380:6379"
    command: redis-server --appendonly yes
    volumes:
      - redis-test-data:/data

  # Nginx テスト環境（E2Eテスト用）
  nginx-test:
    image: nginx:alpine
    ports:
      - "8080:80"
    volumes:
      - ./docker/nginx/test.conf:/etc/nginx/conf.d/default.conf
      - .:/var/www/html
    depends_on:
      - php-test

volumes:
  vendor:
  redis-test-data:
```

### PHP テスト用 Dockerfile
```dockerfile
# docker/Dockerfile.test
ARG PHP_VERSION=8.1
FROM php:${PHP_VERSION}-fpm-alpine

# 必要なパッケージのインストール
RUN apk add --no-cache \
    git \
    curl \
    libpng-dev \
    libxml2-dev \
    zip \
    unzip \
    sqlite \
    sqlite-dev

# PHP拡張のインストール
RUN docker-php-ext-install \
    pdo \
    pdo_sqlite \
    xml \
    gd \
    bcmath

# Redis拡張のインストール
RUN apk add --no-cache --virtual .build-deps $PHPIZE_DEPS \
    && pecl install redis \
    && docker-php-ext-enable redis \
    && apk del .build-deps

# Xdebugのインストール（カバレッジ用）
RUN apk add --no-cache --virtual .build-deps $PHPIZE_DEPS \
    && pecl install xdebug \
    && docker-php-ext-enable xdebug \
    && apk del .build-deps

# Composerのインストール
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 作業ディレクトリの設定
WORKDIR /var/www/html

# PHP設定ファイルのコピー
COPY docker/php/php.test.ini /usr/local/etc/php/php.ini

# ユーザー権限の設定
RUN addgroup -g 1000 -S www && \
    adduser -u 1000 -S www -G www

USER www

# Composerの依存関係インストール
COPY composer.json composer.lock ./
RUN composer install --no-scripts --no-autoloader

# アプリケーションファイルのコピー
COPY . .

# Composerオートローダーの生成
RUN composer dump-autoload --optimize

EXPOSE 9000
```

### PHP設定ファイル
```ini
; docker/php/php.test.ini
[PHP]
memory_limit = 512M
max_execution_time = 300
upload_max_filesize = 10M
post_max_size = 10M

[Date]
date.timezone = Asia/Tokyo

[Xdebug]
xdebug.mode = coverage
xdebug.start_with_request = yes
xdebug.client_host = host.docker.internal
xdebug.client_port = 9003
xdebug.log = /tmp/xdebug.log
```

### Nginx設定ファイル
```nginx
# docker/nginx/test.conf
server {
    listen 80;
    server_name localhost;
    root /var/www/html/public;
    index index.php index.html;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        fastcgi_pass php-test:9000;
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.ht {
        deny all;
    }
}
```

## PHPUnit設定

### PHPUnit設定ファイル
```xml
<?xml version="1.0" encoding="UTF-8"?>
<!-- phpunit.xml -->
<phpunit xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
         xsi:noNamespaceSchemaLocation="https://schema.phpunit.de/10.0/phpunit.xsd"
         bootstrap="test/bootstrap.php"
         colors="true"
         processIsolation="false"
         stopOnFailure="false"
         cacheDirectory=".phpunit.cache"
         backupGlobals="false"
         backupStaticProperties="false"
         beStrictAboutTestsThatDoNotTestAnything="true"
         beStrictAboutOutputDuringTests="true"
         failOnRisky="true"
         failOnWarning="true">
    
    <testsuites>
        <testsuite name="Unit">
            <directory>test/Unit</directory>
        </testsuite>
        <testsuite name="Integration">
            <directory>test/Integration</directory>
        </testsuite>
        <testsuite name="E2E">
            <directory>test/E2E</directory>
        </testsuite>
    </testsuites>
    
    <source>
        <include>
            <directory>src</directory>
        </include>
        <exclude>
            <directory>generated</directory>
            <directory>vendor</directory>
        </exclude>
    </source>
    
    <coverage>
        <report>
            <html outputDirectory="coverage-html" lowUpperBound="50" highLowerBound="80"/>
            <clover outputFile="coverage.xml"/>
            <text outputFile="coverage.txt" showUncoveredFiles="false"/>
        </report>
    </coverage>
    
    <groups>
        <exclude>
            <group>external-api</group>
            <group>slow</group>
        </exclude>
    </groups>
    
    <php>
        <!-- SaaSus SDK設定 -->
        <env name="SAASUS_SAAS_ID" value="test_saas_id"/>
        <env name="SAASUS_API_KEY" value="test_api_key"/>
        <env name="SAASUS_SECRET_KEY" value="test_secret_key"/>
        <env name="SAASUS_API_URL_BASE" value="https://api-test.saasus.io"/>
        <env name="SAASUS_LOGIN_URL" value="https://auth-test.saasus.io/"/>
        <env name="SAASUS_AUTH_MODE" value="api"/>
        
        <!-- Laravel設定 -->
        <env name="APP_ENV" value="testing"/>
        <env name="APP_KEY" value="base64:YourTestAppKeyHere"/>
        <env name="APP_DEBUG" value="true"/>
        
        <!-- データベース設定 -->
        <env name="DB_CONNECTION" value="sqlite"/>
        <env name="DB_DATABASE" value=":memory:"/>
        
        <!-- Redis設定 -->
        <env name="REDIS_HOST" value="redis-test"/>
        <env name="REDIS_PORT" value="6379"/>
        
        <!-- テスト設定 -->
        <env name="CACHE_DRIVER" value="array"/>
        <env name="SESSION_DRIVER" value="array"/>
        <env name="QUEUE_CONNECTION" value="sync"/>
    </php>
    
    <logging>
        <junit outputFile="test-results/junit.xml"/>
    </logging>
</phpunit>
```

### 外部API用PHPUnit設定
```xml
<?xml version="1.0" encoding="UTF-8"?>
<!-- phpunit.external.xml -->
<phpunit xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
         xsi:noNamespaceSchemaLocation="https://schema.phpunit.de/10.0/phpunit.xsd"
         bootstrap="test/bootstrap.php"
         colors="true"
         processIsolation="false"
         stopOnFailure="false">
    
    <testsuites>
        <testsuite name="ExternalAPI">
            <directory>test/Integration</directory>
        </testsuite>
    </testsuites>
    
    <groups>
        <include>
            <group>external-api</group>
        </include>
    </groups>
    
    <php>
        <!-- 実際のテスト環境設定 -->
        <env name="SAASUS_SAAS_ID" value="${TEST_SAASUS_SAAS_ID}"/>
        <env name="SAASUS_API_KEY" value="${TEST_SAASUS_API_KEY}"/>
        <env name="SAASUS_SECRET_KEY" value="${TEST_SAASUS_SECRET_KEY}"/>
        <env name="SAASUS_API_URL_BASE" value="https://api-test.saasus.io"/>
    </php>
</phpunit>
```

## テストブートストラップ

### テストブートストラップファイル
```php
<?php
// test/bootstrap.php

require_once __DIR__ . '/../vendor/autoload.php';

// テスト環境の初期化
if (!defined('PHPUNIT_RUNNING')) {
    define('PHPUNIT_RUNNING', true);
}

// 環境変数の設定
if (file_exists(__DIR__ . '/../.env.testing')) {
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../', '.env.testing');
    $dotenv->load();
}

// タイムゾーンの設定
date_default_timezone_set('Asia/Tokyo');

// テスト用のエラーハンドリング
error_reporting(E_ALL);
ini_set('display_errors', 1);

// テストヘルパーの読み込み
require_once __DIR__ . '/Helpers/TestHelper.php';
require_once __DIR__ . '/Helpers/MockHelper.php';
require_once __DIR__ . '/Helpers/RequestHelper.php';

// Laravel テストケースの初期化（Laravel統合テスト用）
if (class_exists('Illuminate\Foundation\Application')) {
    $app = require_once __DIR__ . '/../bootstrap/app.php';
    $app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();
}

// テストデータベースの初期化
if (getenv('DB_CONNECTION') === 'sqlite' && getenv('DB_DATABASE') === ':memory:') {
    // インメモリSQLiteの場合は何もしない
} else {
    // 実際のデータベースを使用する場合のマイグレーション
    if (class_exists('Illuminate\Support\Facades\Artisan')) {
        Illuminate\Support\Facades\Artisan::call('migrate:fresh', ['--env' => 'testing']);
    }
}

// グローバルテスト設定
$GLOBALS['test_start_time'] = microtime(true);

// テスト終了時のクリーンアップ
register_shutdown_function(function () {
    $execution_time = microtime(true) - $GLOBALS['test_start_time'];
    echo "\nTotal test execution time: " . round($execution_time, 2) . " seconds\n";
    
    // テストデータのクリーンアップ
    if (isset($GLOBALS['test_data_manager'])) {
        $GLOBALS['test_data_manager']->cleanup();
    }
});
```

## Composer Scripts設定

### テスト実行用スクリプト
```json
{
    "scripts": {
        "test": [
            "phpunit"
        ],
        "test:unit": [
            "phpunit --testsuite=Unit"
        ],
        "test:integration": [
            "phpunit --testsuite=Integration"
        ],
        "test:e2e": [
            "phpunit --testsuite=E2E"
        ],
        "test:external": [
            "phpunit --configuration phpunit.external.xml"
        ],
        "test:coverage": [
            "phpunit --coverage-html coverage-html --coverage-clover coverage.xml"
        ],
        "test:coverage-text": [
            "phpunit --coverage-text"
        ],
        "test:watch": [
            "phpunit-watcher watch --filter=Unit"
        ],
        "test:parallel": [
            "paratest --processes=4"
        ],
        "test:docker": [
            "docker-compose -f docker-compose.test.yml run --rm php-test composer test"
        ],
        "test:docker-unit": [
            "docker-compose -f docker-compose.test.yml run --rm php-test composer test:unit"
        ],
        "test:docker-integration": [
            "docker-compose -f docker-compose.test.yml run --rm php-test composer test:integration"
        ],
        "test:setup": [
            "docker-compose -f docker-compose.test.yml build",
            "docker-compose -f docker-compose.test.yml up -d"
        ],
        "test:cleanup": [
            "docker-compose -f docker-compose.test.yml down -v"
        ],
        "cs-fix": [
            "php-cs-fixer fix --config=.php-cs-fixer.php"
        ],
        "cs-check": [
            "php-cs-fixer fix --config=.php-cs-fixer.php --dry-run --diff"
        ],
        "static-analysis": [
            "phpstan analyse src test --level=8"
        ]
    },
    "scripts-descriptions": {
        "test": "全テストを実行",
        "test:unit": "単体テストのみ実行",
        "test:integration": "結合テストのみ実行",
        "test:e2e": "E2Eテストのみ実行",
        "test:external": "外部API結合テストを実行",
        "test:coverage": "カバレッジレポート付きでテスト実行",
        "test:docker": "Docker環境で全テストを実行",
        "test:setup": "Docker テスト環境をセットアップ",
        "test:cleanup": "Docker テスト環境をクリーンアップ"
    }
}
```

## CI/CD統合

### GitHub Actions ワークフロー
```yaml
# .github/workflows/tests.yml
name: Tests

on:
  push:
    branches: [ main, develop ]
  pull_request:
    branches: [ main ]
  schedule:
    - cron: '0 2 * * *' # 毎日午前2時に実行

jobs:
  unit-tests:
    name: Unit Tests
    runs-on: ubuntu-latest
    
    strategy:
      fail-fast: false
      matrix:
        php-version: [8.0, 8.1, 8.2, 8.3]
        laravel-version: [9.x, 10.x, 11.x]
        exclude:
          # PHP 8.0 は Laravel 11.x をサポートしない
          - php-version: 8.0
            laravel-version: 11.x
    
    steps:
    - name: Checkout code
      uses: actions/checkout@v4
    
    - name: Setup PHP
      uses: shivammathur/setup-php@v2
      with:
        php-version: ${{ matrix.php-version }}
        extensions: mbstring, xml, ctype, iconv, intl, pdo_sqlite, redis
        coverage: xdebug
        tools: composer:v2
    
    - name: Cache Composer packages
      id: composer-cache
      uses: actions/cache@v3
      with:
        path: vendor
        key: ${{ runner.os }}-php-${{ matrix.php-version }}-${{ hashFiles('**/composer.lock') }}
        restore-keys: |
          ${{ runner.os }}-php-${{ matrix.php-version }}-
    
    - name: Install dependencies
      run: |
        composer install --prefer-dist --no-progress --no-suggest
        composer require "laravel/framework:${{ matrix.laravel-version }}" --no-update
        composer update --prefer-dist --no-progress
    
    - name: Create test environment file
      run: |
        cp .env.testing.example .env.testing
        php -r "file_put_contents('.env.testing', str_replace('APP_KEY=', 'APP_KEY='.base64_encode(random_bytes(32)), file_get_contents('.env.testing')));"
    
    - name: Run unit tests
      run: composer test:unit
    
    - name: Upload coverage to Codecov
      if: matrix.php-version == '8.1' && matrix.laravel-version == '10.x'
      uses: codecov/codecov-action@v3
      with:
        file: ./coverage.xml
        flags: unit
        name: unit-tests

  integration-tests:
    name: Integration Tests
    runs-on: ubuntu-latest
    
    services:
      redis:
        image: redis:7-alpine
        ports:
          - 6379:6379
        options: >-
          --health-cmd "redis-cli ping"
          --health-interval 10s
          --health-timeout 5s
          --health-retries 5
    
    strategy:
      matrix:
        php-version: [8.1, 8.2]
    
    steps:
    - name: Checkout code
      uses: actions/checkout@v4
    
    - name: Setup PHP
      uses: shivammathur/setup-php@v2
      with:
        php-version: ${{ matrix.php-version }}
        extensions: mbstring, xml, ctype, iconv, intl, pdo_sqlite, redis
        coverage: xdebug
    
    - name: Install dependencies
      run: composer install --prefer-dist --no-progress
    
    - name: Run integration tests
      env:
        TEST_SAASUS_SAAS_ID: ${{ secrets.TEST_SAASUS_SAAS_ID }}
        TEST_SAASUS_API_KEY: ${{ secrets.TEST_SAASUS_API_KEY }}
        TEST_SAASUS_SECRET_KEY: ${{ secrets.TEST_SAASUS_SECRET_KEY }}
        REDIS_HOST: localhost
        REDIS_PORT: 6379
      run: composer test:integration
    
    - name: Upload coverage to Codecov
      if: matrix.php-version == '8.1'
      uses: codecov/codecov-action@v3
      with:
        file: ./coverage.xml
        flags: integration
        name: integration-tests

  external-api-tests:
    name: External API Tests
    runs-on: ubuntu-latest
    if: github.event_name == 'schedule' || contains(github.event.head_commit.message, '[test-external]')
    
    steps:
    - name: Checkout code
      uses: actions/checkout@v4
    
    - name: Setup PHP
      uses: shivammathur/setup-php@v2
      with:
        php-version: 8.1
        extensions: mbstring, xml, ctype, iconv, intl, pdo_sqlite
    
    - name: Install dependencies
      run: composer install --prefer-dist --no-progress
    
    - name: Run external API tests
      env:
        TEST_SAASUS_SAAS_ID: ${{ secrets.TEST_SAASUS_SAAS_ID }}
        TEST_SAASUS_API_KEY: ${{ secrets.TEST_SAASUS_API_KEY }}
        TEST_SAASUS_SECRET_KEY: ${{ secrets.TEST_SAASUS_SECRET_KEY }}
      run: composer test:external

  code-quality:
    name: Code Quality
    runs-on: ubuntu-latest
    
    steps:
    - name: Checkout code
      uses: actions/checkout@v4
    
    - name: Setup PHP
      uses: shivammathur/setup-php@v2
      with:
        php-version: 8.1
        extensions: mbstring, xml, ctype, iconv, intl
        tools: composer:v2, phpstan, php-cs-fixer
    
    - name: Install dependencies
      run: composer install --prefer-dist --no-progress
    
    - name: Run PHP CS Fixer
      run: composer cs-check
    
    - name: Run PHPStan
      run: composer static-analysis
```

## 環境別設定ファイル

### 開発環境設定
```bash
# .env.testing.example
APP_NAME="SaaSus SDK Test"
APP_ENV=testing
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost:8080

# SaaSus SDK設定
SAASUS_SAAS_ID=test_saas_id
SAASUS_API_KEY=test_api_key
SAASUS_SECRET_KEY=test_secret_key
SAASUS_API_URL_BASE=https://api-test.saasus.io
SAASUS_LOGIN_URL=https://auth-test.saasus.io/
SAASUS_AUTH_MODE=api

# データベース設定
DB_CONNECTION=sqlite
DB_DATABASE=:memory:

# Redis設定
REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

# キャッシュ設定
CACHE_DRIVER=array
SESSION_DRIVER=array
QUEUE_CONNECTION=sync

# ログ設定
LOG_CHANNEL=single
LOG_LEVEL=debug
```

### CI環境設定
```bash
# .env.ci
APP_ENV=testing
APP_KEY=base64:YourCIAppKeyHere
APP_DEBUG=false

# SaaSus SDK設定（GitHub Secretsから注入）
SAASUS_SAAS_ID=${TEST_SAASUS_SAAS_ID}
SAASUS_API_KEY=${TEST_SAASUS_API_KEY}
SAASUS_SECRET_KEY=${TEST_SAASUS_SECRET_KEY}
SAASUS_API_URL_BASE=https://api-test.saasus.io

# テスト設定
DB_CONNECTION=sqlite
DB_DATABASE=:memory:
CACHE_DRIVER=array
SESSION_DRIVER=array
QUEUE_CONNECTION=sync

# ログ設定
LOG_CHANNEL=stderr
LOG_LEVEL=error
```

## Makefile統合

### 統一コマンドインターフェース
```makefile
# Makefile
.PHONY: help test test-unit test-integration test-e2e test-external test-coverage test-watch
.PHONY: setup cleanup docker-setup docker-cleanup
.PHONY: cs-fix cs-check static-analysis

# デフォルトターゲット
help: ## ヘルプを表示
	@grep -E '^[a-zA-Z_-]+:.*?## .*$$' $(MAKEFILE_LIST) | sort | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[36m%-20s\033[0m %s\n", $$1, $$2}'

# テスト実行
test: ## 全テストを実行
	composer test

test-unit: ## 単体テストを実行
	composer test:unit

test-integration: ## 結合テストを実行
	composer test:integration

test-e2e: ## E2Eテストを実行
	composer test:e2e

test-external: ## 外部API結合テストを実行
	composer test:external

test-coverage: ## カバレッジレポート付きでテスト実行
	composer test:coverage

test-watch: ## テストを監視モードで実行
	composer test:watch

# Docker環境
docker-test: ## Docker環境で全テストを実行
	docker-compose -f docker-compose.test.yml run --rm php-test composer test

docker-test-unit: ## Docker環境で単体テストを実行
	docker-compose -f docker-compose.test.yml run --rm php-test composer test:unit

docker-test-integration: ## Docker環境で結合テストを実行
	docker-compose -f docker-compose.test.yml run --rm php-test composer test:integration

# 環境管理
setup: ## テスト環境をセットアップ
	cp .env.testing.example .env.testing
	composer install
	@echo "テスト環境のセットアップが完了しました"

docker-setup: ## Docker テスト環境をセットアップ
	docker-compose -f docker-compose.test.yml build
	docker-compose -f docker-compose.test.yml up -d
	@echo "Docker テスト環境が起動しました"

cleanup: ## テスト環境をクリーンアップ
	rm -rf coverage-html coverage.xml .phpunit.result.cache
	@echo "テスト環境のクリーンアップが完了しました"

docker-cleanup: ## Docker テスト環境をクリーンアップ
	docker-compose -f docker-compose.test.yml down -v
	docker system prune -f
	@echo "Docker テスト環境のクリーンアップが完了しました"

# コード品質
cs-fix: ## コードスタイルを修正
	composer cs-fix

cs-check: ## コードスタイルをチェック
	composer cs-check

static-analysis: ## 静的解析を実行
	composer static-analysis

# 複合コマンド
ci: cs-check static-analysis test ## CI環境で実行される全チェック

# 開発支援
install: ## 依存関係をインストール
	composer install

update: ## 依存関係を更新
	composer update

fresh: cleanup setup ## 環境を初期化してセットアップ
```

この環境設定により、開発者は統一された環境でテストを実行でき、CI/CDパイプラインとの統合も実現できます。

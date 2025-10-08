#!/bin/bash

# SaaSus SDK for PHP - E2Eテスト実行スクリプト
# 
# このスクリプトは、E2Eテストを安全に実行するためのラッパーです。
# 環境変数の確認、テスト実行、結果レポートの生成を行います。

set -e  # エラー時に終了

# スクリプトのディレクトリを取得
SCRIPT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
PROJECT_ROOT="$(dirname "$SCRIPT_DIR")"

# カラー出力の設定
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m' # No Color

# ログ関数
log_info() {
    echo -e "${BLUE}[INFO]${NC} $1"
}

log_success() {
    echo -e "${GREEN}[SUCCESS]${NC} $1"
}

log_warning() {
    echo -e "${YELLOW}[WARNING]${NC} $1"
}

log_error() {
    echo -e "${RED}[ERROR]${NC} $1"
}

# ヘルプメッセージ
show_help() {
    cat << EOF
SaaSus SDK for PHP - E2Eテスト実行スクリプト

使用方法:
    $0 [オプション] [テストグループ]

オプション:
    -h, --help          このヘルプメッセージを表示
    -c, --coverage      カバレッジレポートを生成
    -v, --verbose       詳細出力モード
    --dry-run          実際にテストを実行せず、設定のみ確認
    --cleanup-only     クリーンアップのみ実行
    --no-cleanup       テスト後のクリーンアップをスキップ

テストグループ:
    all                全てのE2Eテスト（デフォルト）
    auth               Auth関連のE2Eテスト
    tenant-crud        テナントCRUDテスト
    user-crud          ユーザーCRUDテスト
    role-crud          ロールCRUDテスト

例:
    $0                          # 全てのE2Eテストを実行
    $0 auth                     # Auth関連テストのみ実行
    $0 -c tenant-crud           # テナントCRUDテストをカバレッジ付きで実行
    $0 --dry-run               # 設定確認のみ
    $0 --cleanup-only          # クリーンアップのみ実行

環境変数:
    SAASUS_SECRET_KEY          SaaSus Platform シークレットキー（必須）
    SAASUS_SAAS_ID            SaaSus Platform SaaS ID（必須）
    SAASUS_API_KEY            SaaSus Platform API キー（必須）
    SAASUS_API_URL_BASE       SaaSus Platform API ベースURL（オプション）

EOF
}

# .envファイルの読み込み
load_env_file() {
    local env_files=(".env.testing" ".env")
    
    for env_file in "${env_files[@]}"; do
        local env_path="$PROJECT_ROOT/$env_file"
        if [[ -f "$env_path" ]]; then
            log_info ".envファイルを読み込み中: $env_file"
            
            # .envファイルの内容を読み込み
            while IFS= read -r line || [[ -n "$line" ]]; do
                # コメント行と空行をスキップ
                if [[ "$line" =~ ^[[:space:]]*# ]] || [[ -z "${line// }" ]]; then
                    continue
                fi
                
                # KEY=VALUE形式の行を処理
                if [[ "$line" =~ ^[[:space:]]*([^=]+)=(.*)$ ]]; then
                    local key="${BASH_REMATCH[1]// /}"  # 空白を除去
                    local value="${BASH_REMATCH[2]}"
                    
                    # 前後の引用符を除去
                    value="${value%\"}"
                    value="${value#\"}"
                    value="${value%\'}"
                    value="${value#\'}"
                    
                    # 環境変数が未設定の場合のみ設定
                    if [[ -z "${!key:-}" ]]; then
                        export "$key=$value"
                    fi
                fi
            done < "$env_path"
            
            log_success ".envファイル読み込み完了: $env_file"
            break
        fi
    done
}

# 環境変数の確認
check_environment() {
    log_info "環境変数の確認中..."
    
    # .envファイルの読み込みを試行
    load_env_file
    
    local missing_vars=()
    
    if [[ -z "${SAASUS_SECRET_KEY:-}" ]]; then
        missing_vars+=("SAASUS_SECRET_KEY")
    fi
    
    if [[ -z "${SAASUS_SAAS_ID:-}" ]]; then
        missing_vars+=("SAASUS_SAAS_ID")
    fi
    
    if [[ -z "${SAASUS_API_KEY:-}" ]]; then
        missing_vars+=("SAASUS_API_KEY")
    fi
    
    if [[ ${#missing_vars[@]} -gt 0 ]]; then
        log_error "必要な環境変数が設定されていません:"
        for var in "${missing_vars[@]}"; do
            echo "  - $var"
        done
        echo ""
        echo "以下のいずれかの方法で環境変数を設定してください:"
        echo "1. 環境変数として直接設定:"
        echo "   export SAASUS_SECRET_KEY=\"your_secret_key\""
        echo "   export SAASUS_SAAS_ID=\"your_saas_id\""
        echo "   export SAASUS_API_KEY=\"your_api_key\""
        echo ""
        echo "2. プロジェクトルートに .env または .env.testing ファイルを作成"
        echo ""
        echo "詳細は test/E2E/README.md を参照してください。"
        exit 1
    fi
    
    log_success "環境変数の確認完了"
    log_info "  SAASUS_SECRET_KEY: 設定済み"
    log_info "  SAASUS_SAAS_ID: 設定済み"
    log_info "  SAASUS_API_KEY: 設定済み"
    
    # オプション環境変数の設定
    export SAASUS_API_URL_BASE="${SAASUS_API_URL_BASE:-https://api-test.saasus.io}"
    export SAASUS_LOGIN_URL="${SAASUS_LOGIN_URL:-https://auth-test.saasus.io/}"
    export SAASUS_AUTH_MODE="${SAASUS_AUTH_MODE:-api}"
    
    log_info "  SAASUS_API_URL_BASE: $SAASUS_API_URL_BASE"
    log_info "  SAASUS_LOGIN_URL: $SAASUS_LOGIN_URL"
    log_info "  SAASUS_AUTH_MODE: $SAASUS_AUTH_MODE"
}

# 依存関係の確認
check_dependencies() {
    log_info "依存関係の確認中..."
    
    # Composerの確認
    if ! command -v composer &> /dev/null; then
        log_error "Composerがインストールされていません"
        exit 1
    fi
    
    # vendor/autoload.phpの確認
    if [[ ! -f "$PROJECT_ROOT/vendor/autoload.php" ]]; then
        log_warning "Composer依存関係がインストールされていません"
        log_info "composer installを実行中..."
        cd "$PROJECT_ROOT"
        composer install --optimize-autoloader
    fi
    
    # PHPUnitの確認
    if [[ ! -f "$PROJECT_ROOT/vendor/bin/phpunit" ]]; then
        log_error "PHPUnitがインストールされていません"
        log_info "開発依存関係を含めてcomposer installを実行中..."
        cd "$PROJECT_ROOT"
        composer install --optimize-autoloader
        
        # 再度確認
        if [[ ! -f "$PROJECT_ROOT/vendor/bin/phpunit" ]]; then
            log_error "PHPUnitのインストールに失敗しました"
            log_info "composer.jsonにphpunit/phpunitが開発依存関係として含まれているか確認してください"
            exit 1
        fi
    fi
    
    log_success "依存関係の確認完了"
}

# テスト結果ディレクトリの準備
prepare_test_directories() {
    log_info "テスト結果ディレクトリの準備中..."
    
    mkdir -p "$PROJECT_ROOT/test-results"
    mkdir -p "$PROJECT_ROOT/coverage-html-e2e"
    
    log_success "テスト結果ディレクトリの準備完了"
}

# クリーンアップ処理
cleanup_test_resources() {
    log_info "テストリソースのクリーンアップ中..."
    
    # 一時ファイルの削除
    rm -f "$PROJECT_ROOT/.phpunit.result.cache"
    rm -rf "$PROJECT_ROOT/.phpunit.cache"
    
    log_success "クリーンアップ完了"
}

# E2Eテストの実行
run_e2e_tests() {
    local test_group="$1"
    local coverage_flag="$2"
    local verbose_flag="$3"
    
    log_info "E2Eテストの実行開始: $test_group"
    
    cd "$SCRIPT_DIR"
    
    local phpunit_cmd="$PROJECT_ROOT/vendor/bin/phpunit"
    local phpunit_config="phpunit.e2e.xml"
    local phpunit_args=()
    
    # 設定ファイルの指定
    phpunit_args+=("--configuration" "$phpunit_config")
    
    # テストグループの指定
    case "$test_group" in
        "all")
            phpunit_args+=("--group" "e2e")
            ;;
        "auth")
            phpunit_args+=("--group" "auth")
            ;;
        "tenant-crud")
            phpunit_args+=("--group" "tenant-crud")
            ;;
        "user-crud")
            phpunit_args+=("--group" "user-crud")
            ;;
        "role-crud")
            phpunit_args+=("--group" "role-crud")
            ;;
        *)
            log_error "不明なテストグループ: $test_group"
            exit 1
            ;;
    esac
    
    # カバレッジオプション
    if [[ "$coverage_flag" == "true" ]]; then
        phpunit_args+=("--coverage-html" "../coverage-html-e2e")
        phpunit_args+=("--coverage-clover" "../coverage-e2e.xml")
    fi
    
    # 詳細出力オプション
    if [[ "$verbose_flag" == "true" ]]; then
        phpunit_args+=("--verbose")
    fi
    
    # テスト実行
    log_info "実行コマンド: $phpunit_cmd ${phpunit_args[*]}"
    
    if "$phpunit_cmd" "${phpunit_args[@]}"; then
        log_success "E2Eテスト実行完了"
        return 0
    else
        log_error "E2Eテスト実行失敗"
        return 1
    fi
}

# テスト結果レポートの生成
generate_test_report() {
    local test_group="$1"
    local coverage_flag="$2"
    
    log_info "テスト結果レポートの生成中..."
    
    local report_file="$PROJECT_ROOT/test-results/e2e-test-report-$(date +%Y%m%d-%H%M%S).txt"
    
    cat > "$report_file" << EOF
SaaSus SDK for PHP - E2Eテスト実行レポート
==========================================

実行日時: $(date)
テストグループ: $test_group
カバレッジ生成: $coverage_flag

環境情報:
- PHP バージョン: $(php --version | head -n 1)
- SaaSus API URL: ${SAASUS_API_URL_BASE}
- テスト実行ディレクトリ: $SCRIPT_DIR

EOF
    
    # JUnitレポートが存在する場合は情報を追加
    if [[ -f "$PROJECT_ROOT/test-results/junit-e2e.xml" ]]; then
        echo "JUnitレポート: test-results/junit-e2e.xml" >> "$report_file"
    fi
    
    # カバレッジレポートが存在する場合は情報を追加
    if [[ "$coverage_flag" == "true" && -f "$PROJECT_ROOT/coverage-e2e.xml" ]]; then
        echo "カバレッジレポート: coverage-e2e.xml" >> "$report_file"
        echo "カバレッジHTML: coverage-html-e2e/index.html" >> "$report_file"
    fi
    
    log_success "テスト結果レポート生成完了: $report_file"
}

# メイン処理
main() {
    local test_group="all"
    local coverage_flag="false"
    local verbose_flag="false"
    local dry_run="false"
    local cleanup_only="false"
    local no_cleanup="false"
    
    # コマンドライン引数の解析
    while [[ $# -gt 0 ]]; do
        case $1 in
            -h|--help)
                show_help
                exit 0
                ;;
            -c|--coverage)
                coverage_flag="true"
                shift
                ;;
            -v|--verbose)
                verbose_flag="true"
                shift
                ;;
            --dry-run)
                dry_run="true"
                shift
                ;;
            --cleanup-only)
                cleanup_only="true"
                shift
                ;;
            --no-cleanup)
                no_cleanup="true"
                shift
                ;;
            all|auth|tenant-crud|user-crud|role-crud)
                test_group="$1"
                shift
                ;;
            *)
                log_error "不明なオプション: $1"
                show_help
                exit 1
                ;;
        esac
    done
    
    # ヘッダー表示
    echo "========================================"
    echo "SaaSus SDK for PHP - E2Eテスト実行"
    echo "========================================"
    echo ""
    
    # クリーンアップのみの場合
    if [[ "$cleanup_only" == "true" ]]; then
        cleanup_test_resources
        exit 0
    fi
    
    # 環境確認
    check_environment
    check_dependencies
    prepare_test_directories
    
    # ドライランの場合はここで終了
    if [[ "$dry_run" == "true" ]]; then
        log_success "ドライラン完了 - 設定に問題ありません"
        exit 0
    fi
    
    # テスト実行
    local test_result=0
    if ! run_e2e_tests "$test_group" "$coverage_flag" "$verbose_flag"; then
        test_result=1
    fi
    
    # レポート生成
    generate_test_report "$test_group" "$coverage_flag"
    
    # クリーンアップ
    if [[ "$no_cleanup" != "true" ]]; then
        cleanup_test_resources
    fi
    
    # 結果表示
    echo ""
    echo "========================================"
    if [[ $test_result -eq 0 ]]; then
        log_success "E2Eテスト実行完了"
    else
        log_error "E2Eテスト実行失敗"
    fi
    echo "========================================"
    
    exit $test_result
}

# スクリプト実行
main "$@"
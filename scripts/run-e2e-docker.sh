#!/bin/bash

# SaaSus SDK for PHP - Docker環境でのE2Eテスト実行スクリプト
# 
# このスクリプトは、Dockerコンテナ内でE2Eテストを実行します。
# PHPやComposerのローカルインストールは不要です。

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
SaaSus SDK for PHP - Docker環境でのE2Eテスト実行スクリプト

使用方法:
    $0 [オプション] [テストグループ]

オプション:
    -h, --help          このヘルプメッセージを表示
    -c, --coverage      カバレッジレポートを生成
    -v, --verbose       詳細出力モード
    --build             Dockerイメージを強制的に再ビルド
    --skip-build        Dockerイメージのビルドチェックをスキップ
    --web               テスト結果表示用Webサーバーも起動
    --shell             テストコンテナのシェルに接続
    --cleanup           Docker環境をクリーンアップ
    --dry-run          実際にテストを実行せず、設定のみ確認

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
    $0 --build --web            # イメージ再ビルド後、Webサーバー付きで実行
    $0 --skip-build auth        # ビルドチェックをスキップしてAuthテスト実行
    $0 --shell                  # テストコンテナのシェルに接続
    $0 --cleanup               # Docker環境をクリーンアップ

環境変数:
    SAASUS_SECRET_KEY          SaaSus Platform シークレットキー（必須）
    SAASUS_SAAS_ID            SaaSus Platform SaaS ID（必須）
    SAASUS_API_KEY            SaaSus Platform API キー（必須）
    SAASUS_API_URL_BASE       SaaSus Platform API ベースURL（オプション）

EOF
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
        echo "2. プロジェクトルートに .env ファイルを作成"
        echo ""
        echo "詳細は test/E2E/README.md を参照してください。"
        exit 1
    fi
    
    log_success "環境変数の確認完了"
    log_info "  SAASUS_SECRET_KEY: 設定済み"
    log_info "  SAASUS_SAAS_ID: 設定済み"
    log_info "  SAASUS_API_KEY: 設定済み"
    log_info "  SAASUS_API_URL_BASE: ${SAASUS_API_URL_BASE:-https://dev.saasus.io}"
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

# Dockerの確認
check_docker() {
    log_info "Docker環境の確認中..."
    
    if ! command -v docker &> /dev/null; then
        log_error "Dockerがインストールされていません"
        echo "Dockerをインストールしてから再実行してください。"
        echo "https://docs.docker.com/get-docker/"
        exit 1
    fi
    
    if ! command -v docker-compose &> /dev/null && ! docker compose version &> /dev/null; then
        log_error "Docker Composeがインストールされていません"
        echo "Docker Composeをインストールしてから再実行してください。"
        exit 1
    fi
    
    # Dockerデーモンの確認
    if ! docker info &> /dev/null; then
        log_error "Dockerデーモンが起動していません"
        echo "Dockerデーモンを起動してから再実行してください。"
        exit 1
    fi
    
    log_success "Docker環境の確認完了"
}

# Docker Composeコマンドの取得
get_docker_compose_cmd() {
    if command -v docker-compose &> /dev/null; then
        echo "docker-compose"
    else
        echo "docker compose"
    fi
}

# Dockerイメージのビルド
build_docker_image() {
    local force_build="$1"
    
    log_info "Dockerイメージの確認中..."
    
    local compose_cmd=$(get_docker_compose_cmd)
    
    if [[ "$force_build" == "true" ]]; then
        log_info "Dockerイメージを強制的に再ビルド中..."
        cd "$PROJECT_ROOT"
        $compose_cmd -f docker-compose.e2e.yml build --no-cache saasus-e2e-test
    else
        # イメージが存在しない場合のみビルド
        if ! docker images | grep -q "saasus-sdk-php.*saasus-e2e-test"; then
            log_info "Dockerイメージをビルド中..."
            cd "$PROJECT_ROOT"
            $compose_cmd -f docker-compose.e2e.yml build saasus-e2e-test
        else
            log_info "Dockerイメージは既に存在します - 再ビルドをスキップ"
            
            # PHPUnitが正常に動作するかチェック
            log_info "PHPUnitの動作確認中..."
            if ! $compose_cmd -f docker-compose.e2e.yml run --rm saasus-e2e-test php -v &> /dev/null; then
                log_warning "PHPが正常に動作しません。イメージを再ビルドします..."
                cd "$PROJECT_ROOT"
                $compose_cmd -f docker-compose.e2e.yml build saasus-e2e-test
            else
                log_success "既存のDockerイメージを使用します"
            fi
        fi
    fi
    
    log_success "Dockerイメージの準備完了"
}

# テスト結果ディレクトリの準備
prepare_test_directories() {
    log_info "テスト結果ディレクトリの準備中..."
    
    mkdir -p "$PROJECT_ROOT/test-results"
    mkdir -p "$PROJECT_ROOT/coverage-html-e2e"
    
    log_success "テスト結果ディレクトリの準備完了"
}

# E2Eテストの実行
run_e2e_tests() {
    local test_group="$1"
    local coverage_flag="$2"
    local verbose_flag="$3"
    
    log_info "Docker環境でE2Eテストを実行中: $test_group"
    
    cd "$PROJECT_ROOT"
    local compose_cmd=$(get_docker_compose_cmd)
    
    # テスト実行用のコマンドを構築
    local test_cmd="./test/run-e2e-tests.sh"
    
    if [[ "$coverage_flag" == "true" ]]; then
        test_cmd="$test_cmd -c"
    fi
    
    if [[ "$verbose_flag" == "true" ]]; then
        test_cmd="$test_cmd -v"
    fi
    
    test_cmd="$test_cmd $test_group"
    
    log_info "実行コマンド: $test_cmd"
    
    # Dockerコンテナでテスト実行
    if $compose_cmd -f docker-compose.e2e.yml run --rm saasus-e2e-test bash -c "$test_cmd"; then
        log_success "E2Eテスト実行完了"
        return 0
    else
        log_error "E2Eテスト実行失敗"
        return 1
    fi
}

# Webサーバーの起動
start_web_server() {
    log_info "テスト結果表示用Webサーバーを起動中..."
    
    cd "$PROJECT_ROOT"
    local compose_cmd=$(get_docker_compose_cmd)
    
    $compose_cmd -f docker-compose.e2e.yml --profile web up -d saasus-e2e-web
    
    log_success "Webサーバーが起動しました"
    log_info "テスト結果は http://localhost:8080 で確認できます"
}

# シェル接続
connect_shell() {
    log_info "テストコンテナのシェルに接続中..."
    
    cd "$PROJECT_ROOT"
    local compose_cmd=$(get_docker_compose_cmd)
    
    # コンテナが起動していない場合は起動
    $compose_cmd -f docker-compose.e2e.yml up -d saasus-e2e-test
    
    # シェルに接続
    $compose_cmd -f docker-compose.e2e.yml exec saasus-e2e-test bash
}

# クリーンアップ
cleanup_docker() {
    log_info "Docker環境をクリーンアップ中..."
    
    cd "$PROJECT_ROOT"
    local compose_cmd=$(get_docker_compose_cmd)
    
    # コンテナとネットワークを停止・削除
    $compose_cmd -f docker-compose.e2e.yml --profile web down -v
    
    # 未使用のDockerリソースをクリーンアップ
    docker system prune -f
    
    log_success "Docker環境のクリーンアップ完了"
}

# メイン処理
main() {
    local test_group="all"
    local coverage_flag="false"
    local verbose_flag="false"
    local force_build="false"
    local skip_build="false"
    local start_web="false"
    local shell_mode="false"
    local cleanup_mode="false"
    local dry_run="false"
    
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
            --build)
                force_build="true"
                shift
                ;;
            --skip-build)
                skip_build="true"
                shift
                ;;
            --web)
                start_web="true"
                shift
                ;;
            --shell)
                shell_mode="true"
                shift
                ;;
            --cleanup)
                cleanup_mode="true"
                shift
                ;;
            --dry-run)
                dry_run="true"
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
    echo "SaaSus SDK for PHP - Docker E2Eテスト"
    echo "========================================"
    echo ""
    
    # クリーンアップモードの場合
    if [[ "$cleanup_mode" == "true" ]]; then
        cleanup_docker
        exit 0
    fi
    
    # シェルモードの場合
    if [[ "$shell_mode" == "true" ]]; then
        check_docker
        build_docker_image "$force_build"
        connect_shell
        exit 0
    fi
    
    # 環境確認
    check_environment
    check_docker
    
    # ビルドスキップが指定されていない場合のみビルドチェック
    if [[ "$skip_build" != "true" ]]; then
        build_docker_image "$force_build"
    else
        log_info "Dockerイメージのビルドチェックをスキップしました"
    fi
    
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
    
    # Webサーバー起動
    if [[ "$start_web" == "true" ]]; then
        start_web_server
    fi
    
    # 結果表示
    echo ""
    echo "========================================"
    if [[ $test_result -eq 0 ]]; then
        log_success "Docker E2Eテスト実行完了"
        if [[ "$coverage_flag" == "true" ]]; then
            log_info "カバレッジレポート: coverage-html-e2e/index.html"
        fi
        log_info "テスト結果: test-results/"
        if [[ "$start_web" == "true" ]]; then
            log_info "Webサーバー: http://localhost:8080"
        fi
    else
        log_error "Docker E2Eテスト実行失敗"
    fi
    echo "========================================"
    
    exit $test_result
}

# スクリプト実行
main "$@"
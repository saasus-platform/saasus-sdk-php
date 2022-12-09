# Auth
  詳細(引数、戻り値)はAPIドキュメントを[参照](https://docs.saasus.io/reference/getuserinfo)

## ユーザー情報
- GetUserInfo ・・・ユーザー情報取得

## 基本情報
- GetBasicInfo  ・・・基本設定情報の取得
- UpdateBasicInfo ・・・基本設定情報の更新

- FindNotificationMessages  ・・・通知メールテンプレートを取得
- UpdateNotificationMessages  ・・・通知メールテンプレートを更新

- GetCustomizePages ・・・認証系画面設定情報取得
- UpdateCustomizePages  ・・・認証系画面設定情報設定

- GetCustomizePageSettings  ・・・認証認可基本情報取得
- UpdateCustomizePageSettings ・・・認証認可基本情報更新

- GetEventBridgeSettings  ・・・イベント連携設定を取得
- SaveEventBridgeSettings ・・・イベント連携設定を更新
- DeleteEventBridgeSettings ・・・イベント連携設定を削除
- CreateEventBridgeTestEvent・・・イベント連携のテスト送信

## 認証情報
- GetAuthInfo ・・・認証情報を取得
- UpdateAuthInfo  ・・・認証情報を更
- GetSignInSettings ・・・パスワード要件を取得
- UpdateSignInSettings  ・・・パスワード要件を更新

## SaaSユーザー情報
- GetSaaSUsers  ・・・ユーザー一覧を取得

- GetSaaSUser ・・・ユーザー情報を取得
- CreateSaaSUser  ・・・SaaSにユーザーを作成
- DeleteSaaSUser  ・・・ユーザー情報を削除

- UpdateSaasUserPassword  ・・・パスワードを変更

- UpdateSaasUserEmail ・・・メールアドレスを変更

- CreateSecretCode  ・・・認証アプリケーション登録用のシークレットコードを作成
- UpdateSoftwareToken ・・・認証アプリケーションを登録

- GetUserMfaPreference  ・・・ユーザーのMFA設定を取得
- UpdateUserMfaPreference ・・・ユーザーのMFA設定を更新


### Tenant情報
- GetAllTenantUsers ・・・ユーザー一覧を取得
- GetAllTenantUser  ・・・ユーザー情報を取得

- GetTenantUsers  ・・・テナントのユーザー一覧を取得

- GetTenantUse  ・・・テナントのユーザー情報を取得
- CreateTenantUser  ・・・テナントにユーザーを作成

- UpdateTenantUser  ・・・テナントのユーザー属性情報を更新
- DeleteTenantUser  ・・・テナントのユーザー情報を削除

- CreateTenantUserRoles ・・・テナントのユーザー情報に役割(ロール)を作成
- DeleteTenantUserRole  ・・・テナントのユーザーから役割(ロール)を削除

## 役割(ロール)情報
- GetRoles  ・・・役割(ロール)一覧を取得
- CreateRole  ・・・役割(ロール)を作成
- DeleteRole  ・・・役割(ロール)を削除

## ユーザーの追加属性情報
- GetUserAttributes ・・・ユーザー属性の一覧を取得
- CreateUserAttribute ・・・ユーザー属性の作成
- DeleteUserAttribute ・・・ユーザー属性の削除

## Tenantの追加属性情報
- GetTenantAttributes ・・・テナント属性の一覧を取得
- CreateTenantAttribute ・・・テナント属性の作成
- DeleteTenantAttribute ・・・テナント属性の削除

## Tenant情報
- GetTenants  ・・・テナント一覧取得
- GetTenant ・・・テナントを作成
- CreateTenant  ・・・テナント情報を取得
- UpdateTenant  ・・・テナント情報を更新
- DeleteTenant  ・・・テナント情報を削除

## SaaSus情報
- GetApiKeys  ・・・APIキー一覧を取
- CreateApiKey  ・・・APIキーを作成
- DeleteApiKey  ・・・APIキーを削除
- GetSaasID ・・・SaasIDを取得
- UpdateSaasID  ・・・SaasIDを更新
- GetClientSecret ・・・クライアントシークレットを取得
- UpdateClientSecret  ・・・クライアントシークレットを更新

## 環境情報
- GetEnvs ・・・環境情報一覧を取得

- GetEnv ・・・環境情報の取得
- CreateEnv ・・・環境情報を作成
- UpdateEnv ・・・環境情報を更新
- DeleteEnv ・・・環境情報を削除

## 認証・認可情報
- GetAuthCredentials  ・・・認証・認可情報の取得
- CreateAuthCredentials ・・・認証・認可情報の保存


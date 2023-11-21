<?php

namespace AntiPatternInc\Saasus\Sdk\Auth;

class Client extends \AntiPatternInc\Saasus\Sdk\Auth\Runtime\Client\Client
{
    /**
    * SaaS利用ユーザ(登録ユーザ)のIDトークンを元に、ユーザ情報を取得します。
    IDトークンは、SaaSus Platform生成のログイン画面からログイン時にCallback URLに渡されます。
    サーバ側でそのURLからIDトークンを取得し、このAPIを呼ぶことにより、該当ユーザの情報が取得できます。
    取得した上には、所属テナントや役割(ロール)、料金プランなどが含まれているため、それを元に認可の実装を行うことが可能です。
    
    User information is obtained based on the ID token of the SaaS user (registered user).
    The ID token is passed to the Callback URL during login from the SaaSus Platform generated login screen.
    User information can be obtained from calling this API with an ID token from the URL on the server side.
    Since the acquired tenant, role (role), price plan, etc. are included, it is possible to implement authorization based on it.
    
    *
    * @param array $queryParameters {
    *     @var string $token IDトークン(ID Token)
    * }
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \AntiPatternInc\Saasus\Sdk\Auth\Exception\GetUserInfoUnauthorizedException
    * @throws \AntiPatternInc\Saasus\Sdk\Auth\Exception\GetUserInfoInternalServerErrorException
    *
    * @return null|\AntiPatternInc\Saasus\Sdk\Auth\Model\UserInfo|\Psr\Http\Message\ResponseInterface
    */
    public function getUserInfo(array $queryParameters = array(), string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \AntiPatternInc\Saasus\Sdk\Auth\Endpoint\GetUserInfo($queryParameters), $fetch);
    }
    /**
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \AntiPatternInc\Saasus\Sdk\Auth\Exception\GetBasicInfoInternalServerErrorException
     *
     * @return null|\AntiPatternInc\Saasus\Sdk\Auth\Model\BasicInfo|\Psr\Http\Message\ResponseInterface
     */
    public function getBasicInfo(string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \AntiPatternInc\Saasus\Sdk\Auth\Endpoint\GetBasicInfo(), $fetch);
    }
    /**
    * SaaS ID を元にパラメータとして設定したドメイン名を設定更新します。
    CNAME レコードが生成されますので、 DNS に設定して下さい。
    既に稼働中の SaaS アプリケーションに設定している場合には、動作に影響があります。
    
    Update the domain name that was set as a parameter based on the SaaS ID.
    After the CNAME record is generated, set it in your DNS.
    If it is set on a SaaS application that is already running, it will affect the behavior.
    
    *
    * @param null|\AntiPatternInc\Saasus\Sdk\Auth\Model\UpdateBasicInfoParam $requestBody 
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \AntiPatternInc\Saasus\Sdk\Auth\Exception\UpdateBasicInfoInternalServerErrorException
    *
    * @return null|\Psr\Http\Message\ResponseInterface
    */
    public function updateBasicInfo(?\AntiPatternInc\Saasus\Sdk\Auth\Model\UpdateBasicInfoParam $requestBody = null, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \AntiPatternInc\Saasus\Sdk\Auth\Endpoint\UpdateBasicInfo($requestBody), $fetch);
    }
    /**
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \AntiPatternInc\Saasus\Sdk\Auth\Exception\GetAuthInfoInternalServerErrorException
     *
     * @return null|\AntiPatternInc\Saasus\Sdk\Auth\Model\AuthInfo|\Psr\Http\Message\ResponseInterface
     */
    public function getAuthInfo(string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \AntiPatternInc\Saasus\Sdk\Auth\Endpoint\GetAuthInfo(), $fetch);
    }
    /**
    * ログイン後に認証情報を渡す SaaS の URL を登録します。
    ここで登録した URL に認証情報を渡し、SaaSus SDK を利用してこの Callback の実装をすることが可能となります。
    
    Register post-login SaaS URL for authentication information.
    It is possible to pass authentication information to the URL registered here and implement this Callback using the SaaSus SDK.
    
    *
    * @param null|\stdClass $requestBody 
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \AntiPatternInc\Saasus\Sdk\Auth\Exception\UpdateAuthInfoInternalServerErrorException
    *
    * @return null|\Psr\Http\Message\ResponseInterface
    */
    public function updateAuthInfo(?\stdClass $requestBody = null, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \AntiPatternInc\Saasus\Sdk\Auth\Endpoint\UpdateAuthInfo($requestBody), $fetch);
    }
    /**
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \AntiPatternInc\Saasus\Sdk\Auth\Exception\GetSaasUsersInternalServerErrorException
     *
     * @return null|\AntiPatternInc\Saasus\Sdk\Auth\Model\SaasUsers|\Psr\Http\Message\ResponseInterface
     */
    public function getSaasUsers(string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \AntiPatternInc\Saasus\Sdk\Auth\Endpoint\GetSaasUsers(), $fetch);
    }
    /**
    * SaaSにユーザーを作成します。
    
    Create SaaS User.
    
    *
    * @param null|\AntiPatternInc\Saasus\Sdk\Auth\Model\CreateSaasUserParam $requestBody 
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \AntiPatternInc\Saasus\Sdk\Auth\Exception\CreateSaasUserBadRequestException
    * @throws \AntiPatternInc\Saasus\Sdk\Auth\Exception\CreateSaasUserInternalServerErrorException
    *
    * @return null|\AntiPatternInc\Saasus\Sdk\Auth\Model\SaasUser|\Psr\Http\Message\ResponseInterface
    */
    public function createSaasUser(?\AntiPatternInc\Saasus\Sdk\Auth\Model\CreateSaasUserParam $requestBody = null, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \AntiPatternInc\Saasus\Sdk\Auth\Endpoint\CreateSaasUser($requestBody), $fetch);
    }
    /**
    * ユーザーIDを元に一致するユーザーをテナントからすべて削除し、SaaSからも削除します。
    
    Delete all users with matching user ID from the tenant and SaaS.
    
    *
    * @param string $userId ユーザーID(User ID)
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \AntiPatternInc\Saasus\Sdk\Auth\Exception\DeleteSaasUserNotFoundException
    * @throws \AntiPatternInc\Saasus\Sdk\Auth\Exception\DeleteSaasUserInternalServerErrorException
    *
    * @return null|\Psr\Http\Message\ResponseInterface
    */
    public function deleteSaasUser(string $userId, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \AntiPatternInc\Saasus\Sdk\Auth\Endpoint\DeleteSaasUser($userId), $fetch);
    }
    /**
    * ユーザーIDからユーザー情報を取得します。
    
    Get user information based on user ID.
    
    *
    * @param string $userId ユーザーID(User ID)
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \AntiPatternInc\Saasus\Sdk\Auth\Exception\GetSaasUserNotFoundException
    * @throws \AntiPatternInc\Saasus\Sdk\Auth\Exception\GetSaasUserInternalServerErrorException
    *
    * @return null|\AntiPatternInc\Saasus\Sdk\Auth\Model\SaasUser|\Psr\Http\Message\ResponseInterface
    */
    public function getSaasUser(string $userId, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \AntiPatternInc\Saasus\Sdk\Auth\Endpoint\GetSaasUser($userId), $fetch);
    }
    /**
    * ユーザーのログインパスワードを変更します。
    
    Change user's login password.
    
    *
    * @param string $userId ユーザーID(User ID)
    * @param null|\AntiPatternInc\Saasus\Sdk\Auth\Model\UpdateSaasUserPasswordParam $requestBody 
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \AntiPatternInc\Saasus\Sdk\Auth\Exception\UpdateSaasUserPasswordInternalServerErrorException
    *
    * @return null|\Psr\Http\Message\ResponseInterface
    */
    public function updateSaasUserPassword(string $userId, ?\AntiPatternInc\Saasus\Sdk\Auth\Model\UpdateSaasUserPasswordParam $requestBody = null, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \AntiPatternInc\Saasus\Sdk\Auth\Endpoint\UpdateSaasUserPassword($userId, $requestBody), $fetch);
    }
    /**
    * ユーザーのメールアドレスを変更します。
    
    Change user's email.
    
    *
    * @param string $userId ユーザーID(User ID)
    * @param null|\AntiPatternInc\Saasus\Sdk\Auth\Model\UpdateSaasUserEmailParam $requestBody 
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \AntiPatternInc\Saasus\Sdk\Auth\Exception\UpdateSaasUserEmailInternalServerErrorException
    *
    * @return null|\Psr\Http\Message\ResponseInterface
    */
    public function updateSaasUserEmail(string $userId, ?\AntiPatternInc\Saasus\Sdk\Auth\Model\UpdateSaasUserEmailParam $requestBody = null, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \AntiPatternInc\Saasus\Sdk\Auth\Endpoint\UpdateSaasUserEmail($userId, $requestBody), $fetch);
    }
    /**
    * ユーザーのメールアドレス変更を要求します。
    要求されたメールアドレスに対して検証コードを送信します。
    ユーザーのアクセストークンが必要です。
    検証コードの有効期限は24時間です。
    
    Request to update the user's email address.
    Sends a verification code to the requested email address.
    Requires the user's access token.
    The verification code is valid for 24 hours.
    
    *
    * @param string $userId ユーザーID(User ID)
    * @param null|\AntiPatternInc\Saasus\Sdk\Auth\Model\RequestEmailUpdateParam $requestBody 
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \AntiPatternInc\Saasus\Sdk\Auth\Exception\RequestEmailUpdateInternalServerErrorException
    *
    * @return null|\Psr\Http\Message\ResponseInterface
    */
    public function requestEmailUpdate(string $userId, ?\AntiPatternInc\Saasus\Sdk\Auth\Model\RequestEmailUpdateParam $requestBody = null, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \AntiPatternInc\Saasus\Sdk\Auth\Endpoint\RequestEmailUpdate($userId, $requestBody), $fetch);
    }
    /**
    * ユーザーのメールアドレス変更確認のためにコードを検証します。
    ユーザーのアクセストークンが必要です。
    
    Verify the code to confirm the user's email address update.
    Requires the user's access token.
    
    *
    * @param string $userId ユーザーID(User ID)
    * @param null|\AntiPatternInc\Saasus\Sdk\Auth\Model\ConfirmEmailUpdateParam $requestBody 
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \AntiPatternInc\Saasus\Sdk\Auth\Exception\ConfirmEmailUpdateInternalServerErrorException
    *
    * @return null|\Psr\Http\Message\ResponseInterface
    */
    public function confirmEmailUpdate(string $userId, ?\AntiPatternInc\Saasus\Sdk\Auth\Model\ConfirmEmailUpdateParam $requestBody = null, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \AntiPatternInc\Saasus\Sdk\Auth\Endpoint\ConfirmEmailUpdate($userId, $requestBody), $fetch);
    }
    /**
    * 認証アプリケーションを登録します。
    
    Register an authentication application.
    
    *
    * @param string $userId ユーザーID(User ID)
    * @param null|\AntiPatternInc\Saasus\Sdk\Auth\Model\UpdateSoftwareTokenParam $requestBody 
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \AntiPatternInc\Saasus\Sdk\Auth\Exception\UpdateSoftwareTokenInternalServerErrorException
    *
    * @return null|\Psr\Http\Message\ResponseInterface
    */
    public function updateSoftwareToken(string $userId, ?\AntiPatternInc\Saasus\Sdk\Auth\Model\UpdateSoftwareTokenParam $requestBody = null, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \AntiPatternInc\Saasus\Sdk\Auth\Endpoint\UpdateSoftwareToken($userId, $requestBody), $fetch);
    }
    /**
    * 認証アプリケーション登録用のシークレットコードを作成します。
    
    Create a secret code for authentication application registration.
    
    *
    * @param string $userId ユーザーID(User ID)
    * @param null|\AntiPatternInc\Saasus\Sdk\Auth\Model\CreateSecretCodeParam $requestBody 
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \AntiPatternInc\Saasus\Sdk\Auth\Exception\CreateSecretCodeInternalServerErrorException
    *
    * @return null|\AntiPatternInc\Saasus\Sdk\Auth\Model\SoftwareTokenSecretCode|\Psr\Http\Message\ResponseInterface
    */
    public function createSecretCode(string $userId, ?\AntiPatternInc\Saasus\Sdk\Auth\Model\CreateSecretCodeParam $requestBody = null, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \AntiPatternInc\Saasus\Sdk\Auth\Endpoint\CreateSecretCode($userId, $requestBody), $fetch);
    }
    /**
    * ユーザーのMFA設定を取得します。
    
    Get the user's MFA settings.
    
    *
    * @param string $userId ユーザーID(User ID)
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \AntiPatternInc\Saasus\Sdk\Auth\Exception\GetUserMfaPreferenceInternalServerErrorException
    *
    * @return null|\AntiPatternInc\Saasus\Sdk\Auth\Model\MfaPreference|\Psr\Http\Message\ResponseInterface
    */
    public function getUserMfaPreference(string $userId, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \AntiPatternInc\Saasus\Sdk\Auth\Endpoint\GetUserMfaPreference($userId), $fetch);
    }
    /**
    * ユーザーのMFA設定を更新します。
    
    Update user's MFA settings.
    
    *
    * @param string $userId ユーザーID(User ID)
    * @param null|\stdClass $requestBody 
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \AntiPatternInc\Saasus\Sdk\Auth\Exception\UpdateUserMfaPreferenceInternalServerErrorException
    *
    * @return null|\Psr\Http\Message\ResponseInterface
    */
    public function updateUserMfaPreference(string $userId, ?\stdClass $requestBody = null, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \AntiPatternInc\Saasus\Sdk\Auth\Endpoint\UpdateUserMfaPreference($userId, $requestBody), $fetch);
    }
    /**
    * 外部IDプロバイダの連携を解除します。
    
    Unlink external identity providers.
    
    *
    * @param string $providerName 
    * @param string $userId ユーザーID(User ID)
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \AntiPatternInc\Saasus\Sdk\Auth\Exception\UnlinkProviderInternalServerErrorException
    *
    * @return null|\Psr\Http\Message\ResponseInterface
    */
    public function unlinkProvider(string $providerName, string $userId, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \AntiPatternInc\Saasus\Sdk\Auth\Endpoint\UnlinkProvider($providerName, $userId), $fetch);
    }
    /**
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \AntiPatternInc\Saasus\Sdk\Auth\Exception\GetAllTenantUsersInternalServerErrorException
     *
     * @return null|\AntiPatternInc\Saasus\Sdk\Auth\Model\Users|\Psr\Http\Message\ResponseInterface
     */
    public function getAllTenantUsers(string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \AntiPatternInc\Saasus\Sdk\Auth\Endpoint\GetAllTenantUsers(), $fetch);
    }
    /**
    * ユーザーIDからテナントに所属しているユーザー情報を取得します。
    複数テナントに所属している場合は別のオブジェクトとして返却されます。
    
    Get information on user belonging to the tenant from the user ID.
    If the user belongs to multiple tenants, it will be returned as another object.
    
    *
    * @param string $userId ユーザーID(User ID)
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \AntiPatternInc\Saasus\Sdk\Auth\Exception\GetAllTenantUserNotFoundException
    * @throws \AntiPatternInc\Saasus\Sdk\Auth\Exception\GetAllTenantUserInternalServerErrorException
    *
    * @return null|\AntiPatternInc\Saasus\Sdk\Auth\Model\Users|\Psr\Http\Message\ResponseInterface
    */
    public function getAllTenantUser(string $userId, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \AntiPatternInc\Saasus\Sdk\Auth\Endpoint\GetAllTenantUser($userId), $fetch);
    }
    /**
    * テナントに所属するユーザーを全件取得します。 idは一意です。
    
    Get all the users belonging to the tenant.
    Id is unique.
    
    *
    * @param string $tenantId テナントID(Tenant ID)
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \AntiPatternInc\Saasus\Sdk\Auth\Exception\GetTenantUsersInternalServerErrorException
    *
    * @return null|\AntiPatternInc\Saasus\Sdk\Auth\Model\Users|\Psr\Http\Message\ResponseInterface
    */
    public function getTenantUsers(string $tenantId, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \AntiPatternInc\Saasus\Sdk\Auth\Endpoint\GetTenantUsers($tenantId), $fetch);
    }
    /**
    * テナントにユーザーを作成します。
    attributesを空のオブジェクトにした場合、追加属性は空で作成されます。
    
    Create a tenant user.
    If attributes is empty, the additional attributes will be created empty.
    
    *
    * @param string $tenantId テナントID(Tenant ID)
    * @param null|\AntiPatternInc\Saasus\Sdk\Auth\Model\CreateTenantUserParam $requestBody 
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \AntiPatternInc\Saasus\Sdk\Auth\Exception\CreateTenantUserInternalServerErrorException
    *
    * @return null|\AntiPatternInc\Saasus\Sdk\Auth\Model\User|\Psr\Http\Message\ResponseInterface
    */
    public function createTenantUser(string $tenantId, ?\AntiPatternInc\Saasus\Sdk\Auth\Model\CreateTenantUserParam $requestBody = null, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \AntiPatternInc\Saasus\Sdk\Auth\Endpoint\CreateTenantUser($tenantId, $requestBody), $fetch);
    }
    /**
    * テナントからユーザーを削除します。
    
    Delete a user from your tenant.
    
    *
    * @param string $tenantId テナントID(Tenant ID)
    * @param string $userId ユーザーID(User ID)
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \AntiPatternInc\Saasus\Sdk\Auth\Exception\DeleteTenantUserNotFoundException
    * @throws \AntiPatternInc\Saasus\Sdk\Auth\Exception\DeleteTenantUserInternalServerErrorException
    *
    * @return null|\Psr\Http\Message\ResponseInterface
    */
    public function deleteTenantUser(string $tenantId, string $userId, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \AntiPatternInc\Saasus\Sdk\Auth\Endpoint\DeleteTenantUser($tenantId, $userId), $fetch);
    }
    /**
    * テナントのユーザーをIDから一件取得します。
    
    Get one tenant user by specific ID.
    
    *
    * @param string $tenantId テナントID(Tenant ID)
    * @param string $userId ユーザーID(User ID)
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \AntiPatternInc\Saasus\Sdk\Auth\Exception\GetTenantUserNotFoundException
    * @throws \AntiPatternInc\Saasus\Sdk\Auth\Exception\GetTenantUserInternalServerErrorException
    *
    * @return null|\AntiPatternInc\Saasus\Sdk\Auth\Model\User|\Psr\Http\Message\ResponseInterface
    */
    public function getTenantUser(string $tenantId, string $userId, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \AntiPatternInc\Saasus\Sdk\Auth\Endpoint\GetTenantUser($tenantId, $userId), $fetch);
    }
    /**
    * テナントのユーザー属性情報を更新します。
    
    Update tenant user attributes.
    
    *
    * @param string $tenantId テナントID(Tenant ID)
    * @param string $userId ユーザーID(User ID)
    * @param null|\AntiPatternInc\Saasus\Sdk\Auth\Model\UpdateTenantUserParam $requestBody 
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \AntiPatternInc\Saasus\Sdk\Auth\Exception\UpdateTenantUserNotFoundException
    * @throws \AntiPatternInc\Saasus\Sdk\Auth\Exception\UpdateTenantUserInternalServerErrorException
    *
    * @return null|\Psr\Http\Message\ResponseInterface
    */
    public function updateTenantUser(string $tenantId, string $userId, ?\AntiPatternInc\Saasus\Sdk\Auth\Model\UpdateTenantUserParam $requestBody = null, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \AntiPatternInc\Saasus\Sdk\Auth\Endpoint\UpdateTenantUser($tenantId, $userId, $requestBody), $fetch);
    }
    /**
    * テナントのユーザーに役割(ロール)を作成します。
    
    Create roles on tenant users.
    
    *
    * @param string $tenantId テナントID(Tenant ID)
    * @param string $userId ユーザーID(User ID)
    * @param int $envId 環境ID(Env ID)
    * @param null|\AntiPatternInc\Saasus\Sdk\Auth\Model\CreateTenantUserRolesParam $requestBody 
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \AntiPatternInc\Saasus\Sdk\Auth\Exception\CreateTenantUserRolesInternalServerErrorException
    *
    * @return null|\Psr\Http\Message\ResponseInterface
    */
    public function createTenantUserRoles(string $tenantId, string $userId, int $envId, ?\AntiPatternInc\Saasus\Sdk\Auth\Model\CreateTenantUserRolesParam $requestBody = null, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \AntiPatternInc\Saasus\Sdk\Auth\Endpoint\CreateTenantUserRoles($tenantId, $userId, $envId, $requestBody), $fetch);
    }
    /**
    * テナントのユーザーから役割(ロール)を削除します。
    
    Remove a role from a tenant user.
    
    *
    * @param string $tenantId テナントID(Tenant ID)
    * @param string $userId ユーザーID(User ID)
    * @param int $envId 環境ID(Env ID)
    * @param string $roleName 役割(ロール)名(role name)
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \AntiPatternInc\Saasus\Sdk\Auth\Exception\DeleteTenantUserRoleNotFoundException
    * @throws \AntiPatternInc\Saasus\Sdk\Auth\Exception\DeleteTenantUserRoleInternalServerErrorException
    *
    * @return null|\Psr\Http\Message\ResponseInterface
    */
    public function deleteTenantUserRole(string $tenantId, string $userId, int $envId, string $roleName, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \AntiPatternInc\Saasus\Sdk\Auth\Endpoint\DeleteTenantUserRole($tenantId, $userId, $envId, $roleName), $fetch);
    }
    /**
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \AntiPatternInc\Saasus\Sdk\Auth\Exception\GetRolesInternalServerErrorException
     *
     * @return null|\AntiPatternInc\Saasus\Sdk\Auth\Model\Roles|\Psr\Http\Message\ResponseInterface
     */
    public function getRoles(string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \AntiPatternInc\Saasus\Sdk\Auth\Endpoint\GetRoles(), $fetch);
    }
    /**
    * 役割(ロール)を作成します。
    ここで作成した役割をユーザーに付与することによって、SaaS側で役割ベースの認可を実装することが用意になります。
    また、同じユーザーでも、属するテナント・環境ごとに持っている役割を変えることが可能です。
    
    Create a role.
    By granting users the roles created here, it becomes easier to implement role-based authorization on the SaaS side.
    In addition, even the same user can have different roles for each tenant/environment to which they belong.
    
    *
    * @param null|\stdClass $requestBody 
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \AntiPatternInc\Saasus\Sdk\Auth\Exception\CreateRoleInternalServerErrorException
    *
    * @return null|\AntiPatternInc\Saasus\Sdk\Auth\Model\Role|\Psr\Http\Message\ResponseInterface
    */
    public function createRole(?\stdClass $requestBody = null, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \AntiPatternInc\Saasus\Sdk\Auth\Endpoint\CreateRole($requestBody), $fetch);
    }
    /**
    * 役割(ロール)を削除します。
    
    Delete role.
    
    *
    * @param string $roleName 役割(ロール)名(role name)
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \AntiPatternInc\Saasus\Sdk\Auth\Exception\DeleteRoleBadRequestException
    * @throws \AntiPatternInc\Saasus\Sdk\Auth\Exception\DeleteRoleNotFoundException
    * @throws \AntiPatternInc\Saasus\Sdk\Auth\Exception\DeleteRoleInternalServerErrorException
    *
    * @return null|\Psr\Http\Message\ResponseInterface
    */
    public function deleteRole(string $roleName, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \AntiPatternInc\Saasus\Sdk\Auth\Endpoint\DeleteRole($roleName), $fetch);
    }
    /**
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \AntiPatternInc\Saasus\Sdk\Auth\Exception\GetUserAttributesInternalServerErrorException
     *
     * @return null|\AntiPatternInc\Saasus\Sdk\Auth\Model\UserAttributes|\Psr\Http\Message\ResponseInterface
     */
    public function getUserAttributes(string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \AntiPatternInc\Saasus\Sdk\Auth\Endpoint\GetUserAttributes(), $fetch);
    }
    /**
    * SaaSus Platform にて保持するユーザーの追加属性を登録します。
    例えば、ユーザー名を持たせる、誕生日を持たせるなど、ユーザーに紐付いた項目の定義を行うことができます。
    一方で、個人情報を SaaSus Platform 側に持たせたくない場合は、このユーザー属性定義を行わずに SaaS 側で個人情報を持つことを検討してください。
    
    Create additional user attributes to be kept on the SaaSus Platform.
    For example, you can define items associated with a user, such as user name, birthday, etc.
    If you don't want personal information on the SaaS Platform side, personal information can be kept on the SaaS side without user attribute definition.
    
    *
    * @param null|\stdClass $requestBody 
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \AntiPatternInc\Saasus\Sdk\Auth\Exception\CreateUserAttributeInternalServerErrorException
    *
    * @return null|\AntiPatternInc\Saasus\Sdk\Auth\Model\Attribute|\Psr\Http\Message\ResponseInterface
    */
    public function createUserAttribute(?\stdClass $requestBody = null, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \AntiPatternInc\Saasus\Sdk\Auth\Endpoint\CreateUserAttribute($requestBody), $fetch);
    }
    /**
    * SaaSus Platform にて保持するユーザーの追加属性を削除します。
    
    Delete user attributes kept on the SaaSus Platform.
    
    *
    * @param string $attributeName 属性名(Attribute Name)
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \AntiPatternInc\Saasus\Sdk\Auth\Exception\DeleteUserAttributeNotFoundException
    * @throws \AntiPatternInc\Saasus\Sdk\Auth\Exception\DeleteUserAttributeInternalServerErrorException
    *
    * @return null|\Psr\Http\Message\ResponseInterface
    */
    public function deleteUserAttribute(string $attributeName, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \AntiPatternInc\Saasus\Sdk\Auth\Endpoint\DeleteUserAttribute($attributeName), $fetch);
    }
    /**
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \AntiPatternInc\Saasus\Sdk\Auth\Exception\GetTenantAttributesInternalServerErrorException
     *
     * @return null|\AntiPatternInc\Saasus\Sdk\Auth\Model\TenantAttributes|\Psr\Http\Message\ResponseInterface
     */
    public function getTenantAttributes(string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \AntiPatternInc\Saasus\Sdk\Auth\Endpoint\GetTenantAttributes(), $fetch);
    }
    /**
    * SaaSus Platform で管理する、テナントの追加属性の登録を行います。
    例えばテナントの呼び名やメモなどをを持たせることができ、SaaSからSaaSus SDK/APIを利用して取得することができます。
    
    Register additional tenant attributes to be managed by SaaSus Platform.
    For example, tenant name, memo, etc., then get the attributes from SaaS using the SaaSus SDK/API.
    
    *
    * @param null|\stdClass $requestBody 
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \AntiPatternInc\Saasus\Sdk\Auth\Exception\CreateTenantAttributeInternalServerErrorException
    *
    * @return null|\AntiPatternInc\Saasus\Sdk\Auth\Model\Attribute|\Psr\Http\Message\ResponseInterface
    */
    public function createTenantAttribute(?\stdClass $requestBody = null, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \AntiPatternInc\Saasus\Sdk\Auth\Endpoint\CreateTenantAttribute($requestBody), $fetch);
    }
    /**
    * SaaSus Platform で管理する、テナントの追加属性の削除を行います。
    
    Deletes tenant attributes managed by SaaSus Platform.
    
    *
    * @param string $attributeName 属性名(Attribute Name)
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \AntiPatternInc\Saasus\Sdk\Auth\Exception\DeleteTenantAttributeNotFoundException
    * @throws \AntiPatternInc\Saasus\Sdk\Auth\Exception\DeleteTenantAttributeInternalServerErrorException
    *
    * @return null|\Psr\Http\Message\ResponseInterface
    */
    public function deleteTenantAttribute(string $attributeName, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \AntiPatternInc\Saasus\Sdk\Auth\Endpoint\DeleteTenantAttribute($attributeName), $fetch);
    }
    /**
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \AntiPatternInc\Saasus\Sdk\Auth\Exception\GetTenantsInternalServerErrorException
     *
     * @return null|\AntiPatternInc\Saasus\Sdk\Auth\Model\Tenants|\Psr\Http\Message\ResponseInterface
     */
    public function getTenants(string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \AntiPatternInc\Saasus\Sdk\Auth\Endpoint\GetTenants(), $fetch);
    }
    /**
    * SaaSus Platform で管理する、テナント情報を作成します。
    
    Create a tenant managed by the SaaSus Platform.
    
    *
    * @param null|\stdClass $requestBody 
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \AntiPatternInc\Saasus\Sdk\Auth\Exception\CreateTenantInternalServerErrorException
    *
    * @return null|\AntiPatternInc\Saasus\Sdk\Auth\Model\Tenant|\Psr\Http\Message\ResponseInterface
    */
    public function createTenant(?\stdClass $requestBody = null, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \AntiPatternInc\Saasus\Sdk\Auth\Endpoint\CreateTenant($requestBody), $fetch);
    }
    /**
    * SaaSus Platform で管理する、テナントの詳細情報を削除します。
    
    Delete SaaSus Platform tenant.
    
    *
    * @param string $tenantId テナントID(Tenant ID)
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \AntiPatternInc\Saasus\Sdk\Auth\Exception\DeleteTenantInternalServerErrorException
    *
    * @return null|\Psr\Http\Message\ResponseInterface
    */
    public function deleteTenant(string $tenantId, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \AntiPatternInc\Saasus\Sdk\Auth\Endpoint\DeleteTenant($tenantId), $fetch);
    }
    /**
    * SaaSus Platform で管理する、テナントの詳細情報を取得します。
    
    Get the details of tenant managed on the SaaSus Platform.
    
    *
    * @param string $tenantId テナントID(Tenant ID)
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \AntiPatternInc\Saasus\Sdk\Auth\Exception\GetTenantNotFoundException
    * @throws \AntiPatternInc\Saasus\Sdk\Auth\Exception\GetTenantInternalServerErrorException
    *
    * @return null|\AntiPatternInc\Saasus\Sdk\Auth\Model\TenantDetail|\Psr\Http\Message\ResponseInterface
    */
    public function getTenant(string $tenantId, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \AntiPatternInc\Saasus\Sdk\Auth\Endpoint\GetTenant($tenantId), $fetch);
    }
    /**
    * SaaSus Platform で管理する、テナントの詳細情報を更新します。
    
    Update SaaSus Platform tenant details.
    
    *
    * @param string $tenantId テナントID(Tenant ID)
    * @param null|\stdClass $requestBody 
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \AntiPatternInc\Saasus\Sdk\Auth\Exception\UpdateTenantNotFoundException
    * @throws \AntiPatternInc\Saasus\Sdk\Auth\Exception\UpdateTenantInternalServerErrorException
    *
    * @return null|\Psr\Http\Message\ResponseInterface
    */
    public function updateTenant(string $tenantId, ?\stdClass $requestBody = null, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \AntiPatternInc\Saasus\Sdk\Auth\Endpoint\UpdateTenant($tenantId, $requestBody), $fetch);
    }
    /**
    * SaaSus Platform で管理しているテナントのプラン情報を更新します。
    
    Update SaaSus Platform tenant plan information.
    
    *
    * @param string $tenantId テナントID(Tenant ID)
    * @param null|\stdClass $requestBody 
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \AntiPatternInc\Saasus\Sdk\Auth\Exception\UpdateTenantPlanBadRequestException
    * @throws \AntiPatternInc\Saasus\Sdk\Auth\Exception\UpdateTenantPlanNotFoundException
    * @throws \AntiPatternInc\Saasus\Sdk\Auth\Exception\UpdateTenantPlanInternalServerErrorException
    *
    * @return null|\Psr\Http\Message\ResponseInterface
    */
    public function updateTenantPlan(string $tenantId, ?\stdClass $requestBody = null, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \AntiPatternInc\Saasus\Sdk\Auth\Endpoint\UpdateTenantPlan($tenantId, $requestBody), $fetch);
    }
    /**
    * SaaSus Platform で管理しているテナントの請求先情報を更新します。
    
    Update SaaSus Platform tenant billing information.
    
    *
    * @param string $tenantId テナントID(Tenant ID)
    * @param null|\stdClass $requestBody 
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \AntiPatternInc\Saasus\Sdk\Auth\Exception\UpdateTenantBillingInfoBadRequestException
    * @throws \AntiPatternInc\Saasus\Sdk\Auth\Exception\UpdateTenantBillingInfoNotFoundException
    * @throws \AntiPatternInc\Saasus\Sdk\Auth\Exception\UpdateTenantBillingInfoInternalServerErrorException
    *
    * @return null|\Psr\Http\Message\ResponseInterface
    */
    public function updateTenantBillingInfo(string $tenantId, ?\stdClass $requestBody = null, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \AntiPatternInc\Saasus\Sdk\Auth\Endpoint\UpdateTenantBillingInfo($tenantId, $requestBody), $fetch);
    }
    /**
    * テナントへの招待一覧を取得します。
    
    Get a list of invitations to the tenant.
    
    *
    * @param string $tenantId テナントID(Tenant ID)
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \AntiPatternInc\Saasus\Sdk\Auth\Exception\GetTenantInvitationsInternalServerErrorException
    *
    * @return null|\AntiPatternInc\Saasus\Sdk\Auth\Model\Invitations|\Psr\Http\Message\ResponseInterface
    */
    public function getTenantInvitations(string $tenantId, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \AntiPatternInc\Saasus\Sdk\Auth\Endpoint\GetTenantInvitations($tenantId), $fetch);
    }
    /**
    * テナントへの招待を作成します。
    
    Create an invitation to the tenant.
    
    *
    * @param string $tenantId テナントID(Tenant ID)
    * @param null|\AntiPatternInc\Saasus\Sdk\Auth\Model\CreateTenantInvitationParam $requestBody 
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \AntiPatternInc\Saasus\Sdk\Auth\Exception\CreateTenantInvitationBadRequestException
    * @throws \AntiPatternInc\Saasus\Sdk\Auth\Exception\CreateTenantInvitationInternalServerErrorException
    *
    * @return null|\AntiPatternInc\Saasus\Sdk\Auth\Model\Invitation|\Psr\Http\Message\ResponseInterface
    */
    public function createTenantInvitation(string $tenantId, ?\AntiPatternInc\Saasus\Sdk\Auth\Model\CreateTenantInvitationParam $requestBody = null, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \AntiPatternInc\Saasus\Sdk\Auth\Endpoint\CreateTenantInvitation($tenantId, $requestBody), $fetch);
    }
    /**
    * テナントへの招待を削除します。
    
    Delete an invitation to the tenant.
    
    *
    * @param string $tenantId テナントID(Tenant ID)
    * @param string $invitationId 招待ID(Invitation ID)
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \AntiPatternInc\Saasus\Sdk\Auth\Exception\DeleteTenantInvitationNotFoundException
    * @throws \AntiPatternInc\Saasus\Sdk\Auth\Exception\DeleteTenantInvitationInternalServerErrorException
    *
    * @return null|\Psr\Http\Message\ResponseInterface
    */
    public function deleteTenantInvitation(string $tenantId, string $invitationId, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \AntiPatternInc\Saasus\Sdk\Auth\Endpoint\DeleteTenantInvitation($tenantId, $invitationId), $fetch);
    }
    /**
    * テナントへの招待情報を取得します。
    
    Get invitation information to the tenant.
    
    *
    * @param string $tenantId テナントID(Tenant ID)
    * @param string $invitationId 招待ID(Invitation ID)
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \AntiPatternInc\Saasus\Sdk\Auth\Exception\GetTenantInvitationNotFoundException
    * @throws \AntiPatternInc\Saasus\Sdk\Auth\Exception\GetTenantInvitationInternalServerErrorException
    *
    * @return null|\AntiPatternInc\Saasus\Sdk\Auth\Model\Invitation|\Psr\Http\Message\ResponseInterface
    */
    public function getTenantInvitation(string $tenantId, string $invitationId, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \AntiPatternInc\Saasus\Sdk\Auth\Endpoint\GetTenantInvitation($tenantId, $invitationId), $fetch);
    }
    /**
    * テナントへの招待の有効性を取得します。
    
    Get the validity of an invitation to the tenant.
    
    *
    * @param string $invitationId 招待ID(Invitation ID)
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \AntiPatternInc\Saasus\Sdk\Auth\Exception\GetInvitationValidityNotFoundException
    * @throws \AntiPatternInc\Saasus\Sdk\Auth\Exception\GetInvitationValidityInternalServerErrorException
    *
    * @return null|\AntiPatternInc\Saasus\Sdk\Auth\Model\InvitationValidity|\Psr\Http\Message\ResponseInterface
    */
    public function getInvitationValidity(string $invitationId, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \AntiPatternInc\Saasus\Sdk\Auth\Endpoint\GetInvitationValidity($invitationId), $fetch);
    }
    /**
    * テナントへの招待を検証します。
    
    Validate an invitation to the tenant.
    
    *
    * @param string $invitationId 招待ID(Invitation ID)
    * @param null|\AntiPatternInc\Saasus\Sdk\Auth\Model\ValidateInvitationParam $requestBody 
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \AntiPatternInc\Saasus\Sdk\Auth\Exception\ValidateInvitationBadRequestException
    * @throws \AntiPatternInc\Saasus\Sdk\Auth\Exception\ValidateInvitationNotFoundException
    * @throws \AntiPatternInc\Saasus\Sdk\Auth\Exception\ValidateInvitationInternalServerErrorException
    *
    * @return null|\Psr\Http\Message\ResponseInterface
    */
    public function validateInvitation(string $invitationId, ?\AntiPatternInc\Saasus\Sdk\Auth\Model\ValidateInvitationParam $requestBody = null, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \AntiPatternInc\Saasus\Sdk\Auth\Endpoint\ValidateInvitation($invitationId, $requestBody), $fetch);
    }
    /**
    * テナント毎の外部IDプロバイダ経由のサインイン情報を取得します。
    
    Get sign-in information via external identity provider per tenant.
    
    *
    * @param string $tenantId テナントID(Tenant ID)
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \AntiPatternInc\Saasus\Sdk\Auth\Exception\GetTenantIdentityProvidersInternalServerErrorException
    *
    * @return null|\AntiPatternInc\Saasus\Sdk\Auth\Model\TenantIdentityProviders|\Psr\Http\Message\ResponseInterface
    */
    public function getTenantIdentityProviders(string $tenantId, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \AntiPatternInc\Saasus\Sdk\Auth\Endpoint\GetTenantIdentityProviders($tenantId), $fetch);
    }
    /**
    * テナント毎の外部IDプロバイダ経由のサインイン情報を更新します。
    
    Update sign-in information via external identity provider per tenant.
    
    *
    * @param string $tenantId テナントID(Tenant ID)
    * @param null|\AntiPatternInc\Saasus\Sdk\Auth\Model\UpdateTenantIdentityProviderParam $requestBody 
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \AntiPatternInc\Saasus\Sdk\Auth\Exception\UpdateTenantIdentityProviderInternalServerErrorException
    *
    * @return null|\Psr\Http\Message\ResponseInterface
    */
    public function updateTenantIdentityProvider(string $tenantId, ?\AntiPatternInc\Saasus\Sdk\Auth\Model\UpdateTenantIdentityProviderParam $requestBody = null, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \AntiPatternInc\Saasus\Sdk\Auth\Endpoint\UpdateTenantIdentityProvider($tenantId, $requestBody), $fetch);
    }
    /**
    * 外部アカウントのユーザー連携を要求します。
    アクセストークンから連携するユーザーのメールアドレスを取得し、そのメールアドレスに対して検証コードを送信します。
    検証コードの有効期限は24時間です。
    
    Request to link an external account user.
    Get the email address of the user to be linked from the access token and send a verification code to that email address.
    The verification code is valid for 24 hours.
    
    *
    * @param null|\AntiPatternInc\Saasus\Sdk\Auth\Model\RequestExternalUserLinkParam $requestBody 
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \AntiPatternInc\Saasus\Sdk\Auth\Exception\RequestExternalUserLinkBadRequestException
    * @throws \AntiPatternInc\Saasus\Sdk\Auth\Exception\RequestExternalUserLinkInternalServerErrorException
    *
    * @return null|\Psr\Http\Message\ResponseInterface
    */
    public function requestExternalUserLink(?\AntiPatternInc\Saasus\Sdk\Auth\Model\RequestExternalUserLinkParam $requestBody = null, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \AntiPatternInc\Saasus\Sdk\Auth\Endpoint\RequestExternalUserLink($requestBody), $fetch);
    }
    /**
    * 外部アカウントのユーザー連携確認のためにコードを検証します。
    
    Verify the code for external account user link confirmation.
    
    *
    * @param null|\AntiPatternInc\Saasus\Sdk\Auth\Model\ConfirmExternalUserLinkParam $requestBody 
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \AntiPatternInc\Saasus\Sdk\Auth\Exception\ConfirmExternalUserLinkBadRequestException
    * @throws \AntiPatternInc\Saasus\Sdk\Auth\Exception\ConfirmExternalUserLinkInternalServerErrorException
    *
    * @return null|\Psr\Http\Message\ResponseInterface
    */
    public function confirmExternalUserLink(?\AntiPatternInc\Saasus\Sdk\Auth\Model\ConfirmExternalUserLinkParam $requestBody = null, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \AntiPatternInc\Saasus\Sdk\Auth\Endpoint\ConfirmExternalUserLink($requestBody), $fetch);
    }
    /**
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \AntiPatternInc\Saasus\Sdk\Auth\Exception\GetApiKeysInternalServerErrorException
     *
     * @return null|\AntiPatternInc\Saasus\Sdk\Auth\Model\ApiKeys|\Psr\Http\Message\ResponseInterface
     */
    public function getApiKeys(string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \AntiPatternInc\Saasus\Sdk\Auth\Endpoint\GetApiKeys(), $fetch);
    }
    /**
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \AntiPatternInc\Saasus\Sdk\Auth\Exception\CreateApiKeyInternalServerErrorException
     *
     * @return null|\Psr\Http\Message\ResponseInterface
     */
    public function createApiKey(string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \AntiPatternInc\Saasus\Sdk\Auth\Endpoint\CreateApiKey(), $fetch);
    }
    /**
    * サーバサイド用の API キーを削除します。
    
    Delete API Key.
    
    *
    * @param string $apiKey APIキー(API key)
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \AntiPatternInc\Saasus\Sdk\Auth\Exception\DeleteApiKeyInternalServerErrorException
    *
    * @return null|\Psr\Http\Message\ResponseInterface
    */
    public function deleteApiKey(string $apiKey, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \AntiPatternInc\Saasus\Sdk\Auth\Endpoint\DeleteApiKey($apiKey), $fetch);
    }
    /**
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \AntiPatternInc\Saasus\Sdk\Auth\Exception\GetSaasIdInternalServerErrorException
     *
     * @return null|\AntiPatternInc\Saasus\Sdk\Auth\Model\SaasId|\Psr\Http\Message\ResponseInterface
     */
    public function getSaasId(string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \AntiPatternInc\Saasus\Sdk\Auth\Endpoint\GetSaasId(), $fetch);
    }
    /**
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \AntiPatternInc\Saasus\Sdk\Auth\Exception\UpdateSaasIdInternalServerErrorException
     *
     * @return null|\Psr\Http\Message\ResponseInterface
     */
    public function updateSaasId(string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \AntiPatternInc\Saasus\Sdk\Auth\Endpoint\UpdateSaasId(), $fetch);
    }
    /**
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \AntiPatternInc\Saasus\Sdk\Auth\Exception\FindNotificationMessagesInternalServerErrorException
     *
     * @return null|\AntiPatternInc\Saasus\Sdk\Auth\Model\NotificationMessages|\Psr\Http\Message\ResponseInterface
     */
    public function findNotificationMessages(string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \AntiPatternInc\Saasus\Sdk\Auth\Endpoint\FindNotificationMessages(), $fetch);
    }
    /**
    * 各種通知メールテンプレート更新します。
    
    Update notification email template.
    
    *
    * @param null|\AntiPatternInc\Saasus\Sdk\Auth\Model\UpdateNotificationMessagesParam $requestBody 
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \AntiPatternInc\Saasus\Sdk\Auth\Exception\UpdateNotificationMessagesInternalServerErrorException
    *
    * @return null|\Psr\Http\Message\ResponseInterface
    */
    public function updateNotificationMessages(?\AntiPatternInc\Saasus\Sdk\Auth\Model\UpdateNotificationMessagesParam $requestBody = null, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \AntiPatternInc\Saasus\Sdk\Auth\Endpoint\UpdateNotificationMessages($requestBody), $fetch);
    }
    /**
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \AntiPatternInc\Saasus\Sdk\Auth\Exception\GetIdentityProvidersInternalServerErrorException
     *
     * @return null|\AntiPatternInc\Saasus\Sdk\Auth\Model\IdentityProviders|\Psr\Http\Message\ResponseInterface
     */
    public function getIdentityProviders(string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \AntiPatternInc\Saasus\Sdk\Auth\Endpoint\GetIdentityProviders(), $fetch);
    }
    /**
     * 外部IDプロバイダのサインイン情報更新
     *
     * @param null|\AntiPatternInc\Saasus\Sdk\Auth\Model\UpdateIdentityProviderParam $requestBody 
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \AntiPatternInc\Saasus\Sdk\Auth\Exception\UpdateIdentityProviderInternalServerErrorException
     *
     * @return null|\Psr\Http\Message\ResponseInterface
     */
    public function updateIdentityProvider(?\AntiPatternInc\Saasus\Sdk\Auth\Model\UpdateIdentityProviderParam $requestBody = null, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \AntiPatternInc\Saasus\Sdk\Auth\Endpoint\UpdateIdentityProvider($requestBody), $fetch);
    }
    /**
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \AntiPatternInc\Saasus\Sdk\Auth\Exception\GetSignInSettingsInternalServerErrorException
     *
     * @return null|\AntiPatternInc\Saasus\Sdk\Auth\Model\SignInSettings|\Psr\Http\Message\ResponseInterface
     */
    public function getSignInSettings(string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \AntiPatternInc\Saasus\Sdk\Auth\Endpoint\GetSignInSettings(), $fetch);
    }
    /**
    * ユーザーパスワードの要件設定を更新します。
    アルファベット、数字、記号の組み合わせで、桁数を長くすれば解読されづらい安全なパスワードを設定することが可能となります。
    
    Update user password requirements.
    Set a secure password that is difficult to decipher by increasing the number of digits by combining alphabets, numbers, and symbols.
    
    *
    * @param null|\AntiPatternInc\Saasus\Sdk\Auth\Model\UpdateSignInSettingsParam $requestBody 
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \AntiPatternInc\Saasus\Sdk\Auth\Exception\UpdateSignInSettingsInternalServerErrorException
    *
    * @return null|\Psr\Http\Message\ResponseInterface
    */
    public function updateSignInSettings(?\AntiPatternInc\Saasus\Sdk\Auth\Model\UpdateSignInSettingsParam $requestBody = null, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \AntiPatternInc\Saasus\Sdk\Auth\Endpoint\UpdateSignInSettings($requestBody), $fetch);
    }
    /**
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \AntiPatternInc\Saasus\Sdk\Auth\Exception\GetCustomizePagesInternalServerErrorException
     *
     * @return null|\AntiPatternInc\Saasus\Sdk\Auth\Model\CustomizePages|\Psr\Http\Message\ResponseInterface
     */
    public function getCustomizePages(string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \AntiPatternInc\Saasus\Sdk\Auth\Endpoint\GetCustomizePages(), $fetch);
    }
    /**
    * 認証系画面設定情報（新規登録・ログイン・パスワードリセット等）を更新します。
    
    Update the authentication page setting information (new registration, login, password reset, etc.).
    
    *
    * @param null|\AntiPatternInc\Saasus\Sdk\Auth\Model\UpdateCustomizePagesParam $requestBody 
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \AntiPatternInc\Saasus\Sdk\Auth\Exception\UpdateCustomizePagesInternalServerErrorException
    *
    * @return null|\Psr\Http\Message\ResponseInterface
    */
    public function updateCustomizePages(?\AntiPatternInc\Saasus\Sdk\Auth\Model\UpdateCustomizePagesParam $requestBody = null, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \AntiPatternInc\Saasus\Sdk\Auth\Endpoint\UpdateCustomizePages($requestBody), $fetch);
    }
    /**
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \AntiPatternInc\Saasus\Sdk\Auth\Exception\GetCustomizePageSettingsInternalServerErrorException
     *
     * @return null|\AntiPatternInc\Saasus\Sdk\Auth\Model\CustomizePageSettings|\Psr\Http\Message\ResponseInterface
     */
    public function getCustomizePageSettings(string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \AntiPatternInc\Saasus\Sdk\Auth\Endpoint\GetCustomizePageSettings(), $fetch);
    }
    /**
    * 認証認可基本情報を更新します。
    
    Update authentication authorization basic information.
    
    *
    * @param null|\AntiPatternInc\Saasus\Sdk\Auth\Model\UpdateCustomizePageSettingsParam $requestBody 
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \AntiPatternInc\Saasus\Sdk\Auth\Exception\UpdateCustomizePageSettingsInternalServerErrorException
    *
    * @return null|\Psr\Http\Message\ResponseInterface
    */
    public function updateCustomizePageSettings(?\AntiPatternInc\Saasus\Sdk\Auth\Model\UpdateCustomizePageSettingsParam $requestBody = null, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \AntiPatternInc\Saasus\Sdk\Auth\Endpoint\UpdateCustomizePageSettings($requestBody), $fetch);
    }
    /**
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \AntiPatternInc\Saasus\Sdk\Auth\Exception\GetEnvsInternalServerErrorException
     *
     * @return null|\AntiPatternInc\Saasus\Sdk\Auth\Model\Envs|\Psr\Http\Message\ResponseInterface
     */
    public function getEnvs(string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \AntiPatternInc\Saasus\Sdk\Auth\Endpoint\GetEnvs(), $fetch);
    }
    /**
    * 環境情報を作成します。
    連携のテストや開発用環境や実際の運用で利用する環境など複数の環境を定義することができます。
    
    Create environment information.
    Multiple environments can be defined, such as an environment for testing linkage, an environment for development, and an environment for actual operation.
    
    *
    * @param null|\stdClass $requestBody 
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \AntiPatternInc\Saasus\Sdk\Auth\Exception\CreateEnvInternalServerErrorException
    *
    * @return null|\AntiPatternInc\Saasus\Sdk\Auth\Model\Env|\Psr\Http\Message\ResponseInterface
    */
    public function createEnv(?\stdClass $requestBody = null, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \AntiPatternInc\Saasus\Sdk\Auth\Endpoint\CreateEnv($requestBody), $fetch);
    }
    /**
    * 環境情報を削除します。idが3の環境は削除できません。
    
    Delete env info. Env with id 3 cannot be deleted.
    
    *
    * @param int $envId 環境ID(Env ID)
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \AntiPatternInc\Saasus\Sdk\Auth\Exception\DeleteEnvNotFoundException
    * @throws \AntiPatternInc\Saasus\Sdk\Auth\Exception\DeleteEnvInternalServerErrorException
    *
    * @return null|\Psr\Http\Message\ResponseInterface
    */
    public function deleteEnv(int $envId, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \AntiPatternInc\Saasus\Sdk\Auth\Endpoint\DeleteEnv($envId), $fetch);
    }
    /**
    * 環境情報の詳細を取得します。
    
    Get environment details.
    
    *
    * @param int $envId 環境ID(Env ID)
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \AntiPatternInc\Saasus\Sdk\Auth\Exception\GetEnvNotFoundException
    * @throws \AntiPatternInc\Saasus\Sdk\Auth\Exception\GetEnvInternalServerErrorException
    *
    * @return null|\AntiPatternInc\Saasus\Sdk\Auth\Model\Env|\Psr\Http\Message\ResponseInterface
    */
    public function getEnv(int $envId, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \AntiPatternInc\Saasus\Sdk\Auth\Endpoint\GetEnv($envId), $fetch);
    }
    /**
    * 環境情報を更新します。
    
    Update env info.
    
    *
    * @param int $envId 環境ID(Env ID)
    * @param null|\AntiPatternInc\Saasus\Sdk\Auth\Model\UpdateEnvParam $requestBody 
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \AntiPatternInc\Saasus\Sdk\Auth\Exception\UpdateEnvNotFoundException
    * @throws \AntiPatternInc\Saasus\Sdk\Auth\Exception\UpdateEnvInternalServerErrorException
    *
    * @return null|\Psr\Http\Message\ResponseInterface
    */
    public function updateEnv(int $envId, ?\AntiPatternInc\Saasus\Sdk\Auth\Model\UpdateEnvParam $requestBody = null, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \AntiPatternInc\Saasus\Sdk\Auth\Endpoint\UpdateEnv($envId, $requestBody), $fetch);
    }
    /**
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \AntiPatternInc\Saasus\Sdk\Auth\Exception\CreateTenantAndPricingInternalServerErrorException
     *
     * @return null|\Psr\Http\Message\ResponseInterface
     */
    public function createTenantAndPricing(string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \AntiPatternInc\Saasus\Sdk\Auth\Endpoint\CreateTenantAndPricing(), $fetch);
    }
    /**
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \AntiPatternInc\Saasus\Sdk\Auth\Exception\DeleteStripeTenantAndPricingInternalServerErrorException
     *
     * @return null|\Psr\Http\Message\ResponseInterface
     */
    public function deleteStripeTenantAndPricing(string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \AntiPatternInc\Saasus\Sdk\Auth\Endpoint\DeleteStripeTenantAndPricing(), $fetch);
    }
    /**
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \AntiPatternInc\Saasus\Sdk\Auth\Exception\GetClientSecretInternalServerErrorException
     *
     * @return null|\AntiPatternInc\Saasus\Sdk\Auth\Model\ClientSecret|\Psr\Http\Message\ResponseInterface
     */
    public function getClientSecret(string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \AntiPatternInc\Saasus\Sdk\Auth\Endpoint\GetClientSecret(), $fetch);
    }
    /**
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \AntiPatternInc\Saasus\Sdk\Auth\Exception\UpdateClientSecretInternalServerErrorException
     *
     * @return null|\Psr\Http\Message\ResponseInterface
     */
    public function updateClientSecret(string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \AntiPatternInc\Saasus\Sdk\Auth\Endpoint\UpdateClientSecret(), $fetch);
    }
    /**
    * 一時コードまたはリフレッシュトークンを利用してIDトークン・アクセストークン・リフレッシュトークンを取得する。
    
    Get ID token, access token, and refresh token using a temporary code or a refresh token.
    
    *
    * @param array $queryParameters {
    *     @var string $code 一時コード(Temp Code)
    *     @var string $auth-flow 認証フロー（Authentication Flow）
    tempCodeAuth: 一時コードを利用した認証情報の取得
    refreshTokenAuth: リフレッシュトークンを利用した認証情報の取得
    指定されていない場合は tempCodeAuth になります
    
    *     @var string $refresh-token リフレッシュトークン(Refresh Token)
    * }
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \AntiPatternInc\Saasus\Sdk\Auth\Exception\GetAuthCredentialsNotFoundException
    * @throws \AntiPatternInc\Saasus\Sdk\Auth\Exception\GetAuthCredentialsInternalServerErrorException
    *
    * @return null|\AntiPatternInc\Saasus\Sdk\Auth\Model\Credentials|\Psr\Http\Message\ResponseInterface
    */
    public function getAuthCredentials(array $queryParameters = array(), string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \AntiPatternInc\Saasus\Sdk\Auth\Endpoint\GetAuthCredentials($queryParameters), $fetch);
    }
    /**
    * 引数のIDトークン・アクセストークン・リフレッシュトークンを一時保存し取得用の一時コードを返却する。
    一時コードの有効期間は発行から10秒です。
    
    Temporarily save the parameter for the ID token, access token, and refresh token and return a temporary code for obtaining.
    Temporary codes are valid for 10 seconds from issuance.
    
    *
    * @param null|\stdClass $requestBody 
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \AntiPatternInc\Saasus\Sdk\Auth\Exception\CreateAuthCredentialsBadRequestException
    * @throws \AntiPatternInc\Saasus\Sdk\Auth\Exception\CreateAuthCredentialsUnauthorizedException
    * @throws \AntiPatternInc\Saasus\Sdk\Auth\Exception\CreateAuthCredentialsInternalServerErrorException
    *
    * @return null|\AntiPatternInc\Saasus\Sdk\Auth\Model\AuthorizationTempCode|\Psr\Http\Message\ResponseInterface
    */
    public function createAuthCredentials(?\stdClass $requestBody = null, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \AntiPatternInc\Saasus\Sdk\Auth\Endpoint\CreateAuthCredentials($requestBody), $fetch);
    }
    /**
    * ユーザーを新規登録します。登録されたメールアドレスに対して仮パスワードを送信します。
    
    Register a new user. A temporary password will be sent to the registered email.
    
    *
    * @param null|\AntiPatternInc\Saasus\Sdk\Auth\Model\SignUpParam $requestBody 
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \AntiPatternInc\Saasus\Sdk\Auth\Exception\SignUpInternalServerErrorException
    *
    * @return null|\AntiPatternInc\Saasus\Sdk\Auth\Model\SaasUser|\Psr\Http\Message\ResponseInterface
    */
    public function signUp(?\AntiPatternInc\Saasus\Sdk\Auth\Model\SignUpParam $requestBody = null, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \AntiPatternInc\Saasus\Sdk\Auth\Endpoint\SignUp($requestBody), $fetch);
    }
    /**
    * 新規登録時の仮パスワードを再送信します。
    
    Resend temporary password for the new registered user.
    
    *
    * @param null|\AntiPatternInc\Saasus\Sdk\Auth\Model\ResendSignUpConfirmationEmailParam $requestBody 
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \AntiPatternInc\Saasus\Sdk\Auth\Exception\ResendSignUpConfirmationEmailInternalServerErrorException
    *
    * @return null|\Psr\Http\Message\ResponseInterface
    */
    public function resendSignUpConfirmationEmail(?\AntiPatternInc\Saasus\Sdk\Auth\Model\ResendSignUpConfirmationEmailParam $requestBody = null, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \AntiPatternInc\Saasus\Sdk\Auth\Endpoint\ResendSignUpConfirmationEmail($requestBody), $fetch);
    }
    /**
    * AWS Marketplaceと連携したユーザーを新規登録します。登録されたメールアドレスに対して仮パスワードを送信します。
    Registration Tokenが有効でない場合はエラーを返却します。
    
    Register a new user linked to AWS Marketplace. A temporary password will be sent to the registered email.
    If the Registration Token is not valid, an error is returned.
    
    *
    * @param null|\AntiPatternInc\Saasus\Sdk\Auth\Model\SignUpWithAwsMarketplaceParam $requestBody 
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \AntiPatternInc\Saasus\Sdk\Auth\Exception\SignUpWithAwsMarketplaceInternalServerErrorException
    *
    * @return null|\AntiPatternInc\Saasus\Sdk\Auth\Model\SaasUser|\Psr\Http\Message\ResponseInterface
    */
    public function signUpWithAwsMarketplace(?\AntiPatternInc\Saasus\Sdk\Auth\Model\SignUpWithAwsMarketplaceParam $requestBody = null, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \AntiPatternInc\Saasus\Sdk\Auth\Endpoint\SignUpWithAwsMarketplace($requestBody), $fetch);
    }
    /**
    * AWS Marketplaceと連携したユーザー新規登録を確定します。AWS Marketplaceと連携したテナントを新規作成します。
    Registration Tokenが有効でない場合はエラーを返却します。
    
    Confirm a new use registeration linked to AWS Marketplace. Create a new tenant linked to AWS Marketplace.
    If the Registration Token is not valid, an error is returned.
    
    *
    * @param null|\AntiPatternInc\Saasus\Sdk\Auth\Model\ConfirmSignUpWithAwsMarketplaceParam $requestBody 
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \AntiPatternInc\Saasus\Sdk\Auth\Exception\ConfirmSignUpWithAwsMarketplaceInternalServerErrorException
    *
    * @return null|\AntiPatternInc\Saasus\Sdk\Auth\Model\Tenant|\Psr\Http\Message\ResponseInterface
    */
    public function confirmSignUpWithAwsMarketplace(?\AntiPatternInc\Saasus\Sdk\Auth\Model\ConfirmSignUpWithAwsMarketplaceParam $requestBody = null, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \AntiPatternInc\Saasus\Sdk\Auth\Endpoint\ConfirmSignUpWithAwsMarketplace($requestBody), $fetch);
    }
    /**
    * AWS Marketplaceと既存のテナントを連携します。
    Registration Tokenが有効でない場合はエラーを返却します。
    
    Link an existing tenant with AWS Marketplace.
    If the Registration Token is not valid, an error is returned.
    
    *
    * @param null|\AntiPatternInc\Saasus\Sdk\Auth\Model\LinkAwsMarketplaceParam $requestBody 
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \AntiPatternInc\Saasus\Sdk\Auth\Exception\LinkAwsMarketplaceInternalServerErrorException
    *
    * @return null|\Psr\Http\Message\ResponseInterface
    */
    public function linkAwsMarketplace(?\AntiPatternInc\Saasus\Sdk\Auth\Model\LinkAwsMarketplaceParam $requestBody = null, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \AntiPatternInc\Saasus\Sdk\Auth\Endpoint\LinkAwsMarketplace($requestBody), $fetch);
    }
    /**
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \AntiPatternInc\Saasus\Sdk\Auth\Exception\ResetPlanInternalServerErrorException
     *
     * @return null|\Psr\Http\Message\ResponseInterface
     */
    public function resetPlan(string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \AntiPatternInc\Saasus\Sdk\Auth\Endpoint\ResetPlan(), $fetch);
    }
    /**
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \AntiPatternInc\Saasus\Sdk\Auth\Exception\ReturnInternalServerErrorInternalServerErrorException
     *
     * @return null|\Psr\Http\Message\ResponseInterface
     */
    public function returnInternalServerError(string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \AntiPatternInc\Saasus\Sdk\Auth\Endpoint\ReturnInternalServerError(), $fetch);
    }
    public static function create($httpClient = null, array $additionalPlugins = array(), array $additionalNormalizers = array())
    {
        if (null === $httpClient) {
            $httpClient = \Http\Discovery\Psr18ClientDiscovery::find();
            $plugins = array();
            $uri = \Http\Discovery\Psr17FactoryDiscovery::findUrlFactory()->createUri('https://api.saasus.io/v1/auth');
            $plugins[] = new \Http\Client\Common\Plugin\AddHostPlugin($uri);
            $plugins[] = new \Http\Client\Common\Plugin\AddPathPlugin($uri);
            if (count($additionalPlugins) > 0) {
                $plugins = array_merge($plugins, $additionalPlugins);
            }
            $httpClient = new \Http\Client\Common\PluginClient($httpClient, $plugins);
        }
        $requestFactory = \Http\Discovery\Psr17FactoryDiscovery::findRequestFactory();
        $streamFactory = \Http\Discovery\Psr17FactoryDiscovery::findStreamFactory();
        $normalizers = array(new \Symfony\Component\Serializer\Normalizer\ArrayDenormalizer(), new \AntiPatternInc\Saasus\Sdk\Auth\Normalizer\JaneObjectNormalizer());
        if (count($additionalNormalizers) > 0) {
            $normalizers = array_merge($normalizers, $additionalNormalizers);
        }
        $serializer = new \Symfony\Component\Serializer\Serializer($normalizers, array(new \Symfony\Component\Serializer\Encoder\JsonEncoder(new \Symfony\Component\Serializer\Encoder\JsonEncode(), new \Symfony\Component\Serializer\Encoder\JsonDecode(array('json_decode_associative' => true)))));
        return new static($httpClient, $requestFactory, $serializer, $streamFactory);
    }
}
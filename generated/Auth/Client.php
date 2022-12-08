<?php

namespace AntiPatternInc\Saasus\Sdk\Auth;

class Client extends \AntiPatternInc\Saasus\Sdk\Auth\Runtime\Client\Client
{
    /**
    * SaaS利用ユーザ(登録ユーザ)のIDトークンを元に、ユーザ情報を取得します。
    IDトークンは、SaaSus Platform生成のログイン画面からログイン時にCallback URLに渡されます。
    サーバ側でそのURLからIDトークンを取得し、このAPIを呼ぶことにより、該当ユーザの情報が取得できます。
    取得した上には、所属テナントや役割、料金プランなどが含まれているため、それを元に認可の実装を行うことが可能です。
    
    *
    * @param array $queryParameters {
    *     @var string $token IDトークン
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
    * SaaSus ID を元にパラメータとして設定したドメイン名を設定更新します。
    CNAME レコードが生成されますので、 DNS に設定して下さい。
    既に稼働中の SaaS アプリケーションに設定している場合には、動作に影響があります。
    
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
     * @throws \AntiPatternInc\Saasus\Sdk\Auth\Exception\GetSaaSUsersInternalServerErrorException
     *
     * @return null|\AntiPatternInc\Saasus\Sdk\Auth\Model\SaasUsers|\Psr\Http\Message\ResponseInterface
     */
    public function getSaaSUsers(string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \AntiPatternInc\Saasus\Sdk\Auth\Endpoint\GetSaaSUsers(), $fetch);
    }
    /**
     * SaaSにユーザーを作成します。
     *
     * @param null|\AntiPatternInc\Saasus\Sdk\Auth\Model\CreateSaasUserParam $requestBody 
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \AntiPatternInc\Saasus\Sdk\Auth\Exception\CreateSaaSUserBadRequestException
     * @throws \AntiPatternInc\Saasus\Sdk\Auth\Exception\CreateSaaSUserInternalServerErrorException
     *
     * @return null|\AntiPatternInc\Saasus\Sdk\Auth\Model\SaasUser|\Psr\Http\Message\ResponseInterface
     */
    public function createSaaSUser(?\AntiPatternInc\Saasus\Sdk\Auth\Model\CreateSaasUserParam $requestBody = null, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \AntiPatternInc\Saasus\Sdk\Auth\Endpoint\CreateSaaSUser($requestBody), $fetch);
    }
    /**
     * ユーザーIDを元に一致するユーザーをテナントからすべて削除し、SaaSからも削除します。
     *
     * @param string $userId ユーザーID
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \AntiPatternInc\Saasus\Sdk\Auth\Exception\DeleteSaaSUserNotFoundException
     * @throws \AntiPatternInc\Saasus\Sdk\Auth\Exception\DeleteSaaSUserInternalServerErrorException
     *
     * @return null|\Psr\Http\Message\ResponseInterface
     */
    public function deleteSaaSUser(string $userId, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \AntiPatternInc\Saasus\Sdk\Auth\Endpoint\DeleteSaaSUser($userId), $fetch);
    }
    /**
     * ユーザーIDからユーザー情報を取得します。
     *
     * @param string $userId ユーザーID
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \AntiPatternInc\Saasus\Sdk\Auth\Exception\GetSaaSUserNotFoundException
     * @throws \AntiPatternInc\Saasus\Sdk\Auth\Exception\GetSaaSUserInternalServerErrorException
     *
     * @return null|\AntiPatternInc\Saasus\Sdk\Auth\Model\SaasUser|\Psr\Http\Message\ResponseInterface
     */
    public function getSaaSUser(string $userId, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \AntiPatternInc\Saasus\Sdk\Auth\Endpoint\GetSaaSUser($userId), $fetch);
    }
    /**
     * ユーザーのログインパスワードを変更します。
     *
     * @param string $userId ユーザーID
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
     *
     * @param string $userId ユーザーID
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
     * 認証アプリケーションの登録
     *
     * @param string $userId ユーザーID
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
     * 認証アプリケーション登録用のシークレットコード作成
     *
     * @param string $userId ユーザーID
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
     * 個別のユーザーのMFA設定を取得
     *
     * @param string $userId ユーザーID
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
     * 個別のユーザーのMFA設定を更新
     *
     * @param string $userId ユーザーID
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
     * ユーザーIDからテナントに所属しているユーザー情報を取得します。複数テナントに所属している場合は別のオブジェクトとして返却されます。
     *
     * @param string $userId ユーザーID
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
     *
     * @param string $tenantId テナントID
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
     * テナントにユーザーを作成します。attributesを空のオブジェクトにした場合、追加属性は空で作成されます。
     *
     * @param string $tenantId テナントID
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
     *
     * @param string $tenantId テナントID
     * @param string $userId ユーザーID
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
     *
     * @param string $tenantId テナントID
     * @param string $userId ユーザーID
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
     *
     * @param string $tenantId テナントID
     * @param string $userId ユーザーID
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
     * テナントのユーザーに役割を作成します。
     *
     * @param string $tenantId テナントID
     * @param string $userId ユーザーID
     * @param int $envId 環境ID
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
     * テナントのユーザーから役割を削除します。
     *
     * @param string $tenantId テナントID
     * @param string $userId ユーザーID
     * @param int $envId 環境ID
     * @param string $roleName 役割名
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
     * 役割を作成します。
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
     * 役割を削除します。
     *
     * @param string $roleName 役割名
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
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
     *
     * @param string $attributeName 属性名
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
     *
     * @param string $attributeName 属性名
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
     *
     * @param string $tenantId テナントID
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
     *
     * @param string $tenantId テナントID
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \AntiPatternInc\Saasus\Sdk\Auth\Exception\GetTenantNotFoundException
     * @throws \AntiPatternInc\Saasus\Sdk\Auth\Exception\GetTenantInternalServerErrorException
     *
     * @return null|\AntiPatternInc\Saasus\Sdk\Auth\Model\Tenant|\Psr\Http\Message\ResponseInterface
     */
    public function getTenant(string $tenantId, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \AntiPatternInc\Saasus\Sdk\Auth\Endpoint\GetTenant($tenantId), $fetch);
    }
    /**
     * SaaSus Platform で管理する、テナントの詳細情報を更新します。
     *
     * @param string $tenantId テナントID
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
     *
     * @param string $apiKey ApiKey
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
     * @throws \AntiPatternInc\Saasus\Sdk\Auth\Exception\GetSaasIDInternalServerErrorException
     *
     * @return null|\AntiPatternInc\Saasus\Sdk\Auth\Model\SaasID|\Psr\Http\Message\ResponseInterface
     */
    public function getSaasID(string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \AntiPatternInc\Saasus\Sdk\Auth\Endpoint\GetSaasID(), $fetch);
    }
    /**
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \AntiPatternInc\Saasus\Sdk\Auth\Exception\UpdateSaasIDInternalServerErrorException
     *
     * @return null|\Psr\Http\Message\ResponseInterface
     */
    public function updateSaasID(string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \AntiPatternInc\Saasus\Sdk\Auth\Endpoint\UpdateSaasID(), $fetch);
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
    * 連携のテストや開発用環境や実際の運用で利用する環境など複数の環境を定義することができるようになっており、
    環境情報を作成します。
    
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
     * 環境情報を削除します。
     *
     * @param int $envId 環境ID
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
     *
     * @param int $envId 環境ID
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
     *
     * @param int $envId 環境ID
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
     * @throws \AntiPatternInc\Saasus\Sdk\Auth\Exception\DeleteEventBridgeSettingsInternalServerErrorException
     *
     * @return null|\Psr\Http\Message\ResponseInterface
     */
    public function deleteEventBridgeSettings(string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \AntiPatternInc\Saasus\Sdk\Auth\Endpoint\DeleteEventBridgeSettings(), $fetch);
    }
    /**
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \AntiPatternInc\Saasus\Sdk\Auth\Exception\GetEventBridgeSettingsInternalServerErrorException
     *
     * @return null|\AntiPatternInc\Saasus\Sdk\Auth\Model\EventBridgeSettings|\Psr\Http\Message\ResponseInterface
     */
    public function getEventBridgeSettings(string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \AntiPatternInc\Saasus\Sdk\Auth\Endpoint\GetEventBridgeSettings(), $fetch);
    }
    /**
     * 監視対象となっている全ホストの状態を Amazon EventBridge 経由で提供するための設定を更新します
     *
     * @param null|\stdClass $requestBody 
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \AntiPatternInc\Saasus\Sdk\Auth\Exception\SaveEventBridgeSettingsInternalServerErrorException
     *
     * @return null|\Psr\Http\Message\ResponseInterface
     */
    public function saveEventBridgeSettings(?\stdClass $requestBody = null, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \AntiPatternInc\Saasus\Sdk\Auth\Endpoint\SaveEventBridgeSettings($requestBody), $fetch);
    }
    /**
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \AntiPatternInc\Saasus\Sdk\Auth\Exception\CreateEventBridgeTestEventInternalServerErrorException
     *
     * @return null|\Psr\Http\Message\ResponseInterface
     */
    public function createEventBridgeTestEvent(string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \AntiPatternInc\Saasus\Sdk\Auth\Endpoint\CreateEventBridgeTestEvent(), $fetch);
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
     * 認証・認可情報の取得
     *
     * @param array $queryParameters {
     *     @var string $code 認可コード
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
     * 認証・認可情報の保存
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
    public static function create($httpClient = null, array $additionalPlugins = array(), array $additionalNormalizers = array())
    {
        if (null === $httpClient) {
            $httpClient = \Http\Discovery\Psr18ClientDiscovery::find();
            $plugins = array();
            $uri = \Http\Discovery\Psr17FactoryDiscovery::findUrlFactory()->createUri('https://api.saasus.io/v0/auth');
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
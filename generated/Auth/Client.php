<?php

namespace AntiPatternInc\Saasus\Sdk\Auth;

class Client extends \AntiPatternInc\Saasus\Sdk\Auth\Runtime\Client\Client
{
    /**
    * User information is obtained based on the ID token of the SaaS user (registered user).
    The ID token is passed to the Callback URL during login from the SaaSus Platform generated login screen.
    User information can be obtained from calling this API with an ID token from the URL on the server side.
    Since the acquired tenant, role (role), price plan, etc. are included, it is possible to implement authorization based on it.
    
    *
    * @param array $queryParameters {
    *     @var string $token ID Token
    * }
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \AntiPatternInc\Saasus\Sdk\Auth\Exception\GetUserInfoUnauthorizedException
    * @throws \AntiPatternInc\Saasus\Sdk\Auth\Exception\GetUserInfoInternalServerErrorException
    *
    * @return null|\AntiPatternInc\Saasus\Sdk\Auth\Model\UserInfo|\Psr\Http\Message\ResponseInterface
    */
    public function getUserInfo(array $queryParameters = [], string $fetch = self::FETCH_OBJECT)
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
    * Update the domain name that was set as a parameter based on the SaaS ID.
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
    * Register post-login SaaS URL for authentication information.
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
     * Create SaaS User.
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
     * Delete all users with matching user ID from the tenant and SaaS.
     *
     * @param string $userId User ID
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
     * Get user information based on user ID.
     *
     * @param string $userId User ID
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
     * Change user's login password.
     *
     * @param string $userId User ID
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
     * Change user's email.
     *
     * @param string $userId User ID
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
    * Request to update the user's email address.
    Sends a verification code to the requested email address.
    Requires the user's access token.
    The verification code is valid for 24 hours.
    
    *
    * @param string $userId User ID
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
    * Verify the code to confirm the user's email address update.
    Requires the user's access token.
    
    *
    * @param string $userId User ID
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
     * Register an authentication application.
     *
     * @param string $userId User ID
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
     * Create a secret code for authentication application registration.
     *
     * @param string $userId User ID
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
     * Get the user's MFA settings.
     *
     * @param string $userId User ID
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
     * Update user's MFA settings.
     *
     * @param string $userId User ID
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
     * Unlink external identity providers.
     *
     * @param string $providerName 
     * @param string $userId User ID
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
    * Get information on user belonging to the tenant from the user ID.
    If the user belongs to multiple tenants, it will be returned as another object.
    
    *
    * @param string $userId User ID
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
    * Get all the users belonging to the tenant.
    Id is unique.
    
    *
    * @param string $tenantId Tenant ID
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
    * Create a tenant user.
    If attributes is empty, the additional attributes will be created empty.
    
    *
    * @param string $tenantId Tenant ID
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
     * Delete a user from the tenant.
     *
     * @param string $tenantId Tenant ID
     * @param string $userId User ID
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
     * Get one tenant user by specific ID.
     *
     * @param string $tenantId Tenant ID
     * @param string $userId User ID
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
     * Update tenant user attributes.
     *
     * @param string $tenantId Tenant ID
     * @param string $userId User ID
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
     * Create roles on tenant users.
     *
     * @param string $tenantId Tenant ID
     * @param string $userId User ID
     * @param int $envId Env ID
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
     * Remove a role from a tenant user.
     *
     * @param string $tenantId Tenant ID
     * @param string $userId User ID
     * @param int $envId Env ID
     * @param string $roleName Role name
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
    * Create a role.
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
     * Delete role.
     *
     * @param string $roleName Role name
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
    * Create additional user attributes to be kept on the SaaSus Platform.
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
     * Delete user attributes kept on the SaaSus Platform.
     *
     * @param string $attributeName Attribute Name
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
    * Register additional tenant attributes to be managed by SaaSus Platform.
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
     * Deletes tenant attributes managed by SaaSus Platform.
     *
     * @param string $attributeName Attribute Name
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
     * Create a tenant managed by the SaaSus Platform.
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
     * Delete SaaSus Platform tenant.
     *
     * @param string $tenantId Tenant ID
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
     * Get the details of tenant managed on the SaaSus Platform.
     *
     * @param string $tenantId Tenant ID
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
     * Update SaaSus Platform tenant details.
     *
     * @param string $tenantId Tenant ID
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
     * Update SaaSus Platform tenant plan information.
     *
     * @param string $tenantId Tenant ID
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
     * Update SaaSus Platform tenant billing information.
     *
     * @param string $tenantId Tenant ID
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
     * Get a list of invitations to the tenant.
     *
     * @param string $tenantId Tenant ID
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
     * Create an invitation to the tenant.
     *
     * @param string $tenantId Tenant ID
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
     * Delete an invitation for the tenant.
     *
     * @param string $tenantId Tenant ID
     * @param string $invitationId Invitation ID
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
     * Get invitation information for the tenant.
     *
     * @param string $tenantId Tenant ID
     * @param string $invitationId Invitation ID
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
     * Get the validity of an invitation to the tenant.
     *
     * @param string $invitationId Invitation ID
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
     * Validate an invitation to the tenant.
     *
     * @param string $invitationId Invitation ID
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
     * Get sign-in information via external identity provider per tenant.
     *
     * @param string $tenantId Tenant ID
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
     * Update sign-in information via external identity provider per tenant.
     *
     * @param string $tenantId Tenant ID
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
    * Request to link an external account user.
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
     * Verify the code for external account user link confirmation.
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
     * @throws \AntiPatternInc\Saasus\Sdk\Auth\Exception\FindNotificationMessagesInternalServerErrorException
     *
     * @return null|\AntiPatternInc\Saasus\Sdk\Auth\Model\NotificationMessages|\Psr\Http\Message\ResponseInterface
     */
    public function findNotificationMessages(string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \AntiPatternInc\Saasus\Sdk\Auth\Endpoint\FindNotificationMessages(), $fetch);
    }
    /**
     * Update notification email template.
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
     * Update the sign-in information for the external ID provider
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
    * Update user password requirements.
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
     * Update the authentication page setting information (new registration, login, password reset, etc.).
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
     * Update authentication authorization basic information.
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
    * Create environment information.
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
     * Delete env info. Env with id 3 cannot be deleted.
     *
     * @param int $envId Env ID
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
     * Get environment details.
     *
     * @param int $envId Env ID
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
     * Update env info.
     *
     * @param int $envId Env ID
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
    * Get ID token, access token, and refresh token using a temporary code or a refresh token.
    
    *
    * @param array $queryParameters {
    *     @var string $code Temp Code
    *     @var string $auth-flow Authentication Flow
    tempCodeAuth: Getting authentication information using a temporary code
    refreshTokenAuth: Getting authentication information using a refresh token
    If not specified, it will be tempCodeAuth
    
    *     @var string $refresh-token Refresh Token
    * }
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \AntiPatternInc\Saasus\Sdk\Auth\Exception\GetAuthCredentialsNotFoundException
    * @throws \AntiPatternInc\Saasus\Sdk\Auth\Exception\GetAuthCredentialsInternalServerErrorException
    *
    * @return null|\AntiPatternInc\Saasus\Sdk\Auth\Model\Credentials|\Psr\Http\Message\ResponseInterface
    */
    public function getAuthCredentials(array $queryParameters = [], string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \AntiPatternInc\Saasus\Sdk\Auth\Endpoint\GetAuthCredentials($queryParameters), $fetch);
    }
    /**
    * Temporarily save the parameter for the ID token, access token, and refresh token and return a temporary code for obtaining.
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
     * Register a new user. A temporary password will be sent to the registered email.
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
     * Resend temporary password for the new registered user.
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
    * Register a new user linked to AWS Marketplace. A temporary password will be sent to the registered email.
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
    * Confirm a new use registeration linked to AWS Marketplace. Create a new tenant linked to AWS Marketplace.
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
    * Link an existing tenant with AWS Marketplace.
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
     * @throws \AntiPatternInc\Saasus\Sdk\Auth\Exception\GetCloudFormationLaunchStackLinkForSingleTenantInternalServerErrorException
     *
     * @return null|\AntiPatternInc\Saasus\Sdk\Auth\Model\CloudFormationLaunchStackLink|\Psr\Http\Message\ResponseInterface
     */
    public function getCloudFormationLaunchStackLinkForSingleTenant(string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \AntiPatternInc\Saasus\Sdk\Auth\Endpoint\GetCloudFormationLaunchStackLinkForSingleTenant(), $fetch);
    }
    /**
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \AntiPatternInc\Saasus\Sdk\Auth\Exception\GetSingleTenantSettingsInternalServerErrorException
     *
     * @return null|\AntiPatternInc\Saasus\Sdk\Auth\Model\SingleTenantSettings|\Psr\Http\Message\ResponseInterface
     */
    public function getSingleTenantSettings(string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \AntiPatternInc\Saasus\Sdk\Auth\Endpoint\GetSingleTenantSettings(), $fetch);
    }
    /**
    * Updates configuration information for single-tenant functionality
    Returns error if single tenant feature cannot be enabled.
    
    *
    * @param null|\AntiPatternInc\Saasus\Sdk\Auth\Model\UpdateSingleTenantSettingsParam $requestBody 
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \AntiPatternInc\Saasus\Sdk\Auth\Exception\UpdateSingleTenantSettingsBadRequestException
    * @throws \AntiPatternInc\Saasus\Sdk\Auth\Exception\UpdateSingleTenantSettingsInternalServerErrorException
    *
    * @return null|\Psr\Http\Message\ResponseInterface
    */
    public function updateSingleTenantSettings(?\AntiPatternInc\Saasus\Sdk\Auth\Model\UpdateSingleTenantSettingsParam $requestBody = null, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \AntiPatternInc\Saasus\Sdk\Auth\Endpoint\UpdateSingleTenantSettings($requestBody), $fetch);
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
    public static function create($httpClient = null, array $additionalPlugins = [], array $additionalNormalizers = [])
    {
        if (null === $httpClient) {
            $httpClient = \Http\Discovery\Psr18ClientDiscovery::find();
            $plugins = [];
            $uri = \Http\Discovery\Psr17FactoryDiscovery::findUriFactory()->createUri('https://api.saasus.io/v1/auth');
            $plugins[] = new \Http\Client\Common\Plugin\AddHostPlugin($uri);
            $plugins[] = new \Http\Client\Common\Plugin\AddPathPlugin($uri);
            if (count($additionalPlugins) > 0) {
                $plugins = array_merge($plugins, $additionalPlugins);
            }
            $httpClient = new \Http\Client\Common\PluginClient($httpClient, $plugins);
        }
        $requestFactory = \Http\Discovery\Psr17FactoryDiscovery::findRequestFactory();
        $streamFactory = \Http\Discovery\Psr17FactoryDiscovery::findStreamFactory();
        $normalizers = [new \Symfony\Component\Serializer\Normalizer\ArrayDenormalizer(), new \AntiPatternInc\Saasus\Sdk\Auth\Normalizer\JaneObjectNormalizer()];
        if (count($additionalNormalizers) > 0) {
            $normalizers = array_merge($normalizers, $additionalNormalizers);
        }
        $serializer = new \Symfony\Component\Serializer\Serializer($normalizers, [new \Symfony\Component\Serializer\Encoder\JsonEncoder(new \Symfony\Component\Serializer\Encoder\JsonEncode(), new \Symfony\Component\Serializer\Encoder\JsonDecode(['json_decode_associative' => true]))]);
        return new static($httpClient, $requestFactory, $serializer, $streamFactory);
    }
}
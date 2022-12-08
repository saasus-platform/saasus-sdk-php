<?php

namespace AntiPatternInc\Saasus\Sdk\Auth\Endpoint;

class DeleteTenantUserRole extends \AntiPatternInc\Saasus\Sdk\Auth\Runtime\Client\BaseEndpoint implements \AntiPatternInc\Saasus\Sdk\Auth\Runtime\Client\Endpoint
{
    protected $tenant_id;
    protected $user_id;
    protected $env_id;
    protected $role_name;
    /**
     * テナントのユーザーから役割を削除します。
     *
     * @param string $tenantId テナントID
     * @param string $userId ユーザーID
     * @param int $envId 環境ID
     * @param string $roleName 役割名
     */
    public function __construct(string $tenantId, string $userId, int $envId, string $roleName)
    {
        $this->tenant_id = $tenantId;
        $this->user_id = $userId;
        $this->env_id = $envId;
        $this->role_name = $roleName;
    }
    use \AntiPatternInc\Saasus\Sdk\Auth\Runtime\Client\EndpointTrait;
    public function getMethod() : string
    {
        return 'DELETE';
    }
    public function getUri() : string
    {
        return str_replace(array('{tenant_id}', '{user_id}', '{env_id}', '{role_name}'), array($this->tenant_id, $this->user_id, $this->env_id, $this->role_name), '/tenants/{tenant_id}/users/{user_id}/envs/{env_id}/roles/{role_name}');
    }
    public function getBody(\Symfony\Component\Serializer\SerializerInterface $serializer, $streamFactory = null) : array
    {
        return array(array(), null);
    }
    public function getExtraHeaders() : array
    {
        return array('Accept' => array('application/json'));
    }
    /**
     * {@inheritdoc}
     *
     * @throws \AntiPatternInc\Saasus\Sdk\Auth\Exception\DeleteTenantUserRoleNotFoundException
     * @throws \AntiPatternInc\Saasus\Sdk\Auth\Exception\DeleteTenantUserRoleInternalServerErrorException
     *
     * @return null
     */
    protected function transformResponseBody(string $body, int $status, \Symfony\Component\Serializer\SerializerInterface $serializer, ?string $contentType = null)
    {
        if (200 === $status) {
            return null;
        }
        if (is_null($contentType) === false && (404 === $status && mb_strpos($contentType, 'application/json') !== false)) {
            throw new \AntiPatternInc\Saasus\Sdk\Auth\Exception\DeleteTenantUserRoleNotFoundException($serializer->deserialize($body, 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Model\\Error', 'json'));
        }
        if (is_null($contentType) === false && (500 === $status && mb_strpos($contentType, 'application/json') !== false)) {
            throw new \AntiPatternInc\Saasus\Sdk\Auth\Exception\DeleteTenantUserRoleInternalServerErrorException($serializer->deserialize($body, 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Model\\Error', 'json'));
        }
    }
    public function getAuthenticationScopes() : array
    {
        return array('Bearer');
    }
}
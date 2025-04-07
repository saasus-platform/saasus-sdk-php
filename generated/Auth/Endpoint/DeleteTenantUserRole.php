<?php

namespace AntiPatternInc\Saasus\Sdk\Auth\Endpoint;

class DeleteTenantUserRole extends \AntiPatternInc\Saasus\Sdk\Auth\Runtime\Client\BaseEndpoint implements \AntiPatternInc\Saasus\Sdk\Auth\Runtime\Client\Endpoint
{
    protected $tenant_id;
    protected $user_id;
    protected $env_id;
    protected $role_name;
    /**
     * Remove a role from a tenant user.
     *
     * @param string $tenantId Tenant ID
     * @param string $userId User ID
     * @param int $envId Env ID
     * @param string $roleName Role name
     */
    public function __construct(string $tenantId, string $userId, int $envId, string $roleName)
    {
        $this->tenant_id = $tenantId;
        $this->user_id = $userId;
        $this->env_id = $envId;
        $this->role_name = $roleName;
    }
    use \AntiPatternInc\Saasus\Sdk\Auth\Runtime\Client\EndpointTrait;
    public function getMethod(): string
    {
        return 'DELETE';
    }
    public function getUri(): string
    {
        return str_replace(['{tenant_id}', '{user_id}', '{env_id}', '{role_name}'], [$this->tenant_id, $this->user_id, $this->env_id, $this->role_name], '/tenants/{tenant_id}/users/{user_id}/envs/{env_id}/roles/{role_name}');
    }
    public function getBody(\Symfony\Component\Serializer\SerializerInterface $serializer, $streamFactory = null): array
    {
        return [[], null];
    }
    public function getExtraHeaders(): array
    {
        return ['Accept' => ['application/json']];
    }
    /**
     * {@inheritdoc}
     *
     * @throws \AntiPatternInc\Saasus\Sdk\Auth\Exception\DeleteTenantUserRoleNotFoundException
     * @throws \AntiPatternInc\Saasus\Sdk\Auth\Exception\DeleteTenantUserRoleInternalServerErrorException
     *
     * @return null
     */
    protected function transformResponseBody(\Psr\Http\Message\ResponseInterface $response, \Symfony\Component\Serializer\SerializerInterface $serializer, ?string $contentType = null)
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if (200 === $status) {
            return null;
        }
        if (is_null($contentType) === false && (404 === $status && mb_strpos($contentType, 'application/json') !== false)) {
            throw new \AntiPatternInc\Saasus\Sdk\Auth\Exception\DeleteTenantUserRoleNotFoundException($serializer->deserialize($body, 'AntiPatternInc\Saasus\Sdk\Auth\Model\Error', 'json'), $response);
        }
        if (is_null($contentType) === false && (500 === $status && mb_strpos($contentType, 'application/json') !== false)) {
            throw new \AntiPatternInc\Saasus\Sdk\Auth\Exception\DeleteTenantUserRoleInternalServerErrorException($serializer->deserialize($body, 'AntiPatternInc\Saasus\Sdk\Auth\Model\Error', 'json'), $response);
        }
    }
    public function getAuthenticationScopes(): array
    {
        return ['Bearer'];
    }
}
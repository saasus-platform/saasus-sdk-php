<?php

namespace AntiPatternInc\Saasus\Sdk\Auth\Endpoint;

class CreateTenantUserRoles extends \AntiPatternInc\Saasus\Sdk\Auth\Runtime\Client\BaseEndpoint implements \AntiPatternInc\Saasus\Sdk\Auth\Runtime\Client\Endpoint
{
    protected $tenant_id;
    protected $user_id;
    protected $env_id;
    /**
     * Create roles on tenant users.
     *
     * @param string $tenantId Tenant ID
     * @param string $userId User ID
     * @param int $envId Env ID
     * @param null|\AntiPatternInc\Saasus\Sdk\Auth\Model\CreateTenantUserRolesParam $requestBody 
     */
    public function __construct(string $tenantId, string $userId, int $envId, ?\AntiPatternInc\Saasus\Sdk\Auth\Model\CreateTenantUserRolesParam $requestBody = null)
    {
        $this->tenant_id = $tenantId;
        $this->user_id = $userId;
        $this->env_id = $envId;
        $this->body = $requestBody;
    }
    use \AntiPatternInc\Saasus\Sdk\Auth\Runtime\Client\EndpointTrait;
    public function getMethod(): string
    {
        return 'POST';
    }
    public function getUri(): string
    {
        return str_replace(['{tenant_id}', '{user_id}', '{env_id}'], [$this->tenant_id, $this->user_id, $this->env_id], '/tenants/{tenant_id}/users/{user_id}/envs/{env_id}/roles');
    }
    public function getBody(\Symfony\Component\Serializer\SerializerInterface $serializer, $streamFactory = null): array
    {
        if ($this->body instanceof \AntiPatternInc\Saasus\Sdk\Auth\Model\CreateTenantUserRolesParam) {
            return [['Content-Type' => ['application/json']], $serializer->serialize($this->body, 'json')];
        }
        return [[], null];
    }
    public function getExtraHeaders(): array
    {
        return ['Accept' => ['application/json']];
    }
    /**
     * {@inheritdoc}
     *
     * @throws \AntiPatternInc\Saasus\Sdk\Auth\Exception\CreateTenantUserRolesInternalServerErrorException
     *
     * @return null
     */
    protected function transformResponseBody(\Psr\Http\Message\ResponseInterface $response, \Symfony\Component\Serializer\SerializerInterface $serializer, ?string $contentType = null)
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if (201 === $status) {
            return null;
        }
        if (is_null($contentType) === false && (500 === $status && mb_strpos($contentType, 'application/json') !== false)) {
            throw new \AntiPatternInc\Saasus\Sdk\Auth\Exception\CreateTenantUserRolesInternalServerErrorException($serializer->deserialize($body, 'AntiPatternInc\Saasus\Sdk\Auth\Model\Error', 'json'), $response);
        }
    }
    public function getAuthenticationScopes(): array
    {
        return ['Bearer'];
    }
}
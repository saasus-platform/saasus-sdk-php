<?php

namespace AntiPatternInc\Saasus\Sdk\Auth\Endpoint;

class UpdateTenantUser extends \AntiPatternInc\Saasus\Sdk\Auth\Runtime\Client\BaseEndpoint implements \AntiPatternInc\Saasus\Sdk\Auth\Runtime\Client\Endpoint
{
    protected $tenant_id;
    protected $user_id;
    /**
     * Update tenant user attributes.
     *
     * @param string $tenantId Tenant ID
     * @param string $userId User ID
     * @param null|\AntiPatternInc\Saasus\Sdk\Auth\Model\UpdateTenantUserParam $requestBody 
     */
    public function __construct(string $tenantId, string $userId, ?\AntiPatternInc\Saasus\Sdk\Auth\Model\UpdateTenantUserParam $requestBody = null)
    {
        $this->tenant_id = $tenantId;
        $this->user_id = $userId;
        $this->body = $requestBody;
    }
    use \AntiPatternInc\Saasus\Sdk\Auth\Runtime\Client\EndpointTrait;
    public function getMethod(): string
    {
        return 'PATCH';
    }
    public function getUri(): string
    {
        return str_replace(['{tenant_id}', '{user_id}'], [$this->tenant_id, $this->user_id], '/tenants/{tenant_id}/users/{user_id}');
    }
    public function getBody(\Symfony\Component\Serializer\SerializerInterface $serializer, $streamFactory = null): array
    {
        if ($this->body instanceof \AntiPatternInc\Saasus\Sdk\Auth\Model\UpdateTenantUserParam) {
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
     * @throws \AntiPatternInc\Saasus\Sdk\Auth\Exception\UpdateTenantUserNotFoundException
     * @throws \AntiPatternInc\Saasus\Sdk\Auth\Exception\UpdateTenantUserInternalServerErrorException
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
            throw new \AntiPatternInc\Saasus\Sdk\Auth\Exception\UpdateTenantUserNotFoundException($serializer->deserialize($body, 'AntiPatternInc\Saasus\Sdk\Auth\Model\Error', 'json'), $response);
        }
        if (is_null($contentType) === false && (500 === $status && mb_strpos($contentType, 'application/json') !== false)) {
            throw new \AntiPatternInc\Saasus\Sdk\Auth\Exception\UpdateTenantUserInternalServerErrorException($serializer->deserialize($body, 'AntiPatternInc\Saasus\Sdk\Auth\Model\Error', 'json'), $response);
        }
    }
    public function getAuthenticationScopes(): array
    {
        return ['Bearer'];
    }
}
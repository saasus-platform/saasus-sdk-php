<?php

namespace AntiPatternInc\Saasus\Sdk\Auth\Endpoint;

class SearchTenantUsers extends \AntiPatternInc\Saasus\Sdk\Auth\Runtime\Client\BaseEndpoint implements \AntiPatternInc\Saasus\Sdk\Auth\Runtime\Client\Endpoint
{
    /**
     * Search tenant users by user id, tenant id, email, sign-in ID, env, or role.
     *
     * @param array $queryParameters {
     *     @var string $tenant_id Tenant ID
     *     @var string $id User ID
     *     @var string $email Email prefix
     *     @var string $sign_in_id Sign-in ID prefix
     *     @var int $env_id Environment ID
     *     @var string $role_name Role Name
     *     @var int $limit Maximum number of items to retrieve
     *     @var string $cursor Cursor for cursor pagination
     * }
     */
    public function __construct(array $queryParameters = [])
    {
        $this->queryParameters = $queryParameters;
    }
    use \AntiPatternInc\Saasus\Sdk\Auth\Runtime\Client\EndpointTrait;
    public function getMethod() : string
    {
        return 'GET';
    }
    public function getUri() : string
    {
        return '/tenants/all/users/search';
    }
    public function getBody(\Symfony\Component\Serializer\SerializerInterface $serializer, $streamFactory = null) : array
    {
        return [[], null];
    }
    public function getExtraHeaders() : array
    {
        return ['Accept' => ['application/json']];
    }
    protected function getQueryOptionsResolver() : \Symfony\Component\OptionsResolver\OptionsResolver
    {
        $optionsResolver = parent::getQueryOptionsResolver();
        $optionsResolver->setDefined(['tenant_id', 'id', 'email', 'sign_in_id', 'env_id', 'role_name', 'limit', 'cursor']);
        $optionsResolver->setRequired([]);
        $optionsResolver->setDefaults([]);
        $optionsResolver->addAllowedTypes('tenant_id', ['string']);
        $optionsResolver->addAllowedTypes('id', ['string']);
        $optionsResolver->addAllowedTypes('email', ['string']);
        $optionsResolver->addAllowedTypes('sign_in_id', ['string']);
        $optionsResolver->addAllowedTypes('env_id', ['int']);
        $optionsResolver->addAllowedTypes('role_name', ['string']);
        $optionsResolver->addAllowedTypes('limit', ['int']);
        $optionsResolver->addAllowedTypes('cursor', ['string']);
        return $optionsResolver;
    }
    /**
     * {@inheritdoc}
     *
     * @throws \AntiPatternInc\Saasus\Sdk\Auth\Exception\SearchTenantUsersBadRequestException
     * @throws \AntiPatternInc\Saasus\Sdk\Auth\Exception\SearchTenantUsersInternalServerErrorException
     *
     * @return null|\AntiPatternInc\Saasus\Sdk\Auth\Model\SearchTenantUsersResult
     */
    protected function transformResponseBody(\Psr\Http\Message\ResponseInterface $response, \Symfony\Component\Serializer\SerializerInterface $serializer, ?string $contentType = null)
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if (is_null($contentType) === false && (200 === $status && mb_strpos($contentType, 'application/json') !== false)) {
            return $serializer->deserialize($body, 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Model\\SearchTenantUsersResult', 'json');
        }
        if (is_null($contentType) === false && (400 === $status && mb_strpos($contentType, 'application/json') !== false)) {
            throw new \AntiPatternInc\Saasus\Sdk\Auth\Exception\SearchTenantUsersBadRequestException($serializer->deserialize($body, 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Model\\Error', 'json'), $response);
        }
        if (is_null($contentType) === false && (500 === $status && mb_strpos($contentType, 'application/json') !== false)) {
            throw new \AntiPatternInc\Saasus\Sdk\Auth\Exception\SearchTenantUsersInternalServerErrorException($serializer->deserialize($body, 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Model\\Error', 'json'), $response);
        }
    }
    public function getAuthenticationScopes() : array
    {
        return ['Bearer'];
    }
}
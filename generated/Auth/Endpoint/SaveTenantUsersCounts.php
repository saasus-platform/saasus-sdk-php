<?php

namespace AntiPatternInc\Saasus\Sdk\Auth\Endpoint;

class SaveTenantUsersCounts extends \AntiPatternInc\Saasus\Sdk\Auth\Runtime\Client\BaseEndpoint implements \AntiPatternInc\Saasus\Sdk\Auth\Runtime\Client\Endpoint
{
    /**
     * Save the count of tenant users for each tenant.
     *
     * @param null|\AntiPatternInc\Saasus\Sdk\Auth\Model\SaveTenantUsersCountsParam $requestBody 
     */
    public function __construct(?\AntiPatternInc\Saasus\Sdk\Auth\Model\SaveTenantUsersCountsParam $requestBody = null)
    {
        $this->body = $requestBody;
    }
    use \AntiPatternInc\Saasus\Sdk\Auth\Runtime\Client\EndpointTrait;
    public function getMethod() : string
    {
        return 'POST';
    }
    public function getUri() : string
    {
        return '/tenants/all/users/count';
    }
    public function getBody(\Symfony\Component\Serializer\SerializerInterface $serializer, $streamFactory = null) : array
    {
        if ($this->body instanceof \AntiPatternInc\Saasus\Sdk\Auth\Model\SaveTenantUsersCountsParam) {
            return [['Content-Type' => ['application/json']], $serializer->serialize($this->body, 'json')];
        }
        return [[], null];
    }
    public function getExtraHeaders() : array
    {
        return ['Accept' => ['application/json']];
    }
    /**
     * {@inheritdoc}
     *
     * @throws \AntiPatternInc\Saasus\Sdk\Auth\Exception\SaveTenantUsersCountsBadRequestException
     * @throws \AntiPatternInc\Saasus\Sdk\Auth\Exception\SaveTenantUsersCountsInternalServerErrorException
     * @throws \AntiPatternInc\Saasus\Sdk\Auth\Exception\SaveTenantUsersCountsNotImplementedException
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
        if (is_null($contentType) === false && (400 === $status && mb_strpos($contentType, 'application/json') !== false)) {
            throw new \AntiPatternInc\Saasus\Sdk\Auth\Exception\SaveTenantUsersCountsBadRequestException($serializer->deserialize($body, 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Model\\Error', 'json'), $response);
        }
        if (is_null($contentType) === false && (500 === $status && mb_strpos($contentType, 'application/json') !== false)) {
            throw new \AntiPatternInc\Saasus\Sdk\Auth\Exception\SaveTenantUsersCountsInternalServerErrorException($serializer->deserialize($body, 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Model\\Error', 'json'), $response);
        }
        if (501 === $status) {
            throw new \AntiPatternInc\Saasus\Sdk\Auth\Exception\SaveTenantUsersCountsNotImplementedException($response);
        }
    }
    public function getAuthenticationScopes() : array
    {
        return ['Bearer'];
    }
}
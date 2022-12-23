<?php

namespace AntiPatternInc\Saasus\Sdk\Auth\Endpoint;

class UpdateTenantUser extends \AntiPatternInc\Saasus\Sdk\Auth\Runtime\Client\BaseEndpoint implements \AntiPatternInc\Saasus\Sdk\Auth\Runtime\Client\Endpoint
{
    protected $tenant_id;
    protected $user_id;
    /**
    * テナントのユーザー属性情報を更新します。
    
    Update tenant user attribute information.
    
    *
    * @param string $tenantId テナントID(Tenant ID)
    * @param string $userId ユーザーID(User ID)
    * @param null|\AntiPatternInc\Saasus\Sdk\Auth\Model\UpdateTenantUserParam $requestBody 
    */
    public function __construct(string $tenantId, string $userId, ?\AntiPatternInc\Saasus\Sdk\Auth\Model\UpdateTenantUserParam $requestBody = null)
    {
        $this->tenant_id = $tenantId;
        $this->user_id = $userId;
        $this->body = $requestBody;
    }
    use \AntiPatternInc\Saasus\Sdk\Auth\Runtime\Client\EndpointTrait;
    public function getMethod() : string
    {
        return 'PATCH';
    }
    public function getUri() : string
    {
        return str_replace(array('{tenant_id}', '{user_id}'), array($this->tenant_id, $this->user_id), '/tenants/{tenant_id}/users/{user_id}');
    }
    public function getBody(\Symfony\Component\Serializer\SerializerInterface $serializer, $streamFactory = null) : array
    {
        if ($this->body instanceof \AntiPatternInc\Saasus\Sdk\Auth\Model\UpdateTenantUserParam) {
            return array(array('Content-Type' => array('application/json')), $serializer->serialize($this->body, 'json'));
        }
        return array(array(), null);
    }
    public function getExtraHeaders() : array
    {
        return array('Accept' => array('application/json'));
    }
    /**
     * {@inheritdoc}
     *
     * @throws \AntiPatternInc\Saasus\Sdk\Auth\Exception\UpdateTenantUserNotFoundException
     * @throws \AntiPatternInc\Saasus\Sdk\Auth\Exception\UpdateTenantUserInternalServerErrorException
     *
     * @return null
     */
    protected function transformResponseBody(string $body, int $status, \Symfony\Component\Serializer\SerializerInterface $serializer, ?string $contentType = null)
    {
        if (200 === $status) {
            return null;
        }
        if (is_null($contentType) === false && (404 === $status && mb_strpos($contentType, 'application/json') !== false)) {
            throw new \AntiPatternInc\Saasus\Sdk\Auth\Exception\UpdateTenantUserNotFoundException($serializer->deserialize($body, 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Model\\Error', 'json'));
        }
        if (is_null($contentType) === false && (500 === $status && mb_strpos($contentType, 'application/json') !== false)) {
            throw new \AntiPatternInc\Saasus\Sdk\Auth\Exception\UpdateTenantUserInternalServerErrorException($serializer->deserialize($body, 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Model\\Error', 'json'));
        }
    }
    public function getAuthenticationScopes() : array
    {
        return array('Bearer');
    }
}
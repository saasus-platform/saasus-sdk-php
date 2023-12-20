<?php

namespace AntiPatternInc\Saasus\Sdk\Auth\Endpoint;

class GetTenantInvitation extends \AntiPatternInc\Saasus\Sdk\Auth\Runtime\Client\BaseEndpoint implements \AntiPatternInc\Saasus\Sdk\Auth\Runtime\Client\Endpoint
{
    protected $tenant_id;
    protected $invitation_id;
    /**
    * テナントへの招待情報を取得します。
    
    Get invitation information to the tenant.
    
    *
    * @param string $tenantId テナントID(Tenant ID)
    * @param string $invitationId 招待ID(Invitation ID)
    */
    public function __construct(string $tenantId, string $invitationId)
    {
        $this->tenant_id = $tenantId;
        $this->invitation_id = $invitationId;
    }
    use \AntiPatternInc\Saasus\Sdk\Auth\Runtime\Client\EndpointTrait;
    public function getMethod() : string
    {
        return 'GET';
    }
    public function getUri() : string
    {
        return str_replace(array('{tenant_id}', '{invitation_id}'), array($this->tenant_id, $this->invitation_id), '/tenants/{tenant_id}/invitations/{invitation_id}');
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
     * @throws \AntiPatternInc\Saasus\Sdk\Auth\Exception\GetTenantInvitationNotFoundException
     * @throws \AntiPatternInc\Saasus\Sdk\Auth\Exception\GetTenantInvitationInternalServerErrorException
     *
     * @return null|\AntiPatternInc\Saasus\Sdk\Auth\Model\Invitation
     */
    protected function transformResponseBody(string $body, int $status, \Symfony\Component\Serializer\SerializerInterface $serializer, ?string $contentType = null)
    {
        if (is_null($contentType) === false && (200 === $status && mb_strpos($contentType, 'application/json') !== false)) {
            return $serializer->deserialize($body, 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Model\\Invitation', 'json');
        }
        if (is_null($contentType) === false && (404 === $status && mb_strpos($contentType, 'application/json') !== false)) {
            throw new \AntiPatternInc\Saasus\Sdk\Auth\Exception\GetTenantInvitationNotFoundException($serializer->deserialize($body, 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Model\\Error', 'json'));
        }
        if (is_null($contentType) === false && (500 === $status && mb_strpos($contentType, 'application/json') !== false)) {
            throw new \AntiPatternInc\Saasus\Sdk\Auth\Exception\GetTenantInvitationInternalServerErrorException($serializer->deserialize($body, 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Model\\Error', 'json'));
        }
    }
    public function getAuthenticationScopes() : array
    {
        return array('Bearer');
    }
}
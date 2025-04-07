<?php

namespace AntiPatternInc\Saasus\Sdk\Auth\Endpoint;

class ValidateInvitation extends \AntiPatternInc\Saasus\Sdk\Auth\Runtime\Client\BaseEndpoint implements \AntiPatternInc\Saasus\Sdk\Auth\Runtime\Client\Endpoint
{
    protected $invitation_id;
    /**
     * Validate an invitation to the tenant.
     *
     * @param string $invitationId Invitation ID
     * @param null|\AntiPatternInc\Saasus\Sdk\Auth\Model\ValidateInvitationParam $requestBody 
     */
    public function __construct(string $invitationId, ?\AntiPatternInc\Saasus\Sdk\Auth\Model\ValidateInvitationParam $requestBody = null)
    {
        $this->invitation_id = $invitationId;
        $this->body = $requestBody;
    }
    use \AntiPatternInc\Saasus\Sdk\Auth\Runtime\Client\EndpointTrait;
    public function getMethod(): string
    {
        return 'PATCH';
    }
    public function getUri(): string
    {
        return str_replace(['{invitation_id}'], [$this->invitation_id], '/invitations/{invitation_id}/validate');
    }
    public function getBody(\Symfony\Component\Serializer\SerializerInterface $serializer, $streamFactory = null): array
    {
        if ($this->body instanceof \AntiPatternInc\Saasus\Sdk\Auth\Model\ValidateInvitationParam) {
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
     * @throws \AntiPatternInc\Saasus\Sdk\Auth\Exception\ValidateInvitationBadRequestException
     * @throws \AntiPatternInc\Saasus\Sdk\Auth\Exception\ValidateInvitationNotFoundException
     * @throws \AntiPatternInc\Saasus\Sdk\Auth\Exception\ValidateInvitationInternalServerErrorException
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
            throw new \AntiPatternInc\Saasus\Sdk\Auth\Exception\ValidateInvitationBadRequestException($serializer->deserialize($body, 'AntiPatternInc\Saasus\Sdk\Auth\Model\Error', 'json'), $response);
        }
        if (is_null($contentType) === false && (404 === $status && mb_strpos($contentType, 'application/json') !== false)) {
            throw new \AntiPatternInc\Saasus\Sdk\Auth\Exception\ValidateInvitationNotFoundException($serializer->deserialize($body, 'AntiPatternInc\Saasus\Sdk\Auth\Model\Error', 'json'), $response);
        }
        if (is_null($contentType) === false && (500 === $status && mb_strpos($contentType, 'application/json') !== false)) {
            throw new \AntiPatternInc\Saasus\Sdk\Auth\Exception\ValidateInvitationInternalServerErrorException($serializer->deserialize($body, 'AntiPatternInc\Saasus\Sdk\Auth\Model\Error', 'json'), $response);
        }
    }
    public function getAuthenticationScopes(): array
    {
        return ['Bearer'];
    }
}
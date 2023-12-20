<?php

namespace AntiPatternInc\Saasus\Sdk\Auth\Endpoint;

class RequestExternalUserLink extends \AntiPatternInc\Saasus\Sdk\Auth\Runtime\Client\BaseEndpoint implements \AntiPatternInc\Saasus\Sdk\Auth\Runtime\Client\Endpoint
{
    /**
    * 外部アカウントのユーザー連携を要求します。
    アクセストークンから連携するユーザーのメールアドレスを取得し、そのメールアドレスに対して検証コードを送信します。
    検証コードの有効期限は24時間です。
    
    Request to link an external account user.
    Get the email address of the user to be linked from the access token and send a verification code to that email address.
    The verification code is valid for 24 hours.
    
    *
    * @param null|\AntiPatternInc\Saasus\Sdk\Auth\Model\RequestExternalUserLinkParam $requestBody 
    */
    public function __construct(?\AntiPatternInc\Saasus\Sdk\Auth\Model\RequestExternalUserLinkParam $requestBody = null)
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
        return '/external-users/request';
    }
    public function getBody(\Symfony\Component\Serializer\SerializerInterface $serializer, $streamFactory = null) : array
    {
        if ($this->body instanceof \AntiPatternInc\Saasus\Sdk\Auth\Model\RequestExternalUserLinkParam) {
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
     * @throws \AntiPatternInc\Saasus\Sdk\Auth\Exception\RequestExternalUserLinkBadRequestException
     * @throws \AntiPatternInc\Saasus\Sdk\Auth\Exception\RequestExternalUserLinkInternalServerErrorException
     *
     * @return null
     */
    protected function transformResponseBody(string $body, int $status, \Symfony\Component\Serializer\SerializerInterface $serializer, ?string $contentType = null)
    {
        if (200 === $status) {
            return null;
        }
        if (is_null($contentType) === false && (400 === $status && mb_strpos($contentType, 'application/json') !== false)) {
            throw new \AntiPatternInc\Saasus\Sdk\Auth\Exception\RequestExternalUserLinkBadRequestException($serializer->deserialize($body, 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Model\\Error', 'json'));
        }
        if (is_null($contentType) === false && (500 === $status && mb_strpos($contentType, 'application/json') !== false)) {
            throw new \AntiPatternInc\Saasus\Sdk\Auth\Exception\RequestExternalUserLinkInternalServerErrorException($serializer->deserialize($body, 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Model\\Error', 'json'));
        }
    }
    public function getAuthenticationScopes() : array
    {
        return array('Bearer');
    }
}
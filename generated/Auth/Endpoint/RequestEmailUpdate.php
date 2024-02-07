<?php

namespace AntiPatternInc\Saasus\Sdk\Auth\Endpoint;

class RequestEmailUpdate extends \AntiPatternInc\Saasus\Sdk\Auth\Runtime\Client\BaseEndpoint implements \AntiPatternInc\Saasus\Sdk\Auth\Runtime\Client\Endpoint
{
    protected $user_id;
    /**
    * ユーザーのメールアドレス変更を要求します。
    要求されたメールアドレスに対して検証コードを送信します。
    ユーザーのアクセストークンが必要です。
    検証コードの有効期限は24時間です。
    
    Request to update the user's email address.
    Sends a verification code to the requested email address.
    Requires the user's access token.
    The verification code is valid for 24 hours.
    
    *
    * @param string $userId ユーザーID(User ID)
    * @param null|\AntiPatternInc\Saasus\Sdk\Auth\Model\RequestEmailUpdateParam $requestBody 
    */
    public function __construct(string $userId, ?\AntiPatternInc\Saasus\Sdk\Auth\Model\RequestEmailUpdateParam $requestBody = null)
    {
        $this->user_id = $userId;
        $this->body = $requestBody;
    }
    use \AntiPatternInc\Saasus\Sdk\Auth\Runtime\Client\EndpointTrait;
    public function getMethod() : string
    {
        return 'POST';
    }
    public function getUri() : string
    {
        return str_replace(array('{user_id}'), array($this->user_id), '/users/{user_id}/email/request');
    }
    public function getBody(\Symfony\Component\Serializer\SerializerInterface $serializer, $streamFactory = null) : array
    {
        if ($this->body instanceof \AntiPatternInc\Saasus\Sdk\Auth\Model\RequestEmailUpdateParam) {
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
     * @throws \AntiPatternInc\Saasus\Sdk\Auth\Exception\RequestEmailUpdateInternalServerErrorException
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
        if (is_null($contentType) === false && (500 === $status && mb_strpos($contentType, 'application/json') !== false)) {
            throw new \AntiPatternInc\Saasus\Sdk\Auth\Exception\RequestEmailUpdateInternalServerErrorException($serializer->deserialize($body, 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Model\\Error', 'json'), $response);
        }
    }
    public function getAuthenticationScopes() : array
    {
        return array('Bearer');
    }
}
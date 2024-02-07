<?php

namespace AntiPatternInc\Saasus\Sdk\Auth\Endpoint;

class SignUpWithAwsMarketplace extends \AntiPatternInc\Saasus\Sdk\Auth\Runtime\Client\BaseEndpoint implements \AntiPatternInc\Saasus\Sdk\Auth\Runtime\Client\Endpoint
{
    /**
    * AWS Marketplaceと連携したユーザーを新規登録します。登録されたメールアドレスに対して仮パスワードを送信します。
    Registration Tokenが有効でない場合はエラーを返却します。
    
    Register a new user linked to AWS Marketplace. A temporary password will be sent to the registered email.
    If the Registration Token is not valid, an error is returned.
    
    *
    * @param null|\AntiPatternInc\Saasus\Sdk\Auth\Model\SignUpWithAwsMarketplaceParam $requestBody 
    */
    public function __construct(?\AntiPatternInc\Saasus\Sdk\Auth\Model\SignUpWithAwsMarketplaceParam $requestBody = null)
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
        return '/aws-marketplace/sign-up';
    }
    public function getBody(\Symfony\Component\Serializer\SerializerInterface $serializer, $streamFactory = null) : array
    {
        if ($this->body instanceof \AntiPatternInc\Saasus\Sdk\Auth\Model\SignUpWithAwsMarketplaceParam) {
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
     * @throws \AntiPatternInc\Saasus\Sdk\Auth\Exception\SignUpWithAwsMarketplaceInternalServerErrorException
     *
     * @return null|\AntiPatternInc\Saasus\Sdk\Auth\Model\SaasUser
     */
    protected function transformResponseBody(\Psr\Http\Message\ResponseInterface $response, \Symfony\Component\Serializer\SerializerInterface $serializer, ?string $contentType = null)
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if (is_null($contentType) === false && (201 === $status && mb_strpos($contentType, 'application/json') !== false)) {
            return $serializer->deserialize($body, 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Model\\SaasUser', 'json');
        }
        if (is_null($contentType) === false && (500 === $status && mb_strpos($contentType, 'application/json') !== false)) {
            throw new \AntiPatternInc\Saasus\Sdk\Auth\Exception\SignUpWithAwsMarketplaceInternalServerErrorException($serializer->deserialize($body, 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Model\\Error', 'json'), $response);
        }
    }
    public function getAuthenticationScopes() : array
    {
        return array('Bearer');
    }
}
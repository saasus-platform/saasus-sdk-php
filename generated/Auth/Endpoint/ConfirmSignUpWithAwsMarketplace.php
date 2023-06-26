<?php

namespace AntiPatternInc\Saasus\Sdk\Auth\Endpoint;

class ConfirmSignUpWithAwsMarketplace extends \AntiPatternInc\Saasus\Sdk\Auth\Runtime\Client\BaseEndpoint implements \AntiPatternInc\Saasus\Sdk\Auth\Runtime\Client\Endpoint
{
    /**
    * AWS Marketplaceと連携したユーザー新規登録を確定します。AWS Marketplaceと連携したテナントを新規作成します。
    Registration Tokenが有効でない場合はエラーを返却します。
    
    Confirm a new use registeration linked to AWS Marketplace. Create a new tenant linked to AWS Marketplace.
    If the Registration Token is not valid, an error is returned.
    
    *
    * @param null|\AntiPatternInc\Saasus\Sdk\Auth\Model\ConfirmSignUpWithAwsMarketplaceParam $requestBody 
    */
    public function __construct(?\AntiPatternInc\Saasus\Sdk\Auth\Model\ConfirmSignUpWithAwsMarketplaceParam $requestBody = null)
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
        return '/aws-marketplace/sign-up-confirm';
    }
    public function getBody(\Symfony\Component\Serializer\SerializerInterface $serializer, $streamFactory = null) : array
    {
        if ($this->body instanceof \AntiPatternInc\Saasus\Sdk\Auth\Model\ConfirmSignUpWithAwsMarketplaceParam) {
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
     * @throws \AntiPatternInc\Saasus\Sdk\Auth\Exception\ConfirmSignUpWithAwsMarketplaceInternalServerErrorException
     *
     * @return null|\AntiPatternInc\Saasus\Sdk\Auth\Model\Tenant
     */
    protected function transformResponseBody(string $body, int $status, \Symfony\Component\Serializer\SerializerInterface $serializer, ?string $contentType = null)
    {
        if (is_null($contentType) === false && (201 === $status && mb_strpos($contentType, 'application/json') !== false)) {
            return $serializer->deserialize($body, 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Model\\Tenant', 'json');
        }
        if (is_null($contentType) === false && (500 === $status && mb_strpos($contentType, 'application/json') !== false)) {
            throw new \AntiPatternInc\Saasus\Sdk\Auth\Exception\ConfirmSignUpWithAwsMarketplaceInternalServerErrorException($serializer->deserialize($body, 'AntiPatternInc\\Saasus\\Sdk\\Auth\\Model\\Error', 'json'));
        }
    }
    public function getAuthenticationScopes() : array
    {
        return array('Bearer');
    }
}
<?php

namespace AntiPatternInc\Saasus\Sdk\AwsMarketplace\Endpoint;

class UpdateSettings extends \AntiPatternInc\Saasus\Sdk\AwsMarketplace\Runtime\Client\BaseEndpoint implements \AntiPatternInc\Saasus\Sdk\AwsMarketplace\Runtime\Client\Endpoint
{
    /**
    * AWS Marketplaceの設定を更新します。
    
    Update AWS Marketplace Settings.
    
    *
    * @param null|\AntiPatternInc\Saasus\Sdk\AwsMarketplace\Model\UpdateSettingsParam $requestBody 
    */
    public function __construct(?\AntiPatternInc\Saasus\Sdk\AwsMarketplace\Model\UpdateSettingsParam $requestBody = null)
    {
        $this->body = $requestBody;
    }
    use \AntiPatternInc\Saasus\Sdk\AwsMarketplace\Runtime\Client\EndpointTrait;
    public function getMethod() : string
    {
        return 'PUT';
    }
    public function getUri() : string
    {
        return '/settings';
    }
    public function getBody(\Symfony\Component\Serializer\SerializerInterface $serializer, $streamFactory = null) : array
    {
        if ($this->body instanceof \AntiPatternInc\Saasus\Sdk\AwsMarketplace\Model\UpdateSettingsParam) {
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
     * @throws \AntiPatternInc\Saasus\Sdk\AwsMarketplace\Exception\UpdateSettingsInternalServerErrorException
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
            throw new \AntiPatternInc\Saasus\Sdk\AwsMarketplace\Exception\UpdateSettingsInternalServerErrorException($serializer->deserialize($body, 'AntiPatternInc\\Saasus\\Sdk\\AwsMarketplace\\Model\\Error', 'json'), $response);
        }
    }
    public function getAuthenticationScopes() : array
    {
        return array('Bearer');
    }
}
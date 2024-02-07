<?php

namespace AntiPatternInc\Saasus\Sdk\AwsMarketplace\Endpoint;

class GetCustomers extends \AntiPatternInc\Saasus\Sdk\AwsMarketplace\Runtime\Client\BaseEndpoint implements \AntiPatternInc\Saasus\Sdk\AwsMarketplace\Runtime\Client\Endpoint
{
    /**
    * AWS Marketplaceに連携する顧客情報の一覧を取得します。
    
    Get a list of customer information to be linked to AWS Marketplace.
    
    *
    * @param array $queryParameters {
    *     @var array $tenant_ids 指定したテナントIDの顧客を取得する(Get customers with the specified tenant ID)
    * }
    */
    public function __construct(array $queryParameters = array())
    {
        $this->queryParameters = $queryParameters;
    }
    use \AntiPatternInc\Saasus\Sdk\AwsMarketplace\Runtime\Client\EndpointTrait;
    public function getMethod() : string
    {
        return 'GET';
    }
    public function getUri() : string
    {
        return '/customers';
    }
    public function getBody(\Symfony\Component\Serializer\SerializerInterface $serializer, $streamFactory = null) : array
    {
        return array(array(), null);
    }
    public function getExtraHeaders() : array
    {
        return array('Accept' => array('application/json'));
    }
    protected function getQueryOptionsResolver() : \Symfony\Component\OptionsResolver\OptionsResolver
    {
        $optionsResolver = parent::getQueryOptionsResolver();
        $optionsResolver->setDefined(array('tenant_ids'));
        $optionsResolver->setRequired(array());
        $optionsResolver->setDefaults(array());
        $optionsResolver->addAllowedTypes('tenant_ids', array('array'));
        return $optionsResolver;
    }
    /**
     * {@inheritdoc}
     *
     * @throws \AntiPatternInc\Saasus\Sdk\AwsMarketplace\Exception\GetCustomersInternalServerErrorException
     *
     * @return null|\AntiPatternInc\Saasus\Sdk\AwsMarketplace\Model\Customers
     */
    protected function transformResponseBody(\Psr\Http\Message\ResponseInterface $response, \Symfony\Component\Serializer\SerializerInterface $serializer, ?string $contentType = null)
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if (is_null($contentType) === false && (200 === $status && mb_strpos($contentType, 'application/json') !== false)) {
            return $serializer->deserialize($body, 'AntiPatternInc\\Saasus\\Sdk\\AwsMarketplace\\Model\\Customers', 'json');
        }
        if (is_null($contentType) === false && (500 === $status && mb_strpos($contentType, 'application/json') !== false)) {
            throw new \AntiPatternInc\Saasus\Sdk\AwsMarketplace\Exception\GetCustomersInternalServerErrorException($serializer->deserialize($body, 'AntiPatternInc\\Saasus\\Sdk\\AwsMarketplace\\Model\\Error', 'json'), $response);
        }
    }
    public function getAuthenticationScopes() : array
    {
        return array('Bearer');
    }
}
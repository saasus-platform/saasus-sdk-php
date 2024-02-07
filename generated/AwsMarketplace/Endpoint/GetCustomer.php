<?php

namespace AntiPatternInc\Saasus\Sdk\AwsMarketplace\Endpoint;

class GetCustomer extends \AntiPatternInc\Saasus\Sdk\AwsMarketplace\Runtime\Client\BaseEndpoint implements \AntiPatternInc\Saasus\Sdk\AwsMarketplace\Runtime\Client\Endpoint
{
    protected $customer_identifier;
    /**
    * AWS Marketplaceに連携する顧客情報を取得します。
    
    Get customer information to be linked to AWS Marketplace.
    
    *
    * @param string $customerIdentifier 顧客ID
    */
    public function __construct(string $customerIdentifier)
    {
        $this->customer_identifier = $customerIdentifier;
    }
    use \AntiPatternInc\Saasus\Sdk\AwsMarketplace\Runtime\Client\EndpointTrait;
    public function getMethod() : string
    {
        return 'GET';
    }
    public function getUri() : string
    {
        return str_replace(array('{customer_identifier}'), array($this->customer_identifier), '/customers/{customer_identifier}');
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
     * @throws \AntiPatternInc\Saasus\Sdk\AwsMarketplace\Exception\GetCustomerInternalServerErrorException
     *
     * @return null|\AntiPatternInc\Saasus\Sdk\AwsMarketplace\Model\Customer
     */
    protected function transformResponseBody(\Psr\Http\Message\ResponseInterface $response, \Symfony\Component\Serializer\SerializerInterface $serializer, ?string $contentType = null)
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if (is_null($contentType) === false && (200 === $status && mb_strpos($contentType, 'application/json') !== false)) {
            return $serializer->deserialize($body, 'AntiPatternInc\\Saasus\\Sdk\\AwsMarketplace\\Model\\Customer', 'json');
        }
        if (is_null($contentType) === false && (500 === $status && mb_strpos($contentType, 'application/json') !== false)) {
            throw new \AntiPatternInc\Saasus\Sdk\AwsMarketplace\Exception\GetCustomerInternalServerErrorException($serializer->deserialize($body, 'AntiPatternInc\\Saasus\\Sdk\\AwsMarketplace\\Model\\Error', 'json'), $response);
        }
    }
    public function getAuthenticationScopes() : array
    {
        return array('Bearer');
    }
}
<?php

namespace AntiPatternInc\Saasus\Sdk\AwsMarketplace\Endpoint;

class GetPlanByPlanName extends \AntiPatternInc\Saasus\Sdk\AwsMarketplace\Runtime\Client\BaseEndpoint implements \AntiPatternInc\Saasus\Sdk\AwsMarketplace\Runtime\Client\Endpoint
{
    protected $plan_name;
    /**
    * Marketplaceと連携するプラン情報を取得します。
    
    Obtain plan information to link to AWS Marketplace.
    
    *
    * @param string $planName AWS Marketplace連携プラン名
    */
    public function __construct(string $planName)
    {
        $this->plan_name = $planName;
    }
    use \AntiPatternInc\Saasus\Sdk\AwsMarketplace\Runtime\Client\EndpointTrait;
    public function getMethod() : string
    {
        return 'GET';
    }
    public function getUri() : string
    {
        return str_replace(array('{plan_name}'), array($this->plan_name), '/plans/{plan_name}');
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
     * @throws \AntiPatternInc\Saasus\Sdk\AwsMarketplace\Exception\GetPlanByPlanNameInternalServerErrorException
     *
     * @return null|\AntiPatternInc\Saasus\Sdk\AwsMarketplace\Model\Plan
     */
    protected function transformResponseBody(\Psr\Http\Message\ResponseInterface $response, \Symfony\Component\Serializer\SerializerInterface $serializer, ?string $contentType = null)
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if (is_null($contentType) === false && (200 === $status && mb_strpos($contentType, 'application/json') !== false)) {
            return $serializer->deserialize($body, 'AntiPatternInc\\Saasus\\Sdk\\AwsMarketplace\\Model\\Plan', 'json');
        }
        if (is_null($contentType) === false && (500 === $status && mb_strpos($contentType, 'application/json') !== false)) {
            throw new \AntiPatternInc\Saasus\Sdk\AwsMarketplace\Exception\GetPlanByPlanNameInternalServerErrorException($serializer->deserialize($body, 'AntiPatternInc\\Saasus\\Sdk\\AwsMarketplace\\Model\\Error', 'json'), $response);
        }
    }
    public function getAuthenticationScopes() : array
    {
        return array('Bearer');
    }
}
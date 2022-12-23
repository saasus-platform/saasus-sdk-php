<?php

namespace AntiPatternInc\Saasus\Sdk\Billing\Endpoint;

class UpdateStripeInfo extends \AntiPatternInc\Saasus\Sdk\Billing\Runtime\Client\BaseEndpoint implements \AntiPatternInc\Saasus\Sdk\Billing\Runtime\Client\Endpoint
{
    /**
    * 請求業務で使う外部SaaSとの連携情報を更新します。
    現在は Stripe と連携が可能です。
    
    Updates information on linkage with external SaaS used in billing operations.
    Currently, it is possible to linkage with Stripe.
    
    *
    * @param null|\AntiPatternInc\Saasus\Sdk\Billing\Model\UpdateStripeInfoParam $requestBody 
    */
    public function __construct(?\AntiPatternInc\Saasus\Sdk\Billing\Model\UpdateStripeInfoParam $requestBody = null)
    {
        $this->body = $requestBody;
    }
    use \AntiPatternInc\Saasus\Sdk\Billing\Runtime\Client\EndpointTrait;
    public function getMethod() : string
    {
        return 'PUT';
    }
    public function getUri() : string
    {
        return '/stripe/info';
    }
    public function getBody(\Symfony\Component\Serializer\SerializerInterface $serializer, $streamFactory = null) : array
    {
        if ($this->body instanceof \AntiPatternInc\Saasus\Sdk\Billing\Model\UpdateStripeInfoParam) {
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
     * @throws \AntiPatternInc\Saasus\Sdk\Billing\Exception\UpdateStripeInfoInternalServerErrorException
     *
     * @return null
     */
    protected function transformResponseBody(string $body, int $status, \Symfony\Component\Serializer\SerializerInterface $serializer, ?string $contentType = null)
    {
        if (200 === $status) {
            return null;
        }
        if (is_null($contentType) === false && (500 === $status && mb_strpos($contentType, 'application/json') !== false)) {
            throw new \AntiPatternInc\Saasus\Sdk\Billing\Exception\UpdateStripeInfoInternalServerErrorException($serializer->deserialize($body, 'AntiPatternInc\\Saasus\\Sdk\\Billing\\Model\\Error', 'json'));
        }
    }
    public function getAuthenticationScopes() : array
    {
        return array('Bearer');
    }
}
<?php

namespace AntiPatternInc\Saasus\Sdk\Pricing\Endpoint;

class CreatePricingPlan extends \AntiPatternInc\Saasus\Sdk\Pricing\Runtime\Client\BaseEndpoint implements \AntiPatternInc\Saasus\Sdk\Pricing\Runtime\Client\Endpoint
{
    /**
    * 料金プランを作成します。
    
    Create pricing plan.
    
    *
    * @param null|\stdClass $requestBody 
    */
    public function __construct(?\stdClass $requestBody = null)
    {
        $this->body = $requestBody;
    }
    use \AntiPatternInc\Saasus\Sdk\Pricing\Runtime\Client\EndpointTrait;
    public function getMethod() : string
    {
        return 'POST';
    }
    public function getUri() : string
    {
        return '/plans';
    }
    public function getBody(\Symfony\Component\Serializer\SerializerInterface $serializer, $streamFactory = null) : array
    {
        if ($this->body instanceof \stdClass) {
            return array(array('Content-Type' => array('application/json')), json_encode($this->body));
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
     * @throws \AntiPatternInc\Saasus\Sdk\Pricing\Exception\CreatePricingPlanInternalServerErrorException
     *
     * @return null|\AntiPatternInc\Saasus\Sdk\Pricing\Model\PricingPlan
     */
    protected function transformResponseBody(\Psr\Http\Message\ResponseInterface $response, \Symfony\Component\Serializer\SerializerInterface $serializer, ?string $contentType = null)
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if (is_null($contentType) === false && (201 === $status && mb_strpos($contentType, 'application/json') !== false)) {
            return $serializer->deserialize($body, 'AntiPatternInc\\Saasus\\Sdk\\Pricing\\Model\\PricingPlan', 'json');
        }
        if (is_null($contentType) === false && (500 === $status && mb_strpos($contentType, 'application/json') !== false)) {
            throw new \AntiPatternInc\Saasus\Sdk\Pricing\Exception\CreatePricingPlanInternalServerErrorException($serializer->deserialize($body, 'AntiPatternInc\\Saasus\\Sdk\\Pricing\\Model\\Error', 'json'), $response);
        }
    }
    public function getAuthenticationScopes() : array
    {
        return array('Bearer');
    }
}
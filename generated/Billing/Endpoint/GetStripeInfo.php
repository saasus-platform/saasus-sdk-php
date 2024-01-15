<?php

namespace AntiPatternInc\Saasus\Sdk\Billing\Endpoint;

class GetStripeInfo extends \AntiPatternInc\Saasus\Sdk\Billing\Runtime\Client\BaseEndpoint implements \AntiPatternInc\Saasus\Sdk\Billing\Runtime\Client\Endpoint
{
    use \AntiPatternInc\Saasus\Sdk\Billing\Runtime\Client\EndpointTrait;
    public function getMethod() : string
    {
        return 'GET';
    }
    public function getUri() : string
    {
        return '/stripe/info';
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
     * @throws \AntiPatternInc\Saasus\Sdk\Billing\Exception\GetStripeInfoInternalServerErrorException
     *
     * @return null|\AntiPatternInc\Saasus\Sdk\Billing\Model\StripeInfo
     */
    protected function transformResponseBody(\Psr\Http\Message\ResponseInterface $response, \Symfony\Component\Serializer\SerializerInterface $serializer, ?string $contentType = null)
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if (is_null($contentType) === false && (200 === $status && mb_strpos($contentType, 'application/json') !== false)) {
            return $serializer->deserialize($body, 'AntiPatternInc\\Saasus\\Sdk\\Billing\\Model\\StripeInfo', 'json');
        }
        if (is_null($contentType) === false && (500 === $status && mb_strpos($contentType, 'application/json') !== false)) {
            throw new \AntiPatternInc\Saasus\Sdk\Billing\Exception\GetStripeInfoInternalServerErrorException($serializer->deserialize($body, 'AntiPatternInc\\Saasus\\Sdk\\Billing\\Model\\Error', 'json'), $response);
        }
    }
    public function getAuthenticationScopes() : array
    {
        return array('Bearer');
    }
}
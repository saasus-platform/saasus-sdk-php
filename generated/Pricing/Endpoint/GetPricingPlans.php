<?php

namespace AntiPatternInc\Saasus\Sdk\Pricing\Endpoint;

class GetPricingPlans extends \AntiPatternInc\Saasus\Sdk\Pricing\Runtime\Client\BaseEndpoint implements \AntiPatternInc\Saasus\Sdk\Pricing\Runtime\Client\Endpoint
{
    use \AntiPatternInc\Saasus\Sdk\Pricing\Runtime\Client\EndpointTrait;
    public function getMethod(): string
    {
        return 'GET';
    }
    public function getUri(): string
    {
        return '/plans';
    }
    public function getBody(\Symfony\Component\Serializer\SerializerInterface $serializer, $streamFactory = null): array
    {
        return [[], null];
    }
    public function getExtraHeaders(): array
    {
        return ['Accept' => ['application/json']];
    }
    /**
     * {@inheritdoc}
     *
     * @throws \AntiPatternInc\Saasus\Sdk\Pricing\Exception\GetPricingPlansInternalServerErrorException
     *
     * @return null|\AntiPatternInc\Saasus\Sdk\Pricing\Model\PricingPlans
     */
    protected function transformResponseBody(\Psr\Http\Message\ResponseInterface $response, \Symfony\Component\Serializer\SerializerInterface $serializer, ?string $contentType = null)
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if (is_null($contentType) === false && (200 === $status && mb_strpos($contentType, 'application/json') !== false)) {
            return $serializer->deserialize($body, 'AntiPatternInc\Saasus\Sdk\Pricing\Model\PricingPlans', 'json');
        }
        if (is_null($contentType) === false && (500 === $status && mb_strpos($contentType, 'application/json') !== false)) {
            throw new \AntiPatternInc\Saasus\Sdk\Pricing\Exception\GetPricingPlansInternalServerErrorException($serializer->deserialize($body, 'AntiPatternInc\Saasus\Sdk\Pricing\Model\Error', 'json'), $response);
        }
    }
    public function getAuthenticationScopes(): array
    {
        return ['Bearer'];
    }
}
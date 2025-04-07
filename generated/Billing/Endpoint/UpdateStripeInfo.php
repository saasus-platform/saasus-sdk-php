<?php

namespace AntiPatternInc\Saasus\Sdk\Billing\Endpoint;

class UpdateStripeInfo extends \AntiPatternInc\Saasus\Sdk\Billing\Runtime\Client\BaseEndpoint implements \AntiPatternInc\Saasus\Sdk\Billing\Runtime\Client\Endpoint
{
    /**
    * Updates information on connection with external billing SaaS.
    Currently possible to connect to Stripe.
    
    *
    * @param null|\AntiPatternInc\Saasus\Sdk\Billing\Model\UpdateStripeInfoParam $requestBody 
    */
    public function __construct(?\AntiPatternInc\Saasus\Sdk\Billing\Model\UpdateStripeInfoParam $requestBody = null)
    {
        $this->body = $requestBody;
    }
    use \AntiPatternInc\Saasus\Sdk\Billing\Runtime\Client\EndpointTrait;
    public function getMethod(): string
    {
        return 'PUT';
    }
    public function getUri(): string
    {
        return '/stripe/info';
    }
    public function getBody(\Symfony\Component\Serializer\SerializerInterface $serializer, $streamFactory = null): array
    {
        if ($this->body instanceof \AntiPatternInc\Saasus\Sdk\Billing\Model\UpdateStripeInfoParam) {
            return [['Content-Type' => ['application/json']], $serializer->serialize($this->body, 'json')];
        }
        return [[], null];
    }
    public function getExtraHeaders(): array
    {
        return ['Accept' => ['application/json']];
    }
    /**
     * {@inheritdoc}
     *
     * @throws \AntiPatternInc\Saasus\Sdk\Billing\Exception\UpdateStripeInfoInternalServerErrorException
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
            throw new \AntiPatternInc\Saasus\Sdk\Billing\Exception\UpdateStripeInfoInternalServerErrorException($serializer->deserialize($body, 'AntiPatternInc\Saasus\Sdk\Billing\Model\Error', 'json'), $response);
        }
    }
    public function getAuthenticationScopes(): array
    {
        return ['Bearer'];
    }
}
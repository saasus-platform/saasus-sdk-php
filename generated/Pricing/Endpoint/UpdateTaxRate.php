<?php

namespace AntiPatternInc\Saasus\Sdk\Pricing\Endpoint;

class UpdateTaxRate extends \AntiPatternInc\Saasus\Sdk\Pricing\Runtime\Client\BaseEndpoint implements \AntiPatternInc\Saasus\Sdk\Pricing\Runtime\Client\Endpoint
{
    protected $tax_rate_id;
    /**
     * Update tax rate.
     *
     * @param string $taxRateId Tax Rate ID
     * @param null|\AntiPatternInc\Saasus\Sdk\Pricing\Model\UpdateTaxRateParam $requestBody 
     */
    public function __construct(string $taxRateId, ?\AntiPatternInc\Saasus\Sdk\Pricing\Model\UpdateTaxRateParam $requestBody = null)
    {
        $this->tax_rate_id = $taxRateId;
        $this->body = $requestBody;
    }
    use \AntiPatternInc\Saasus\Sdk\Pricing\Runtime\Client\EndpointTrait;
    public function getMethod(): string
    {
        return 'PATCH';
    }
    public function getUri(): string
    {
        return str_replace(['{tax_rate_id}'], [$this->tax_rate_id], '/tax-rates/{tax_rate_id}');
    }
    public function getBody(\Symfony\Component\Serializer\SerializerInterface $serializer, $streamFactory = null): array
    {
        if ($this->body instanceof \AntiPatternInc\Saasus\Sdk\Pricing\Model\UpdateTaxRateParam) {
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
     * @throws \AntiPatternInc\Saasus\Sdk\Pricing\Exception\UpdateTaxRateBadRequestException
     * @throws \AntiPatternInc\Saasus\Sdk\Pricing\Exception\UpdateTaxRateInternalServerErrorException
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
        if (is_null($contentType) === false && (400 === $status && mb_strpos($contentType, 'application/json') !== false)) {
            throw new \AntiPatternInc\Saasus\Sdk\Pricing\Exception\UpdateTaxRateBadRequestException($serializer->deserialize($body, 'AntiPatternInc\Saasus\Sdk\Pricing\Model\Error', 'json'), $response);
        }
        if (is_null($contentType) === false && (500 === $status && mb_strpos($contentType, 'application/json') !== false)) {
            throw new \AntiPatternInc\Saasus\Sdk\Pricing\Exception\UpdateTaxRateInternalServerErrorException($serializer->deserialize($body, 'AntiPatternInc\Saasus\Sdk\Pricing\Model\Error', 'json'), $response);
        }
    }
    public function getAuthenticationScopes(): array
    {
        return ['Bearer'];
    }
}
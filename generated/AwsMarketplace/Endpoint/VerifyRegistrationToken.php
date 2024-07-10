<?php

namespace AntiPatternInc\Saasus\Sdk\AwsMarketplace\Endpoint;

class VerifyRegistrationToken extends \AntiPatternInc\Saasus\Sdk\AwsMarketplace\Runtime\Client\BaseEndpoint implements \AntiPatternInc\Saasus\Sdk\AwsMarketplace\Runtime\Client\Endpoint
{
    /**
     * Verify Registration Token.
     *
     * @param null|\AntiPatternInc\Saasus\Sdk\AwsMarketplace\Model\VerifyRegistrationTokenParam $requestBody 
     */
    public function __construct(?\AntiPatternInc\Saasus\Sdk\AwsMarketplace\Model\VerifyRegistrationTokenParam $requestBody = null)
    {
        $this->body = $requestBody;
    }
    use \AntiPatternInc\Saasus\Sdk\AwsMarketplace\Runtime\Client\EndpointTrait;
    public function getMethod(): string
    {
        return 'POST';
    }
    public function getUri(): string
    {
        return '/registration-token/verify';
    }
    public function getBody(\Symfony\Component\Serializer\SerializerInterface $serializer, $streamFactory = null): array
    {
        if ($this->body instanceof \AntiPatternInc\Saasus\Sdk\AwsMarketplace\Model\VerifyRegistrationTokenParam) {
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
     * @throws \AntiPatternInc\Saasus\Sdk\AwsMarketplace\Exception\VerifyRegistrationTokenBadRequestException
     * @throws \AntiPatternInc\Saasus\Sdk\AwsMarketplace\Exception\VerifyRegistrationTokenInternalServerErrorException
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
            throw new \AntiPatternInc\Saasus\Sdk\AwsMarketplace\Exception\VerifyRegistrationTokenBadRequestException($serializer->deserialize($body, 'AntiPatternInc\Saasus\Sdk\AwsMarketplace\Model\Error', 'json'), $response);
        }
        if (is_null($contentType) === false && (500 === $status && mb_strpos($contentType, 'application/json') !== false)) {
            throw new \AntiPatternInc\Saasus\Sdk\AwsMarketplace\Exception\VerifyRegistrationTokenInternalServerErrorException($serializer->deserialize($body, 'AntiPatternInc\Saasus\Sdk\AwsMarketplace\Model\Error', 'json'), $response);
        }
    }
    public function getAuthenticationScopes(): array
    {
        return ['Bearer'];
    }
}
<?php

namespace AntiPatternInc\Saasus\Sdk\AwsMarketplace\Endpoint;

class GetSettings extends \AntiPatternInc\Saasus\Sdk\AwsMarketplace\Runtime\Client\BaseEndpoint implements \AntiPatternInc\Saasus\Sdk\AwsMarketplace\Runtime\Client\Endpoint
{
    use \AntiPatternInc\Saasus\Sdk\AwsMarketplace\Runtime\Client\EndpointTrait;
    public function getMethod(): string
    {
        return 'GET';
    }
    public function getUri(): string
    {
        return '/settings';
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
     * @throws \AntiPatternInc\Saasus\Sdk\AwsMarketplace\Exception\GetSettingsInternalServerErrorException
     *
     * @return null|\AntiPatternInc\Saasus\Sdk\AwsMarketplace\Model\Settings
     */
    protected function transformResponseBody(\Psr\Http\Message\ResponseInterface $response, \Symfony\Component\Serializer\SerializerInterface $serializer, ?string $contentType = null)
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if (is_null($contentType) === false && (200 === $status && mb_strpos($contentType, 'application/json') !== false)) {
            return $serializer->deserialize($body, 'AntiPatternInc\Saasus\Sdk\AwsMarketplace\Model\Settings', 'json');
        }
        if (is_null($contentType) === false && (500 === $status && mb_strpos($contentType, 'application/json') !== false)) {
            throw new \AntiPatternInc\Saasus\Sdk\AwsMarketplace\Exception\GetSettingsInternalServerErrorException($serializer->deserialize($body, 'AntiPatternInc\Saasus\Sdk\AwsMarketplace\Model\Error', 'json'), $response);
        }
    }
    public function getAuthenticationScopes(): array
    {
        return ['Bearer'];
    }
}
<?php

namespace AntiPatternInc\Saasus\Sdk\Integration\Endpoint;

class DeleteEventBridgeSettings extends \AntiPatternInc\Saasus\Sdk\Integration\Runtime\Client\BaseEndpoint implements \AntiPatternInc\Saasus\Sdk\Integration\Runtime\Client\Endpoint
{
    use \AntiPatternInc\Saasus\Sdk\Integration\Runtime\Client\EndpointTrait;
    public function getMethod(): string
    {
        return 'DELETE';
    }
    public function getUri(): string
    {
        return '/eventbridge/info';
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
     * @throws \AntiPatternInc\Saasus\Sdk\Integration\Exception\DeleteEventBridgeSettingsInternalServerErrorException
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
            throw new \AntiPatternInc\Saasus\Sdk\Integration\Exception\DeleteEventBridgeSettingsInternalServerErrorException($serializer->deserialize($body, 'AntiPatternInc\Saasus\Sdk\Integration\Model\Error', 'json'), $response);
        }
    }
    public function getAuthenticationScopes(): array
    {
        return ['Bearer'];
    }
}
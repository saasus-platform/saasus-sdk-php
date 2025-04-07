<?php

namespace AntiPatternInc\Saasus\Sdk\Integration\Endpoint;

class CreateEventBridgeEvent extends \AntiPatternInc\Saasus\Sdk\Integration\Runtime\Client\BaseEndpoint implements \AntiPatternInc\Saasus\Sdk\Integration\Runtime\Client\Endpoint
{
    /**
     * Send events to Amazon EventBridge.
     *
     * @param null|\AntiPatternInc\Saasus\Sdk\Integration\Model\CreateEventBridgeEventParam $requestBody 
     */
    public function __construct(?\AntiPatternInc\Saasus\Sdk\Integration\Model\CreateEventBridgeEventParam $requestBody = null)
    {
        $this->body = $requestBody;
    }
    use \AntiPatternInc\Saasus\Sdk\Integration\Runtime\Client\EndpointTrait;
    public function getMethod(): string
    {
        return 'POST';
    }
    public function getUri(): string
    {
        return '/eventbridge/event';
    }
    public function getBody(\Symfony\Component\Serializer\SerializerInterface $serializer, $streamFactory = null): array
    {
        if ($this->body instanceof \AntiPatternInc\Saasus\Sdk\Integration\Model\CreateEventBridgeEventParam) {
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
     * @throws \AntiPatternInc\Saasus\Sdk\Integration\Exception\CreateEventBridgeEventInternalServerErrorException
     *
     * @return null
     */
    protected function transformResponseBody(\Psr\Http\Message\ResponseInterface $response, \Symfony\Component\Serializer\SerializerInterface $serializer, ?string $contentType = null)
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if (201 === $status) {
            return null;
        }
        if (is_null($contentType) === false && (500 === $status && mb_strpos($contentType, 'application/json') !== false)) {
            throw new \AntiPatternInc\Saasus\Sdk\Integration\Exception\CreateEventBridgeEventInternalServerErrorException($serializer->deserialize($body, 'AntiPatternInc\Saasus\Sdk\Integration\Model\Error', 'json'), $response);
        }
    }
    public function getAuthenticationScopes(): array
    {
        return ['Bearer'];
    }
}
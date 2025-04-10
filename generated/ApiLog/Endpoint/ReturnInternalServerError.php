<?php

namespace AntiPatternInc\Saasus\Sdk\ApiLog\Endpoint;

class ReturnInternalServerError extends \AntiPatternInc\Saasus\Sdk\ApiLog\Runtime\Client\BaseEndpoint implements \AntiPatternInc\Saasus\Sdk\ApiLog\Runtime\Client\Endpoint
{
    use \AntiPatternInc\Saasus\Sdk\ApiLog\Runtime\Client\EndpointTrait;
    public function getMethod(): string
    {
        return 'GET';
    }
    public function getUri(): string
    {
        return '/errors/internal-server-error';
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
     * @throws \AntiPatternInc\Saasus\Sdk\ApiLog\Exception\ReturnInternalServerErrorInternalServerErrorException
     *
     * @return null
     */
    protected function transformResponseBody(\Psr\Http\Message\ResponseInterface $response, \Symfony\Component\Serializer\SerializerInterface $serializer, ?string $contentType = null)
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if (is_null($contentType) === false && (500 === $status && mb_strpos($contentType, 'application/json') !== false)) {
            throw new \AntiPatternInc\Saasus\Sdk\ApiLog\Exception\ReturnInternalServerErrorInternalServerErrorException($serializer->deserialize($body, 'AntiPatternInc\Saasus\Sdk\ApiLog\Model\Error', 'json'), $response);
        }
    }
    public function getAuthenticationScopes(): array
    {
        return ['Bearer'];
    }
}
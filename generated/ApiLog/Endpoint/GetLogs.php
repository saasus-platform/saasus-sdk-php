<?php

namespace AntiPatternInc\Saasus\Sdk\ApiLog\Endpoint;

class GetLogs extends \AntiPatternInc\Saasus\Sdk\ApiLog\Runtime\Client\BaseEndpoint implements \AntiPatternInc\Saasus\Sdk\ApiLog\Runtime\Client\Endpoint
{
    /**
     * Retrieve the log of all API executions.
     *
     * @param array $queryParameters {
     *     @var string $created_date The date, in format of YYYY-MM-DD, to retrieve the log.
     *     @var string $created_at The datetime, in ISO 8601 format, to retrieve the log.
     *     @var int $limit Maximum number of logs to retrieve.
     *     @var string $cursor Cursor for cursor pagination.
     * }
     */
    public function __construct(array $queryParameters = [])
    {
        $this->queryParameters = $queryParameters;
    }
    use \AntiPatternInc\Saasus\Sdk\ApiLog\Runtime\Client\EndpointTrait;
    public function getMethod(): string
    {
        return 'GET';
    }
    public function getUri(): string
    {
        return '/logs';
    }
    public function getBody(\Symfony\Component\Serializer\SerializerInterface $serializer, $streamFactory = null): array
    {
        return [[], null];
    }
    public function getExtraHeaders(): array
    {
        return ['Accept' => ['application/json']];
    }
    protected function getQueryOptionsResolver(): \Symfony\Component\OptionsResolver\OptionsResolver
    {
        $optionsResolver = parent::getQueryOptionsResolver();
        $optionsResolver->setDefined(['created_date', 'created_at', 'limit', 'cursor']);
        $optionsResolver->setRequired([]);
        $optionsResolver->setDefaults([]);
        $optionsResolver->addAllowedTypes('created_date', ['string']);
        $optionsResolver->addAllowedTypes('created_at', ['string']);
        $optionsResolver->addAllowedTypes('limit', ['int']);
        $optionsResolver->addAllowedTypes('cursor', ['string']);
        return $optionsResolver;
    }
    /**
     * {@inheritdoc}
     *
     * @throws \AntiPatternInc\Saasus\Sdk\ApiLog\Exception\GetLogsInternalServerErrorException
     *
     * @return null|\AntiPatternInc\Saasus\Sdk\ApiLog\Model\ApiLogs
     */
    protected function transformResponseBody(\Psr\Http\Message\ResponseInterface $response, \Symfony\Component\Serializer\SerializerInterface $serializer, ?string $contentType = null)
    {
        $status = $response->getStatusCode();
        $body = (string) $response->getBody();
        if (is_null($contentType) === false && (200 === $status && mb_strpos($contentType, 'application/json') !== false)) {
            return $serializer->deserialize($body, 'AntiPatternInc\Saasus\Sdk\ApiLog\Model\ApiLogs', 'json');
        }
        if (is_null($contentType) === false && (500 === $status && mb_strpos($contentType, 'application/json') !== false)) {
            throw new \AntiPatternInc\Saasus\Sdk\ApiLog\Exception\GetLogsInternalServerErrorException($serializer->deserialize($body, 'AntiPatternInc\Saasus\Sdk\ApiLog\Model\Error', 'json'), $response);
        }
    }
    public function getAuthenticationScopes(): array
    {
        return ['Bearer'];
    }
}
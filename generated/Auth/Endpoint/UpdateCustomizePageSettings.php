<?php

namespace AntiPatternInc\Saasus\Sdk\Auth\Endpoint;

class UpdateCustomizePageSettings extends \AntiPatternInc\Saasus\Sdk\Auth\Runtime\Client\BaseEndpoint implements \AntiPatternInc\Saasus\Sdk\Auth\Runtime\Client\Endpoint
{
    /**
     * Update authentication authorization basic information.
     *
     * @param null|\AntiPatternInc\Saasus\Sdk\Auth\Model\UpdateCustomizePageSettingsParam $requestBody 
     */
    public function __construct(?\AntiPatternInc\Saasus\Sdk\Auth\Model\UpdateCustomizePageSettingsParam $requestBody = null)
    {
        $this->body = $requestBody;
    }
    use \AntiPatternInc\Saasus\Sdk\Auth\Runtime\Client\EndpointTrait;
    public function getMethod(): string
    {
        return 'PATCH';
    }
    public function getUri(): string
    {
        return '/customize-page-settings';
    }
    public function getBody(\Symfony\Component\Serializer\SerializerInterface $serializer, $streamFactory = null): array
    {
        if ($this->body instanceof \AntiPatternInc\Saasus\Sdk\Auth\Model\UpdateCustomizePageSettingsParam) {
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
     * @throws \AntiPatternInc\Saasus\Sdk\Auth\Exception\UpdateCustomizePageSettingsInternalServerErrorException
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
            throw new \AntiPatternInc\Saasus\Sdk\Auth\Exception\UpdateCustomizePageSettingsInternalServerErrorException($serializer->deserialize($body, 'AntiPatternInc\Saasus\Sdk\Auth\Model\Error', 'json'), $response);
        }
    }
    public function getAuthenticationScopes(): array
    {
        return ['Bearer'];
    }
}
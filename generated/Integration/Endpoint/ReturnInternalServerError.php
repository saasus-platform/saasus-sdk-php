<?php

namespace AntiPatternInc\Saasus\Sdk\Integration\Endpoint;

class ReturnInternalServerError extends \AntiPatternInc\Saasus\Sdk\Integration\Runtime\Client\BaseEndpoint implements \AntiPatternInc\Saasus\Sdk\Integration\Runtime\Client\Endpoint
{
    use \AntiPatternInc\Saasus\Sdk\Integration\Runtime\Client\EndpointTrait;
    public function getMethod() : string
    {
        return 'GET';
    }
    public function getUri() : string
    {
        return '/errors/internal-server-error';
    }
    public function getBody(\Symfony\Component\Serializer\SerializerInterface $serializer, $streamFactory = null) : array
    {
        return array(array(), null);
    }
    public function getExtraHeaders() : array
    {
        return array('Accept' => array('application/json'));
    }
    /**
     * {@inheritdoc}
     *
     * @throws \AntiPatternInc\Saasus\Sdk\Integration\Exception\ReturnInternalServerErrorInternalServerErrorException
     *
     * @return null
     */
    protected function transformResponseBody(string $body, int $status, \Symfony\Component\Serializer\SerializerInterface $serializer, ?string $contentType = null)
    {
        if (is_null($contentType) === false && (500 === $status && mb_strpos($contentType, 'application/json') !== false)) {
            throw new \AntiPatternInc\Saasus\Sdk\Integration\Exception\ReturnInternalServerErrorInternalServerErrorException($serializer->deserialize($body, 'AntiPatternInc\\Saasus\\Sdk\\Integration\\Model\\Error', 'json'));
        }
    }
    public function getAuthenticationScopes() : array
    {
        return array('Bearer');
    }
}
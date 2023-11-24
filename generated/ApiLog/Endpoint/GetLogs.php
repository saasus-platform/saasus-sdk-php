<?php

namespace AntiPatternInc\Saasus\Sdk\ApiLog\Endpoint;

class GetLogs extends \AntiPatternInc\Saasus\Sdk\ApiLog\Runtime\Client\BaseEndpoint implements \AntiPatternInc\Saasus\Sdk\ApiLog\Runtime\Client\Endpoint
{
    use \AntiPatternInc\Saasus\Sdk\ApiLog\Runtime\Client\EndpointTrait;
    public function getMethod() : string
    {
        return 'GET';
    }
    public function getUri() : string
    {
        return '/logs';
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
     * @throws \AntiPatternInc\Saasus\Sdk\ApiLog\Exception\GetLogsInternalServerErrorException
     *
     * @return null|\AntiPatternInc\Saasus\Sdk\ApiLog\Model\ApiLogs
     */
    protected function transformResponseBody(string $body, int $status, \Symfony\Component\Serializer\SerializerInterface $serializer, ?string $contentType = null)
    {
        if (is_null($contentType) === false && (200 === $status && mb_strpos($contentType, 'application/json') !== false)) {
            return $serializer->deserialize($body, 'AntiPatternInc\\Saasus\\Sdk\\ApiLog\\Model\\ApiLogs', 'json');
        }
        if (is_null($contentType) === false && (500 === $status && mb_strpos($contentType, 'application/json') !== false)) {
            throw new \AntiPatternInc\Saasus\Sdk\ApiLog\Exception\GetLogsInternalServerErrorException($serializer->deserialize($body, 'AntiPatternInc\\Saasus\\Sdk\\ApiLog\\Model\\Error', 'json'));
        }
    }
    public function getAuthenticationScopes() : array
    {
        return array('Bearer');
    }
}
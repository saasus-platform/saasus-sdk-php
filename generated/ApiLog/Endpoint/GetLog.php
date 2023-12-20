<?php

namespace AntiPatternInc\Saasus\Sdk\ApiLog\Endpoint;

class GetLog extends \AntiPatternInc\Saasus\Sdk\ApiLog\Runtime\Client\BaseEndpoint implements \AntiPatternInc\Saasus\Sdk\ApiLog\Runtime\Client\Endpoint
{
    protected $api_log_id;
    /**
     * 指定したIDのAPI実行のログ登録を取得します。
     *
     * @param string $apiLogId APIログID(API Log ID)
     */
    public function __construct(string $apiLogId)
    {
        $this->api_log_id = $apiLogId;
    }
    use \AntiPatternInc\Saasus\Sdk\ApiLog\Runtime\Client\EndpointTrait;
    public function getMethod() : string
    {
        return 'GET';
    }
    public function getUri() : string
    {
        return str_replace(array('{api_log_id}'), array($this->api_log_id), '/logs/{api_log_id}');
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
     * @throws \AntiPatternInc\Saasus\Sdk\ApiLog\Exception\GetLogInternalServerErrorException
     *
     * @return null
     */
    protected function transformResponseBody(string $body, int $status, \Symfony\Component\Serializer\SerializerInterface $serializer, ?string $contentType = null)
    {
        if (is_null($contentType) === false && (200 === $status && mb_strpos($contentType, 'application/json') !== false)) {
            return json_decode($body);
        }
        if (is_null($contentType) === false && (500 === $status && mb_strpos($contentType, 'application/json') !== false)) {
            throw new \AntiPatternInc\Saasus\Sdk\ApiLog\Exception\GetLogInternalServerErrorException($serializer->deserialize($body, 'AntiPatternInc\\Saasus\\Sdk\\ApiLog\\Model\\Error', 'json'));
        }
    }
    public function getAuthenticationScopes() : array
    {
        return array('Bearer');
    }
}
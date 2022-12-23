<?php

namespace AntiPatternInc\Saasus\Sdk\Integration\Endpoint;

class SaveEventBridgeSettings extends \AntiPatternInc\Saasus\Sdk\Integration\Runtime\Client\BaseEndpoint implements \AntiPatternInc\Saasus\Sdk\Integration\Runtime\Client\Endpoint
{
    /**
    * ホストの状態を Amazon EventBridge 経由で提供するための設定を更新します。
    
    Update the configuration to provide host state via Amazon EventBridge.
    
    *
    * @param null|\stdClass $requestBody 
    */
    public function __construct(?\stdClass $requestBody = null)
    {
        $this->body = $requestBody;
    }
    use \AntiPatternInc\Saasus\Sdk\Integration\Runtime\Client\EndpointTrait;
    public function getMethod() : string
    {
        return 'PUT';
    }
    public function getUri() : string
    {
        return '/eventbridge/info';
    }
    public function getBody(\Symfony\Component\Serializer\SerializerInterface $serializer, $streamFactory = null) : array
    {
        if ($this->body instanceof \stdClass) {
            return array(array('Content-Type' => array('application/json')), json_encode($this->body));
        }
        return array(array(), null);
    }
    public function getExtraHeaders() : array
    {
        return array('Accept' => array('application/json'));
    }
    /**
     * {@inheritdoc}
     *
     * @throws \AntiPatternInc\Saasus\Sdk\Integration\Exception\SaveEventBridgeSettingsInternalServerErrorException
     *
     * @return null
     */
    protected function transformResponseBody(string $body, int $status, \Symfony\Component\Serializer\SerializerInterface $serializer, ?string $contentType = null)
    {
        if (200 === $status) {
            return null;
        }
        if (is_null($contentType) === false && (500 === $status && mb_strpos($contentType, 'application/json') !== false)) {
            throw new \AntiPatternInc\Saasus\Sdk\Integration\Exception\SaveEventBridgeSettingsInternalServerErrorException($serializer->deserialize($body, 'AntiPatternInc\\Saasus\\Sdk\\Integration\\Model\\Error', 'json'));
        }
    }
    public function getAuthenticationScopes() : array
    {
        return array('Bearer');
    }
}
<?php

namespace AntiPatternInc\Saasus\Sdk\Integration;

class Client extends \AntiPatternInc\Saasus\Sdk\Integration\Runtime\Client\Client
{
    /**
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \AntiPatternInc\Saasus\Sdk\Integration\Exception\DeleteEventBridgeSettingsInternalServerErrorException
     *
     * @return null|\Psr\Http\Message\ResponseInterface
     */
    public function deleteEventBridgeSettings(string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \AntiPatternInc\Saasus\Sdk\Integration\Endpoint\DeleteEventBridgeSettings(), $fetch);
    }
    /**
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \AntiPatternInc\Saasus\Sdk\Integration\Exception\GetEventBridgeSettingsInternalServerErrorException
     *
     * @return null|\AntiPatternInc\Saasus\Sdk\Integration\Model\EventBridgeSettings|\Psr\Http\Message\ResponseInterface
     */
    public function getEventBridgeSettings(string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \AntiPatternInc\Saasus\Sdk\Integration\Endpoint\GetEventBridgeSettings(), $fetch);
    }
    /**
    * ホストの状態を Amazon EventBridge 経由で提供するための設定を更新します。
    
    Update configuration used to provide the host state via Amazon EventBridge.
    
    *
    * @param null|\stdClass $requestBody 
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \AntiPatternInc\Saasus\Sdk\Integration\Exception\SaveEventBridgeSettingsInternalServerErrorException
    *
    * @return null|\Psr\Http\Message\ResponseInterface
    */
    public function saveEventBridgeSettings(?\stdClass $requestBody = null, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \AntiPatternInc\Saasus\Sdk\Integration\Endpoint\SaveEventBridgeSettings($requestBody), $fetch);
    }
    /**
    * Amazon EventBridge へイベントを送信します。
    
    Send events to Amazon EventBridge.
    
    *
    * @param null|\AntiPatternInc\Saasus\Sdk\Integration\Model\CreateEventBridgeEventParam $requestBody 
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \AntiPatternInc\Saasus\Sdk\Integration\Exception\CreateEventBridgeEventInternalServerErrorException
    *
    * @return null|\Psr\Http\Message\ResponseInterface
    */
    public function createEventBridgeEvent(?\AntiPatternInc\Saasus\Sdk\Integration\Model\CreateEventBridgeEventParam $requestBody = null, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \AntiPatternInc\Saasus\Sdk\Integration\Endpoint\CreateEventBridgeEvent($requestBody), $fetch);
    }
    /**
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \AntiPatternInc\Saasus\Sdk\Integration\Exception\CreateEventBridgeTestEventInternalServerErrorException
     *
     * @return null|\Psr\Http\Message\ResponseInterface
     */
    public function createEventBridgeTestEvent(string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \AntiPatternInc\Saasus\Sdk\Integration\Endpoint\CreateEventBridgeTestEvent(), $fetch);
    }
    /**
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \AntiPatternInc\Saasus\Sdk\Integration\Exception\ReturnInternalServerErrorInternalServerErrorException
     *
     * @return null|\Psr\Http\Message\ResponseInterface
     */
    public function returnInternalServerError(string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \AntiPatternInc\Saasus\Sdk\Integration\Endpoint\ReturnInternalServerError(), $fetch);
    }
    public static function create($httpClient = null, array $additionalPlugins = array(), array $additionalNormalizers = array())
    {
        if (null === $httpClient) {
            $httpClient = \Http\Discovery\Psr18ClientDiscovery::find();
            $plugins = array();
            $uri = \Http\Discovery\Psr17FactoryDiscovery::findUrlFactory()->createUri('https://api.saasus.io/v1/integration');
            $plugins[] = new \Http\Client\Common\Plugin\AddHostPlugin($uri);
            $plugins[] = new \Http\Client\Common\Plugin\AddPathPlugin($uri);
            if (count($additionalPlugins) > 0) {
                $plugins = array_merge($plugins, $additionalPlugins);
            }
            $httpClient = new \Http\Client\Common\PluginClient($httpClient, $plugins);
        }
        $requestFactory = \Http\Discovery\Psr17FactoryDiscovery::findRequestFactory();
        $streamFactory = \Http\Discovery\Psr17FactoryDiscovery::findStreamFactory();
        $normalizers = array(new \Symfony\Component\Serializer\Normalizer\ArrayDenormalizer(), new \AntiPatternInc\Saasus\Sdk\Integration\Normalizer\JaneObjectNormalizer());
        if (count($additionalNormalizers) > 0) {
            $normalizers = array_merge($normalizers, $additionalNormalizers);
        }
        $serializer = new \Symfony\Component\Serializer\Serializer($normalizers, array(new \Symfony\Component\Serializer\Encoder\JsonEncoder(new \Symfony\Component\Serializer\Encoder\JsonEncode(), new \Symfony\Component\Serializer\Encoder\JsonDecode(array('json_decode_associative' => true)))));
        return new static($httpClient, $requestFactory, $serializer, $streamFactory);
    }
}
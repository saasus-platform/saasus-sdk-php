<?php

namespace AntiPatternInc\Saasus\Sdk\ApiLog;

class Client extends \AntiPatternInc\Saasus\Sdk\ApiLog\Runtime\Client\Client
{
    /**
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \AntiPatternInc\Saasus\Sdk\ApiLog\Exception\GetLogsInternalServerErrorException
     *
     * @return null|\AntiPatternInc\Saasus\Sdk\ApiLog\Model\ApiLogs|\Psr\Http\Message\ResponseInterface
     */
    public function getLogs(string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \AntiPatternInc\Saasus\Sdk\ApiLog\Endpoint\GetLogs(), $fetch);
    }
    /**
     * 指定したIDのAPI実行のログ登録を取得します。
     *
     * @param string $apiLogId APIログID(API Log ID)
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \AntiPatternInc\Saasus\Sdk\ApiLog\Exception\GetLogInternalServerErrorException
     *
     * @return null|\Psr\Http\Message\ResponseInterface
     */
    public function getLog(string $apiLogId, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \AntiPatternInc\Saasus\Sdk\ApiLog\Endpoint\GetLog($apiLogId), $fetch);
    }
    /**
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \AntiPatternInc\Saasus\Sdk\ApiLog\Exception\ReturnInternalServerErrorInternalServerErrorException
     *
     * @return null|\Psr\Http\Message\ResponseInterface
     */
    public function returnInternalServerError(string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \AntiPatternInc\Saasus\Sdk\ApiLog\Endpoint\ReturnInternalServerError(), $fetch);
    }
    public static function create($httpClient = null, array $additionalPlugins = array(), array $additionalNormalizers = array())
    {
        if (null === $httpClient) {
            $httpClient = \Http\Discovery\Psr18ClientDiscovery::find();
            $plugins = array();
            $uri = \Http\Discovery\Psr17FactoryDiscovery::findUriFactory()->createUri('https://api.saasus.io/v1/apilog');
            $plugins[] = new \Http\Client\Common\Plugin\AddHostPlugin($uri);
            $plugins[] = new \Http\Client\Common\Plugin\AddPathPlugin($uri);
            if (count($additionalPlugins) > 0) {
                $plugins = array_merge($plugins, $additionalPlugins);
            }
            $httpClient = new \Http\Client\Common\PluginClient($httpClient, $plugins);
        }
        $requestFactory = \Http\Discovery\Psr17FactoryDiscovery::findRequestFactory();
        $streamFactory = \Http\Discovery\Psr17FactoryDiscovery::findStreamFactory();
        $normalizers = array(new \Symfony\Component\Serializer\Normalizer\ArrayDenormalizer(), new \AntiPatternInc\Saasus\Sdk\ApiLog\Normalizer\JaneObjectNormalizer());
        if (count($additionalNormalizers) > 0) {
            $normalizers = array_merge($normalizers, $additionalNormalizers);
        }
        $serializer = new \Symfony\Component\Serializer\Serializer($normalizers, array(new \Symfony\Component\Serializer\Encoder\JsonEncoder(new \Symfony\Component\Serializer\Encoder\JsonEncode(), new \Symfony\Component\Serializer\Encoder\JsonDecode(array('json_decode_associative' => true)))));
        return new static($httpClient, $requestFactory, $serializer, $streamFactory);
    }
}
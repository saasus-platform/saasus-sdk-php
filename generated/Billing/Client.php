<?php

namespace AntiPatternInc\Saasus\Sdk\Billing;

class Client extends \AntiPatternInc\Saasus\Sdk\Billing\Runtime\Client\Client
{
    /**
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \AntiPatternInc\Saasus\Sdk\Billing\Exception\DeleteStripeInfoInternalServerErrorException
     *
     * @return null|\Psr\Http\Message\ResponseInterface
     */
    public function deleteStripeInfo(string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \AntiPatternInc\Saasus\Sdk\Billing\Endpoint\DeleteStripeInfo(), $fetch);
    }
    /**
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \AntiPatternInc\Saasus\Sdk\Billing\Exception\GetStripeInfoInternalServerErrorException
     *
     * @return null|\AntiPatternInc\Saasus\Sdk\Billing\Model\StripeInfo|\Psr\Http\Message\ResponseInterface
     */
    public function getStripeInfo(string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \AntiPatternInc\Saasus\Sdk\Billing\Endpoint\GetStripeInfo(), $fetch);
    }
    /**
    * 請求業務で使う外部SaaSとの連携情報を更新します。
    現在は Stripe と連携が可能です。
    
    Updates information on connection with external billing SaaS.
    Currently possible to connect to Stripe.
    
    *
    * @param null|\AntiPatternInc\Saasus\Sdk\Billing\Model\UpdateStripeInfoParam $requestBody 
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \AntiPatternInc\Saasus\Sdk\Billing\Exception\UpdateStripeInfoInternalServerErrorException
    *
    * @return null|\Psr\Http\Message\ResponseInterface
    */
    public function updateStripeInfo(?\AntiPatternInc\Saasus\Sdk\Billing\Model\UpdateStripeInfoParam $requestBody = null, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \AntiPatternInc\Saasus\Sdk\Billing\Endpoint\UpdateStripeInfo($requestBody), $fetch);
    }
    /**
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \AntiPatternInc\Saasus\Sdk\Billing\Exception\ReturnInternalServerErrorInternalServerErrorException
     *
     * @return null|\Psr\Http\Message\ResponseInterface
     */
    public function returnInternalServerError(string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \AntiPatternInc\Saasus\Sdk\Billing\Endpoint\ReturnInternalServerError(), $fetch);
    }
    public static function create($httpClient = null, array $additionalPlugins = array(), array $additionalNormalizers = array())
    {
        if (null === $httpClient) {
            $httpClient = \Http\Discovery\Psr18ClientDiscovery::find();
            $plugins = array();
            $uri = \Http\Discovery\Psr17FactoryDiscovery::findUrlFactory()->createUri('https://api.saasus.io/v1/billing');
            $plugins[] = new \Http\Client\Common\Plugin\AddHostPlugin($uri);
            $plugins[] = new \Http\Client\Common\Plugin\AddPathPlugin($uri);
            if (count($additionalPlugins) > 0) {
                $plugins = array_merge($plugins, $additionalPlugins);
            }
            $httpClient = new \Http\Client\Common\PluginClient($httpClient, $plugins);
        }
        $requestFactory = \Http\Discovery\Psr17FactoryDiscovery::findRequestFactory();
        $streamFactory = \Http\Discovery\Psr17FactoryDiscovery::findStreamFactory();
        $normalizers = array(new \Symfony\Component\Serializer\Normalizer\ArrayDenormalizer(), new \AntiPatternInc\Saasus\Sdk\Billing\Normalizer\JaneObjectNormalizer());
        if (count($additionalNormalizers) > 0) {
            $normalizers = array_merge($normalizers, $additionalNormalizers);
        }
        $serializer = new \Symfony\Component\Serializer\Serializer($normalizers, array(new \Symfony\Component\Serializer\Encoder\JsonEncoder(new \Symfony\Component\Serializer\Encoder\JsonEncode(), new \Symfony\Component\Serializer\Encoder\JsonDecode(array('json_decode_associative' => true)))));
        return new static($httpClient, $requestFactory, $serializer, $streamFactory);
    }
}
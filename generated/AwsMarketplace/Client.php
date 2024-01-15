<?php

namespace AntiPatternInc\Saasus\Sdk\AwsMarketplace;

class Client extends \AntiPatternInc\Saasus\Sdk\AwsMarketplace\Runtime\Client\Client
{
    /**
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \AntiPatternInc\Saasus\Sdk\AwsMarketplace\Exception\GetSettingsInternalServerErrorException
     *
     * @return null|\AntiPatternInc\Saasus\Sdk\AwsMarketplace\Model\Settings|\Psr\Http\Message\ResponseInterface
     */
    public function getSettings(string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \AntiPatternInc\Saasus\Sdk\AwsMarketplace\Endpoint\GetSettings(), $fetch);
    }
    /**
    * AWS Marketplaceの設定を更新します。
    
    Update AWS Marketplace Settings.
    
    *
    * @param null|\AntiPatternInc\Saasus\Sdk\AwsMarketplace\Model\UpdateSettingsParam $requestBody 
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \AntiPatternInc\Saasus\Sdk\AwsMarketplace\Exception\UpdateSettingsInternalServerErrorException
    *
    * @return null|\Psr\Http\Message\ResponseInterface
    */
    public function updateSettings(?\AntiPatternInc\Saasus\Sdk\AwsMarketplace\Model\UpdateSettingsParam $requestBody = null, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \AntiPatternInc\Saasus\Sdk\AwsMarketplace\Endpoint\UpdateSettings($requestBody), $fetch);
    }
    /**
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \AntiPatternInc\Saasus\Sdk\AwsMarketplace\Exception\GetListingStatusInternalServerErrorException
     *
     * @return null|\AntiPatternInc\Saasus\Sdk\AwsMarketplace\Model\GetListingStatusResult|\Psr\Http\Message\ResponseInterface
     */
    public function getListingStatus(string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \AntiPatternInc\Saasus\Sdk\AwsMarketplace\Endpoint\GetListingStatus(), $fetch);
    }
    /**
    * AWS Marketplaceの出品状況を更新します。
    
    Update AWS Marketplace Listing Status.
    
    *
    * @param null|\AntiPatternInc\Saasus\Sdk\AwsMarketplace\Model\UpdateListingStatusParam $requestBody 
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \AntiPatternInc\Saasus\Sdk\AwsMarketplace\Exception\UpdateListingStatusInternalServerErrorException
    *
    * @return null|\Psr\Http\Message\ResponseInterface
    */
    public function updateListingStatus(?\AntiPatternInc\Saasus\Sdk\AwsMarketplace\Model\UpdateListingStatusParam $requestBody = null, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \AntiPatternInc\Saasus\Sdk\AwsMarketplace\Endpoint\UpdateListingStatus($requestBody), $fetch);
    }
    /**
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \AntiPatternInc\Saasus\Sdk\AwsMarketplace\Exception\GetPlansInternalServerErrorException
     *
     * @return null|\AntiPatternInc\Saasus\Sdk\AwsMarketplace\Model\Plans|\Psr\Http\Message\ResponseInterface
     */
    public function getPlans(string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \AntiPatternInc\Saasus\Sdk\AwsMarketplace\Endpoint\GetPlans(), $fetch);
    }
    /**
    * AWSMarketplaceに連携するプラン情報を登録します。
    
    Save plan information to be linked to AWSMarketplace.
    
    *
    * @param null|\AntiPatternInc\Saasus\Sdk\AwsMarketplace\Model\SavePlanParam $requestBody 
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \AntiPatternInc\Saasus\Sdk\AwsMarketplace\Exception\SavePlanInternalServerErrorException
    *
    * @return null|\Psr\Http\Message\ResponseInterface
    */
    public function savePlan(?\AntiPatternInc\Saasus\Sdk\AwsMarketplace\Model\SavePlanParam $requestBody = null, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \AntiPatternInc\Saasus\Sdk\AwsMarketplace\Endpoint\SavePlan($requestBody), $fetch);
    }
    /**
    * Marketplaceと連携するプラン情報を取得します。
    
    Obtain plan information to link to AWS Marketplace.
    
    *
    * @param string $planName AWS Marketplace連携プラン名
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \AntiPatternInc\Saasus\Sdk\AwsMarketplace\Exception\GetPlanByPlanNameInternalServerErrorException
    *
    * @return null|\AntiPatternInc\Saasus\Sdk\AwsMarketplace\Model\Plan|\Psr\Http\Message\ResponseInterface
    */
    public function getPlanByPlanName(string $planName, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \AntiPatternInc\Saasus\Sdk\AwsMarketplace\Endpoint\GetPlanByPlanName($planName), $fetch);
    }
    /**
    * AWS Marketplaceに連携する顧客情報の一覧を取得します。
    
    Get a list of customer information to be linked to AWS Marketplace.
    
    *
    * @param array $queryParameters {
    *     @var array $tenant_ids 指定したテナントIDの顧客を取得する(Get customers with the specified tenant ID)
    * }
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \AntiPatternInc\Saasus\Sdk\AwsMarketplace\Exception\GetCustomersInternalServerErrorException
    *
    * @return null|\AntiPatternInc\Saasus\Sdk\AwsMarketplace\Model\Customers|\Psr\Http\Message\ResponseInterface
    */
    public function getCustomers(array $queryParameters = array(), string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \AntiPatternInc\Saasus\Sdk\AwsMarketplace\Endpoint\GetCustomers($queryParameters), $fetch);
    }
    /**
    * AWS Marketplaceに連携する顧客情報を新規作成します。
    
    Create customer information to be linked to AWS Marketplace.
    
    *
    * @param null|\AntiPatternInc\Saasus\Sdk\AwsMarketplace\Model\CreateCustomerParam $requestBody 
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \AntiPatternInc\Saasus\Sdk\AwsMarketplace\Exception\CreateCustomerInternalServerErrorException
    *
    * @return null|\AntiPatternInc\Saasus\Sdk\AwsMarketplace\Model\Customer|\Psr\Http\Message\ResponseInterface
    */
    public function createCustomer(?\AntiPatternInc\Saasus\Sdk\AwsMarketplace\Model\CreateCustomerParam $requestBody = null, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \AntiPatternInc\Saasus\Sdk\AwsMarketplace\Endpoint\CreateCustomer($requestBody), $fetch);
    }
    /**
    * AWS Marketplaceに連携する顧客情報を取得します。
    
    Get customer information to be linked to AWS Marketplace.
    
    *
    * @param string $customerIdentifier 顧客ID
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \AntiPatternInc\Saasus\Sdk\AwsMarketplace\Exception\GetCustomerInternalServerErrorException
    *
    * @return null|\AntiPatternInc\Saasus\Sdk\AwsMarketplace\Model\Customer|\Psr\Http\Message\ResponseInterface
    */
    public function getCustomer(string $customerIdentifier, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \AntiPatternInc\Saasus\Sdk\AwsMarketplace\Endpoint\GetCustomer($customerIdentifier), $fetch);
    }
    /**
    * AWS Marketplaceの顧客情報をSaaSusに同期します。
    
    Sync AWS Marketplace customer information to SaaSus.
    
    *
    * @param string $customerIdentifier 顧客ID
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \AntiPatternInc\Saasus\Sdk\AwsMarketplace\Exception\SyncCustomerInternalServerErrorException
    *
    * @return null|\Psr\Http\Message\ResponseInterface
    */
    public function syncCustomer(string $customerIdentifier, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \AntiPatternInc\Saasus\Sdk\AwsMarketplace\Endpoint\SyncCustomer($customerIdentifier), $fetch);
    }
    /**
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \AntiPatternInc\Saasus\Sdk\AwsMarketplace\Exception\GetCloudFormationLaunchStackLinkInternalServerErrorException
     *
     * @return null|\AntiPatternInc\Saasus\Sdk\AwsMarketplace\Model\CloudFormationLaunchStackLink|\Psr\Http\Message\ResponseInterface
     */
    public function getCloudFormationLaunchStackLink(string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \AntiPatternInc\Saasus\Sdk\AwsMarketplace\Endpoint\GetCloudFormationLaunchStackLink(), $fetch);
    }
    /**
    * Registration Tokenを検証します。
    
    Verify Registration Token.
    
    *
    * @param null|\AntiPatternInc\Saasus\Sdk\AwsMarketplace\Model\VerifyRegistrationTokenParam $requestBody 
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \AntiPatternInc\Saasus\Sdk\AwsMarketplace\Exception\VerifyRegistrationTokenBadRequestException
    * @throws \AntiPatternInc\Saasus\Sdk\AwsMarketplace\Exception\VerifyRegistrationTokenInternalServerErrorException
    *
    * @return null|\Psr\Http\Message\ResponseInterface
    */
    public function verifyRegistrationToken(?\AntiPatternInc\Saasus\Sdk\AwsMarketplace\Model\VerifyRegistrationTokenParam $requestBody = null, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \AntiPatternInc\Saasus\Sdk\AwsMarketplace\Endpoint\VerifyRegistrationToken($requestBody), $fetch);
    }
    /**
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \AntiPatternInc\Saasus\Sdk\AwsMarketplace\Exception\GetCatalogEntityVisibilityInternalServerErrorException
     *
     * @return null|\AntiPatternInc\Saasus\Sdk\AwsMarketplace\Model\CatalogEntityVisibility|\Psr\Http\Message\ResponseInterface
     */
    public function getCatalogEntityVisibility(string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \AntiPatternInc\Saasus\Sdk\AwsMarketplace\Endpoint\GetCatalogEntityVisibility(), $fetch);
    }
    /**
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \AntiPatternInc\Saasus\Sdk\AwsMarketplace\Exception\ReturnInternalServerErrorInternalServerErrorException
     *
     * @return null|\Psr\Http\Message\ResponseInterface
     */
    public function returnInternalServerError(string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \AntiPatternInc\Saasus\Sdk\AwsMarketplace\Endpoint\ReturnInternalServerError(), $fetch);
    }
    public static function create($httpClient = null, array $additionalPlugins = array(), array $additionalNormalizers = array())
    {
        if (null === $httpClient) {
            $httpClient = \Http\Discovery\Psr18ClientDiscovery::find();
            $plugins = array();
            $uri = \Http\Discovery\Psr17FactoryDiscovery::findUriFactory()->createUri('https://api.saasus.io/v1/awsmarketplace');
            $plugins[] = new \Http\Client\Common\Plugin\AddHostPlugin($uri);
            $plugins[] = new \Http\Client\Common\Plugin\AddPathPlugin($uri);
            if (count($additionalPlugins) > 0) {
                $plugins = array_merge($plugins, $additionalPlugins);
            }
            $httpClient = new \Http\Client\Common\PluginClient($httpClient, $plugins);
        }
        $requestFactory = \Http\Discovery\Psr17FactoryDiscovery::findRequestFactory();
        $streamFactory = \Http\Discovery\Psr17FactoryDiscovery::findStreamFactory();
        $normalizers = array(new \Symfony\Component\Serializer\Normalizer\ArrayDenormalizer(), new \AntiPatternInc\Saasus\Sdk\AwsMarketplace\Normalizer\JaneObjectNormalizer());
        if (count($additionalNormalizers) > 0) {
            $normalizers = array_merge($normalizers, $additionalNormalizers);
        }
        $serializer = new \Symfony\Component\Serializer\Serializer($normalizers, array(new \Symfony\Component\Serializer\Encoder\JsonEncoder(new \Symfony\Component\Serializer\Encoder\JsonEncode(), new \Symfony\Component\Serializer\Encoder\JsonDecode(array('json_decode_associative' => true)))));
        return new static($httpClient, $requestFactory, $serializer, $streamFactory);
    }
}
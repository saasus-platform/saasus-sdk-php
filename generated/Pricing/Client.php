<?php

namespace AntiPatternInc\Saasus\Sdk\Pricing;

class Client extends \AntiPatternInc\Saasus\Sdk\Pricing\Runtime\Client\Client
{
    /**
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \AntiPatternInc\Saasus\Sdk\Pricing\Exception\GetPricingUnitsInternalServerErrorException
     *
     * @return null|\AntiPatternInc\Saasus\Sdk\Pricing\Model\PricingUnits|\Psr\Http\Message\ResponseInterface
     */
    public function getPricingUnits(string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \AntiPatternInc\Saasus\Sdk\Pricing\Endpoint\GetPricingUnits(), $fetch);
    }
    /**
     * プライシングユニットを作成します。
     *
     * @param null|\stdClass $requestBody 
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \AntiPatternInc\Saasus\Sdk\Pricing\Exception\CreatePricingUnitInternalServerErrorException
     *
     * @return null|\Psr\Http\Message\ResponseInterface
     */
    public function createPricingUnit(?\stdClass $requestBody = null, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \AntiPatternInc\Saasus\Sdk\Pricing\Endpoint\CreatePricingUnit($requestBody), $fetch);
    }
    /**
     * プライシングユニットを削除します。
     *
     * @param string $pricingUnitId ユニットID
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \AntiPatternInc\Saasus\Sdk\Pricing\Exception\DeletePricingUnitInternalServerErrorException
     *
     * @return null|\Psr\Http\Message\ResponseInterface
     */
    public function deletePricingUnit(string $pricingUnitId, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \AntiPatternInc\Saasus\Sdk\Pricing\Endpoint\DeletePricingUnit($pricingUnitId), $fetch);
    }
    /**
     * プライシングユニットを取得します。
     *
     * @param string $pricingUnitId ユニットID
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \AntiPatternInc\Saasus\Sdk\Pricing\Exception\GetPricingUnitInternalServerErrorException
     *
     * @return null|\Psr\Http\Message\ResponseInterface
     */
    public function getPricingUnit(string $pricingUnitId, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \AntiPatternInc\Saasus\Sdk\Pricing\Endpoint\GetPricingUnit($pricingUnitId), $fetch);
    }
    /**
     * プライシングユニット情報を更新します。
     *
     * @param string $pricingUnitId ユニットID
     * @param null|\stdClass $requestBody 
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \AntiPatternInc\Saasus\Sdk\Pricing\Exception\UpdatePricingUnitInternalServerErrorException
     *
     * @return null|\Psr\Http\Message\ResponseInterface
     */
    public function updatePricingUnit(string $pricingUnitId, ?\stdClass $requestBody = null, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \AntiPatternInc\Saasus\Sdk\Pricing\Endpoint\UpdatePricingUnit($pricingUnitId, $requestBody), $fetch);
    }
    /**
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \AntiPatternInc\Saasus\Sdk\Pricing\Exception\GetPricingMenusInternalServerErrorException
     *
     * @return null|\AntiPatternInc\Saasus\Sdk\Pricing\Model\PricingMenus|\Psr\Http\Message\ResponseInterface
     */
    public function getPricingMenus(string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \AntiPatternInc\Saasus\Sdk\Pricing\Endpoint\GetPricingMenus(), $fetch);
    }
    /**
     * プライシング機能メニューを作成します
     *
     * @param null|\stdClass $requestBody 
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \AntiPatternInc\Saasus\Sdk\Pricing\Exception\CreatePricingMenuInternalServerErrorException
     *
     * @return null|\AntiPatternInc\Saasus\Sdk\Pricing\Model\PricingMenu|\Psr\Http\Message\ResponseInterface
     */
    public function createPricingMenu(?\stdClass $requestBody = null, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \AntiPatternInc\Saasus\Sdk\Pricing\Endpoint\CreatePricingMenu($requestBody), $fetch);
    }
    /**
     * プライシング機能メニューを削除します。
     *
     * @param string $menuId メニューID
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \AntiPatternInc\Saasus\Sdk\Pricing\Exception\DeletePricingMenuNotFoundException
     * @throws \AntiPatternInc\Saasus\Sdk\Pricing\Exception\DeletePricingMenuInternalServerErrorException
     *
     * @return null|\Psr\Http\Message\ResponseInterface
     */
    public function deletePricingMenu(string $menuId, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \AntiPatternInc\Saasus\Sdk\Pricing\Endpoint\DeletePricingMenu($menuId), $fetch);
    }
    /**
     * プライシング機能メニューを取得します。
     *
     * @param string $menuId メニューID
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \AntiPatternInc\Saasus\Sdk\Pricing\Exception\GetPricingMenuInternalServerErrorException
     *
     * @return null|\AntiPatternInc\Saasus\Sdk\Pricing\Model\PricingMenu|\Psr\Http\Message\ResponseInterface
     */
    public function getPricingMenu(string $menuId, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \AntiPatternInc\Saasus\Sdk\Pricing\Endpoint\GetPricingMenu($menuId), $fetch);
    }
    /**
     * プライシング機能メニューを更新します。
     *
     * @param string $menuId メニューID
     * @param null|\stdClass $requestBody 
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \AntiPatternInc\Saasus\Sdk\Pricing\Exception\UpdatePricingMenuInternalServerErrorException
     *
     * @return null|\Psr\Http\Message\ResponseInterface
     */
    public function updatePricingMenu(string $menuId, ?\stdClass $requestBody = null, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \AntiPatternInc\Saasus\Sdk\Pricing\Endpoint\UpdatePricingMenu($menuId, $requestBody), $fetch);
    }
    /**
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \AntiPatternInc\Saasus\Sdk\Pricing\Exception\GetPricingPlansInternalServerErrorException
     *
     * @return null|\AntiPatternInc\Saasus\Sdk\Pricing\Model\PricingPlans|\Psr\Http\Message\ResponseInterface
     */
    public function getPricingPlans(string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \AntiPatternInc\Saasus\Sdk\Pricing\Endpoint\GetPricingPlans(), $fetch);
    }
    /**
     * 料金プランを作成します。
     *
     * @param null|\stdClass $requestBody 
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \AntiPatternInc\Saasus\Sdk\Pricing\Exception\CreatePricingPlanInternalServerErrorException
     *
     * @return null|\AntiPatternInc\Saasus\Sdk\Pricing\Model\PricingPlan|\Psr\Http\Message\ResponseInterface
     */
    public function createPricingPlan(?\stdClass $requestBody = null, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \AntiPatternInc\Saasus\Sdk\Pricing\Endpoint\CreatePricingPlan($requestBody), $fetch);
    }
    /**
     * 料金プランを削除します。
     *
     * @param string $planId 料金プランID
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \AntiPatternInc\Saasus\Sdk\Pricing\Exception\DeletePricingPlanNotFoundException
     * @throws \AntiPatternInc\Saasus\Sdk\Pricing\Exception\DeletePricingPlanInternalServerErrorException
     *
     * @return null|\Psr\Http\Message\ResponseInterface
     */
    public function deletePricingPlan(string $planId, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \AntiPatternInc\Saasus\Sdk\Pricing\Endpoint\DeletePricingPlan($planId), $fetch);
    }
    /**
     * 料金プランを取得します。
     *
     * @param string $planId 料金プランID
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \AntiPatternInc\Saasus\Sdk\Pricing\Exception\GetPricingPlanInternalServerErrorException
     *
     * @return null|\AntiPatternInc\Saasus\Sdk\Pricing\Model\PricingPlan|\Psr\Http\Message\ResponseInterface
     */
    public function getPricingPlan(string $planId, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \AntiPatternInc\Saasus\Sdk\Pricing\Endpoint\GetPricingPlan($planId), $fetch);
    }
    /**
     * 料金プランを更新します。
     *
     * @param string $planId 料金プランID
     * @param null|\stdClass $requestBody 
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \AntiPatternInc\Saasus\Sdk\Pricing\Exception\UpdatePricingPlanInternalServerErrorException
     *
     * @return null|\Psr\Http\Message\ResponseInterface
     */
    public function updatePricingPlan(string $planId, ?\stdClass $requestBody = null, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \AntiPatternInc\Saasus\Sdk\Pricing\Endpoint\UpdatePricingPlan($planId, $requestBody), $fetch);
    }
    /**
     * 料金プランと配下のメニュー・ユニットを使用済みに更新します。
     *
     * @param null|\AntiPatternInc\Saasus\Sdk\Pricing\Model\UpdatePricingPlansUsedParam $requestBody 
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \AntiPatternInc\Saasus\Sdk\Pricing\Exception\UpdatePricingPlansUsedInternalServerErrorException
     *
     * @return null|\Psr\Http\Message\ResponseInterface
     */
    public function updatePricingPlansUsed(?\AntiPatternInc\Saasus\Sdk\Pricing\Model\UpdatePricingPlansUsedParam $requestBody = null, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \AntiPatternInc\Saasus\Sdk\Pricing\Endpoint\UpdatePricingPlansUsed($requestBody), $fetch);
    }
    /**
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \AntiPatternInc\Saasus\Sdk\Pricing\Exception\LinkPlanToStripeInternalServerErrorException
     *
     * @return null|\Psr\Http\Message\ResponseInterface
     */
    public function linkPlanToStripe(string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \AntiPatternInc\Saasus\Sdk\Pricing\Endpoint\LinkPlanToStripe(), $fetch);
    }
    /**
     * 指定した日付のメータリングユニットカウントを削除します。
     *
     * @param string $tenantId テナントID
     * @param string $meteringUnitName 計測ユニット名
     * @param string $date 日
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \AntiPatternInc\Saasus\Sdk\Pricing\Exception\DeleteMeteringUnitDateCountInternalServerErrorException
     *
     * @return null|\Psr\Http\Message\ResponseInterface
     */
    public function deleteMeteringUnitDateCount(string $tenantId, string $meteringUnitName, string $date, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \AntiPatternInc\Saasus\Sdk\Pricing\Endpoint\DeleteMeteringUnitDateCount($tenantId, $meteringUnitName, $date), $fetch);
    }
    /**
     * 指定した日付のメータリングユニットカウントを取得します。
     *
     * @param string $tenantId テナントID
     * @param string $meteringUnitName 計測ユニット名
     * @param string $date 日
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \AntiPatternInc\Saasus\Sdk\Pricing\Exception\GetMeteringUnitDateCountByTenantIdAndUnitNameAndDateInternalServerErrorException
     *
     * @return null|\AntiPatternInc\Saasus\Sdk\Pricing\Model\MeteringUnitDateCount|\Psr\Http\Message\ResponseInterface
     */
    public function getMeteringUnitDateCountByTenantIdAndUnitNameAndDate(string $tenantId, string $meteringUnitName, string $date, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \AntiPatternInc\Saasus\Sdk\Pricing\Endpoint\GetMeteringUnitDateCountByTenantIdAndUnitNameAndDate($tenantId, $meteringUnitName, $date), $fetch);
    }
    /**
     * 指定した日付のメータリングユニットカウントを更新します。
     *
     * @param string $tenantId テナントID
     * @param string $meteringUnitName 計測ユニット名
     * @param string $date 日
     * @param null|\AntiPatternInc\Saasus\Sdk\Pricing\Model\UpdateMeteringUnitDateCountParam $requestBody 
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \AntiPatternInc\Saasus\Sdk\Pricing\Exception\UpdateMeteringUnitDateCountInternalServerErrorException
     *
     * @return null|\AntiPatternInc\Saasus\Sdk\Pricing\Model\MeteringUnitDateCount|\Psr\Http\Message\ResponseInterface
     */
    public function updateMeteringUnitDateCount(string $tenantId, string $meteringUnitName, string $date, ?\AntiPatternInc\Saasus\Sdk\Pricing\Model\UpdateMeteringUnitDateCountParam $requestBody = null, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \AntiPatternInc\Saasus\Sdk\Pricing\Endpoint\UpdateMeteringUnitDateCount($tenantId, $meteringUnitName, $date, $requestBody), $fetch);
    }
    /**
     * 当日のメータリングユニットカウントを削除します。
     *
     * @param string $tenantId テナントID
     * @param string $meteringUnitName 計測ユニット名
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \AntiPatternInc\Saasus\Sdk\Pricing\Exception\DeleteMeteringUnitDateCountTodayInternalServerErrorException
     *
     * @return null|\Psr\Http\Message\ResponseInterface
     */
    public function deleteMeteringUnitDateCountToday(string $tenantId, string $meteringUnitName, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \AntiPatternInc\Saasus\Sdk\Pricing\Endpoint\DeleteMeteringUnitDateCountToday($tenantId, $meteringUnitName), $fetch);
    }
    /**
     * 当日のメータリングユニットカウントを取得します。
     *
     * @param string $tenantId テナントID
     * @param string $meteringUnitName 計測ユニット名
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \AntiPatternInc\Saasus\Sdk\Pricing\Exception\GetMeteringUnitDateCountByTenantIdAndUnitNameTodayInternalServerErrorException
     *
     * @return null|\AntiPatternInc\Saasus\Sdk\Pricing\Model\MeteringUnitDateCount|\Psr\Http\Message\ResponseInterface
     */
    public function getMeteringUnitDateCountByTenantIdAndUnitNameToday(string $tenantId, string $meteringUnitName, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \AntiPatternInc\Saasus\Sdk\Pricing\Endpoint\GetMeteringUnitDateCountByTenantIdAndUnitNameToday($tenantId, $meteringUnitName), $fetch);
    }
    /**
     * 当日のメータリングユニットカウントを更新します。
     *
     * @param string $tenantId テナントID
     * @param string $meteringUnitName 計測ユニット名
     * @param null|\AntiPatternInc\Saasus\Sdk\Pricing\Model\UpdateMeteringUnitDateCountTodayParam $requestBody 
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \AntiPatternInc\Saasus\Sdk\Pricing\Exception\UpdateMeteringUnitDateCountTodayInternalServerErrorException
     *
     * @return null|\AntiPatternInc\Saasus\Sdk\Pricing\Model\MeteringUnitDateCount|\Psr\Http\Message\ResponseInterface
     */
    public function updateMeteringUnitDateCountToday(string $tenantId, string $meteringUnitName, ?\AntiPatternInc\Saasus\Sdk\Pricing\Model\UpdateMeteringUnitDateCountTodayParam $requestBody = null, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \AntiPatternInc\Saasus\Sdk\Pricing\Endpoint\UpdateMeteringUnitDateCountToday($tenantId, $meteringUnitName, $requestBody), $fetch);
    }
    /**
     * 当月のメータリングユニットカウントを取得します。
     *
     * @param string $tenantId テナントID
     * @param string $meteringUnitName 計測ユニット名
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \AntiPatternInc\Saasus\Sdk\Pricing\Exception\GetMeteringUnitMonthCountByTenantIdAndUnitNameThisMonthInternalServerErrorException
     *
     * @return null|\AntiPatternInc\Saasus\Sdk\Pricing\Model\MeteringUnitMonthCount|\Psr\Http\Message\ResponseInterface
     */
    public function getMeteringUnitMonthCountByTenantIdAndUnitNameThisMonth(string $tenantId, string $meteringUnitName, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \AntiPatternInc\Saasus\Sdk\Pricing\Endpoint\GetMeteringUnitMonthCountByTenantIdAndUnitNameThisMonth($tenantId, $meteringUnitName), $fetch);
    }
    /**
     * 指定した月のメータリングユニットカウントを取得します。
     *
     * @param string $tenantId テナントID
     * @param string $meteringUnitName 計測ユニット名
     * @param string $month 月
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \AntiPatternInc\Saasus\Sdk\Pricing\Exception\GetMeteringUnitMonthCountByTenantIdAndUnitNameAndMonthInternalServerErrorException
     *
     * @return null|\AntiPatternInc\Saasus\Sdk\Pricing\Model\MeteringUnitMonthCount|\Psr\Http\Message\ResponseInterface
     */
    public function getMeteringUnitMonthCountByTenantIdAndUnitNameAndMonth(string $tenantId, string $meteringUnitName, string $month, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \AntiPatternInc\Saasus\Sdk\Pricing\Endpoint\GetMeteringUnitMonthCountByTenantIdAndUnitNameAndMonth($tenantId, $meteringUnitName, $month), $fetch);
    }
    /**
     * 指定した日の全メータリングユニットカウントを取得します。
     *
     * @param string $tenantId テナントID
     * @param string $date 日
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \AntiPatternInc\Saasus\Sdk\Pricing\Exception\GetMeteringUnitDateCountsByTenantIdAndDateInternalServerErrorException
     *
     * @return null|\AntiPatternInc\Saasus\Sdk\Pricing\Model\MeteringUnitDateCounts|\Psr\Http\Message\ResponseInterface
     */
    public function getMeteringUnitDateCountsByTenantIdAndDate(string $tenantId, string $date, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \AntiPatternInc\Saasus\Sdk\Pricing\Endpoint\GetMeteringUnitDateCountsByTenantIdAndDate($tenantId, $date), $fetch);
    }
    /**
     * 指定した月の全メータリングユニットカウントを取得します。
     *
     * @param string $tenantId テナントID
     * @param string $month 月
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \AntiPatternInc\Saasus\Sdk\Pricing\Exception\GetMeteringUnitMonthCountsByTenantIdAndMonthInternalServerErrorException
     *
     * @return null|\AntiPatternInc\Saasus\Sdk\Pricing\Model\MeteringUnitMonthCounts|\Psr\Http\Message\ResponseInterface
     */
    public function getMeteringUnitMonthCountsByTenantIdAndMonth(string $tenantId, string $month, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \AntiPatternInc\Saasus\Sdk\Pricing\Endpoint\GetMeteringUnitMonthCountsByTenantIdAndMonth($tenantId, $month), $fetch);
    }
    public static function create($httpClient = null, array $additionalPlugins = array(), array $additionalNormalizers = array())
    {
        if (null === $httpClient) {
            $httpClient = \Http\Discovery\Psr18ClientDiscovery::find();
            $plugins = array();
            $uri = \Http\Discovery\Psr17FactoryDiscovery::findUrlFactory()->createUri('https://api.saasus.io/v0/pricing');
            $plugins[] = new \Http\Client\Common\Plugin\AddHostPlugin($uri);
            $plugins[] = new \Http\Client\Common\Plugin\AddPathPlugin($uri);
            if (count($additionalPlugins) > 0) {
                $plugins = array_merge($plugins, $additionalPlugins);
            }
            $httpClient = new \Http\Client\Common\PluginClient($httpClient, $plugins);
        }
        $requestFactory = \Http\Discovery\Psr17FactoryDiscovery::findRequestFactory();
        $streamFactory = \Http\Discovery\Psr17FactoryDiscovery::findStreamFactory();
        $normalizers = array(new \Symfony\Component\Serializer\Normalizer\ArrayDenormalizer(), new \AntiPatternInc\Saasus\Sdk\Pricing\Normalizer\JaneObjectNormalizer());
        if (count($additionalNormalizers) > 0) {
            $normalizers = array_merge($normalizers, $additionalNormalizers);
        }
        $serializer = new \Symfony\Component\Serializer\Serializer($normalizers, array(new \Symfony\Component\Serializer\Encoder\JsonEncoder(new \Symfony\Component\Serializer\Encoder\JsonEncode(), new \Symfony\Component\Serializer\Encoder\JsonDecode(array('json_decode_associative' => true)))));
        return new static($httpClient, $requestFactory, $serializer, $streamFactory);
    }
}
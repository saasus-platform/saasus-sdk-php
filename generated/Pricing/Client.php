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
    
    Create a pricing unit.
    
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
    
    Delete a pricing unit.
    
    *
    * @param string $pricingUnitId ユニットID(unit id)
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
    
    Get a pricing unit.
    
    *
    * @param string $pricingUnitId ユニットID(unit id)
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
    
    Update pricing unit.
    
    *
    * @param string $pricingUnitId ユニットID(unit id)
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
    * プライシング機能メニューを作成します。
    
    Create a pricing feature menu.
    
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
    
    Delete pricing feature menu.
    
    *
    * @param string $menuId メニューID(menu ID)
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
    
    Get a pricing feature menu.
    
    *
    * @param string $menuId メニューID(menu ID)
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
    
    Update pricing feature menu.
    
    *
    * @param string $menuId メニューID(menu ID)
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
    
    Create pricing plan.
    
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
    
    Delete pricing plan.
    
    *
    * @param string $planId 料金プランID(price plan ID)
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
    
    Get pricing plan.
    
    *
    * @param string $planId 料金プランID(price plan ID)
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
    
    Update pricing plan.
    
    *
    * @param string $planId 料金プランID(price plan ID)
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
    
    Update price plan and feature menu/pricing unit to used.
    
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
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \AntiPatternInc\Saasus\Sdk\Pricing\Exception\DeleteStripePlanInternalServerErrorException
     *
     * @return null|\Psr\Http\Message\ResponseInterface
     */
    public function deleteStripePlan(string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \AntiPatternInc\Saasus\Sdk\Pricing\Endpoint\DeleteStripePlan(), $fetch);
    }
    /**
    * 指定した日付のメータリングユニットカウントを取得します。
    
    Gets the metering unit count for specific date.
    
    *
    * @param string $tenantId テナントID(tenant id)
    * @param string $meteringUnitName 計測ユニット名(metering unit name)
    * @param string $date 日(date)
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
    * 指定したタイムスタンプのメータリングユニットカウントを削除します。
    
    Deletes metering unit count for the specified timestamp.
    
    *
    * @param string $tenantId テナントID(tenant id)
    * @param string $meteringUnitName 計測ユニット名(metering unit name)
    * @param int $timestamp タイムスタンプ(timestamp)
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \AntiPatternInc\Saasus\Sdk\Pricing\Exception\DeleteMeteringUnitTimestampCountInternalServerErrorException
    *
    * @return null|\Psr\Http\Message\ResponseInterface
    */
    public function deleteMeteringUnitTimestampCount(string $tenantId, string $meteringUnitName, int $timestamp, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \AntiPatternInc\Saasus\Sdk\Pricing\Endpoint\DeleteMeteringUnitTimestampCount($tenantId, $meteringUnitName, $timestamp), $fetch);
    }
    /**
    * 指定したタイムスタンプのメータリングユニットカウントを更新します。
    
    Update metering unit count for the specified timestamp.
    
    *
    * @param string $tenantId テナントID(tenant id)
    * @param string $meteringUnitName 計測ユニット名(metering unit name)
    * @param int $timestamp タイムスタンプ(timestamp)
    * @param null|\AntiPatternInc\Saasus\Sdk\Pricing\Model\UpdateMeteringUnitTimestampCountParam $requestBody 
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \AntiPatternInc\Saasus\Sdk\Pricing\Exception\UpdateMeteringUnitTimestampCountInternalServerErrorException
    *
    * @return null|\AntiPatternInc\Saasus\Sdk\Pricing\Model\MeteringUnitTimestampCount|\Psr\Http\Message\ResponseInterface
    */
    public function updateMeteringUnitTimestampCount(string $tenantId, string $meteringUnitName, int $timestamp, ?\AntiPatternInc\Saasus\Sdk\Pricing\Model\UpdateMeteringUnitTimestampCountParam $requestBody = null, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \AntiPatternInc\Saasus\Sdk\Pricing\Endpoint\UpdateMeteringUnitTimestampCount($tenantId, $meteringUnitName, $timestamp, $requestBody), $fetch);
    }
    /**
    * 当日のメータリングユニットカウントを取得します。
    
    Get the metering unit count for the current day.
    
    *
    * @param string $tenantId テナントID(tenant id)
    * @param string $meteringUnitName 計測ユニット名(metering unit name)
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
    * 現在時刻のメータリングユニットカウントを更新します。
    
    Update the metering unit count for the current time.
    
    *
    * @param string $tenantId テナントID(tenant id)
    * @param string $meteringUnitName 計測ユニット名(metering unit name)
    * @param null|\AntiPatternInc\Saasus\Sdk\Pricing\Model\UpdateMeteringUnitTimestampCountNowParam $requestBody 
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \AntiPatternInc\Saasus\Sdk\Pricing\Exception\UpdateMeteringUnitTimestampCountNowInternalServerErrorException
    *
    * @return null|\AntiPatternInc\Saasus\Sdk\Pricing\Model\MeteringUnitTimestampCount|\Psr\Http\Message\ResponseInterface
    */
    public function updateMeteringUnitTimestampCountNow(string $tenantId, string $meteringUnitName, ?\AntiPatternInc\Saasus\Sdk\Pricing\Model\UpdateMeteringUnitTimestampCountNowParam $requestBody = null, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \AntiPatternInc\Saasus\Sdk\Pricing\Endpoint\UpdateMeteringUnitTimestampCountNow($tenantId, $meteringUnitName, $requestBody), $fetch);
    }
    /**
    * 当月のメータリングユニットカウントを取得します。
    
    Get the metering unit count for the current month.
    
    *
    * @param string $tenantId テナントID(tenant id)
    * @param string $meteringUnitName 計測ユニット名(metering unit name)
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
    
    Gets the metering unit count for the specified month.
    
    *
    * @param string $tenantId テナントID(tenant id)
    * @param string $meteringUnitName 計測ユニット名(metering unit name)
    * @param string $month 月(month)
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
    
    Gets the total metering unit count for the specified date.
    
    *
    * @param string $tenantId テナントID(tenant id)
    * @param string $date 日(date)
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
    
    Gets all metering unit counts for the specified month.
    
    *
    * @param string $tenantId テナントID(tenant id)
    * @param string $month 月(month)
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \AntiPatternInc\Saasus\Sdk\Pricing\Exception\GetMeteringUnitMonthCountsByTenantIdAndMonthInternalServerErrorException
    *
    * @return null|\AntiPatternInc\Saasus\Sdk\Pricing\Model\MeteringUnitMonthCounts|\Psr\Http\Message\ResponseInterface
    */
    public function getMeteringUnitMonthCountsByTenantIdAndMonth(string $tenantId, string $month, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \AntiPatternInc\Saasus\Sdk\Pricing\Endpoint\GetMeteringUnitMonthCountsByTenantIdAndMonth($tenantId, $month), $fetch);
    }
    /**
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \AntiPatternInc\Saasus\Sdk\Pricing\Exception\DeleteAllPlansAndMenusAndUnitsAndMetersInternalServerErrorException
     *
     * @return null|\Psr\Http\Message\ResponseInterface
     */
    public function deleteAllPlansAndMenusAndUnitsAndMeters(string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \AntiPatternInc\Saasus\Sdk\Pricing\Endpoint\DeleteAllPlansAndMenusAndUnitsAndMeters(), $fetch);
    }
    /**
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \AntiPatternInc\Saasus\Sdk\Pricing\Exception\ReturnInternalServerErrorInternalServerErrorException
     *
     * @return null|\Psr\Http\Message\ResponseInterface
     */
    public function returnInternalServerError(string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \AntiPatternInc\Saasus\Sdk\Pricing\Endpoint\ReturnInternalServerError(), $fetch);
    }
    public static function create($httpClient = null, array $additionalPlugins = array(), array $additionalNormalizers = array())
    {
        if (null === $httpClient) {
            $httpClient = \Http\Discovery\Psr18ClientDiscovery::find();
            $plugins = array();
            $uri = \Http\Discovery\Psr17FactoryDiscovery::findUrlFactory()->createUri('https://api.saasus.io/v1/pricing');
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
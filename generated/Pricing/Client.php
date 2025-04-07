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
     * Create a pricing unit.
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
     * Delete a pricing unit.
     *
     * @param string $pricingUnitId Unit ID
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
     * Get a pricing unit.
     *
     * @param string $pricingUnitId Unit ID
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
     * Update pricing unit.
     *
     * @param string $pricingUnitId Unit ID
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
     * Create a pricing feature menu.
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
     * Delete pricing feature menu.
     *
     * @param string $menuId Menu ID
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
     * Get a pricing feature menu.
     *
     * @param string $menuId Menu ID
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
     * Update pricing feature menu.
     *
     * @param string $menuId Menu ID
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
     * Create a pricing plan.
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
     * Delete a pricing plan.
     *
     * @param string $planId Pricing Plan ID
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
     * Get a pricing plan.
     *
     * @param string $planId Pricing Plan ID
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
     * Update a pricing plan.
     *
     * @param string $planId Pricing Plan ID
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
     * Update price plan and feature menu/pricing unit to used.
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
     * Gets the metering unit count for a specific date.
     *
     * @param string $tenantId Tenant ID
     * @param string $meteringUnitName Metering Unit Name
     * @param string $date Date
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
     * Deletes metering unit count for the specified timestamp.
     *
     * @param string $tenantId Tenant ID
     * @param string $meteringUnitName Metering Unit Name
     * @param int $timestamp Timestamp
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
     * Update metering unit count for the specified timestamp.
     *
     * @param string $tenantId Tenant ID
     * @param string $meteringUnitName Metering Unit Name
     * @param int $timestamp Timestamp
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
     * Get the metering unit count for the current day.
     *
     * @param string $tenantId Tenant ID
     * @param string $meteringUnitName Metering Unit Name
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
     * Update the metering unit count for the current time.
     *
     * @param string $tenantId Tenant ID
     * @param string $meteringUnitName Metering Unit Name
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
     * Get the metering unit count for the current month.
     *
     * @param string $tenantId Tenant ID
     * @param string $meteringUnitName Metering Unit Name
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
     * Gets the metering unit count for the specified month.
     *
     * @param string $tenantId Tenant ID
     * @param string $meteringUnitName Metering Unit Name
     * @param string $month Month
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
     * Gets the total metering unit count for the specified date.
     *
     * @param string $tenantId Tenant ID
     * @param string $date Date
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
     * Gets all metering unit counts for the specified month.
     *
     * @param string $tenantId Tenant ID
     * @param string $month Month
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
     * @throws \AntiPatternInc\Saasus\Sdk\Pricing\Exception\DeleteAllPlansAndMenusAndUnitsAndMetersAndTaxRatesInternalServerErrorException
     *
     * @return null|\Psr\Http\Message\ResponseInterface
     */
    public function deleteAllPlansAndMenusAndUnitsAndMetersAndTaxRates(string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \AntiPatternInc\Saasus\Sdk\Pricing\Endpoint\DeleteAllPlansAndMenusAndUnitsAndMetersAndTaxRates(), $fetch);
    }
    /**
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \AntiPatternInc\Saasus\Sdk\Pricing\Exception\GetTaxRatesInternalServerErrorException
     *
     * @return null|\AntiPatternInc\Saasus\Sdk\Pricing\Model\TaxRates|\Psr\Http\Message\ResponseInterface
     */
    public function getTaxRates(string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \AntiPatternInc\Saasus\Sdk\Pricing\Endpoint\GetTaxRates(), $fetch);
    }
    /**
     * Creates a tax rate.
     *
     * @param null|\stdClass $requestBody 
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \AntiPatternInc\Saasus\Sdk\Pricing\Exception\CreateTaxRateBadRequestException
     * @throws \AntiPatternInc\Saasus\Sdk\Pricing\Exception\CreateTaxRateInternalServerErrorException
     *
     * @return null|\AntiPatternInc\Saasus\Sdk\Pricing\Model\TaxRate|\Psr\Http\Message\ResponseInterface
     */
    public function createTaxRate(?\stdClass $requestBody = null, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \AntiPatternInc\Saasus\Sdk\Pricing\Endpoint\CreateTaxRate($requestBody), $fetch);
    }
    /**
     * Update tax rate.
     *
     * @param string $taxRateId Tax Rate ID
     * @param null|\AntiPatternInc\Saasus\Sdk\Pricing\Model\UpdateTaxRateParam $requestBody 
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \AntiPatternInc\Saasus\Sdk\Pricing\Exception\UpdateTaxRateBadRequestException
     * @throws \AntiPatternInc\Saasus\Sdk\Pricing\Exception\UpdateTaxRateInternalServerErrorException
     *
     * @return null|\Psr\Http\Message\ResponseInterface
     */
    public function updateTaxRate(string $taxRateId, ?\AntiPatternInc\Saasus\Sdk\Pricing\Model\UpdateTaxRateParam $requestBody = null, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \AntiPatternInc\Saasus\Sdk\Pricing\Endpoint\UpdateTaxRate($taxRateId, $requestBody), $fetch);
    }
    /**
     * Obtain metering unit counts for a specified date/time period.
     *
     * @param string $tenantId Tenant ID
     * @param string $meteringUnitName Metering Unit Name
     * @param array $queryParameters {
     *     @var int $start_timestamp Start Date-Time
     *     @var int $end_timestamp End Date-Time
     * }
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \AntiPatternInc\Saasus\Sdk\Pricing\Exception\GetMeteringUnitDateCountByTenantIdAndUnitNameAndDatePeriodInternalServerErrorException
     *
     * @return null|\AntiPatternInc\Saasus\Sdk\Pricing\Model\MeteringUnitDatePeriodCounts|\Psr\Http\Message\ResponseInterface
     */
    public function getMeteringUnitDateCountByTenantIdAndUnitNameAndDatePeriod(string $tenantId, string $meteringUnitName, array $queryParameters = [], string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \AntiPatternInc\Saasus\Sdk\Pricing\Endpoint\GetMeteringUnitDateCountByTenantIdAndUnitNameAndDatePeriod($tenantId, $meteringUnitName, $queryParameters), $fetch);
    }
    /**
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \AntiPatternInc\Saasus\Sdk\Pricing\Exception\GetMeteringUnitsInternalServerErrorException
     *
     * @return null|\AntiPatternInc\Saasus\Sdk\Pricing\Model\MeteringUnits|\Psr\Http\Message\ResponseInterface
     */
    public function getMeteringUnits(string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \AntiPatternInc\Saasus\Sdk\Pricing\Endpoint\GetMeteringUnits(), $fetch);
    }
    /**
     * Create a metering unit.
     *
     * @param null|\stdClass $requestBody 
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \AntiPatternInc\Saasus\Sdk\Pricing\Exception\CreateMeteringUnitBadRequestException
     * @throws \AntiPatternInc\Saasus\Sdk\Pricing\Exception\CreateMeteringUnitInternalServerErrorException
     *
     * @return null|\AntiPatternInc\Saasus\Sdk\Pricing\Model\MeteringUnit|\Psr\Http\Message\ResponseInterface
     */
    public function createMeteringUnit(?\stdClass $requestBody = null, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \AntiPatternInc\Saasus\Sdk\Pricing\Endpoint\CreateMeteringUnit($requestBody), $fetch);
    }
    /**
     * Delete metering unit.
     *
     * @param string $meteringUnitId Metering Unit ID
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \AntiPatternInc\Saasus\Sdk\Pricing\Exception\DeleteMeteringUnitByIDNotFoundException
     * @throws \AntiPatternInc\Saasus\Sdk\Pricing\Exception\DeleteMeteringUnitByIDInternalServerErrorException
     *
     * @return null|\Psr\Http\Message\ResponseInterface
     */
    public function deleteMeteringUnitByID(string $meteringUnitId, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \AntiPatternInc\Saasus\Sdk\Pricing\Endpoint\DeleteMeteringUnitByID($meteringUnitId), $fetch);
    }
    /**
     * Update metering unit.
     *
     * @param string $meteringUnitId Metering Unit ID
     * @param null|\stdClass $requestBody 
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \AntiPatternInc\Saasus\Sdk\Pricing\Exception\UpdateMeteringUnitByIDBadRequestException
     * @throws \AntiPatternInc\Saasus\Sdk\Pricing\Exception\UpdateMeteringUnitByIDInternalServerErrorException
     *
     * @return null|\Psr\Http\Message\ResponseInterface
     */
    public function updateMeteringUnitByID(string $meteringUnitId, ?\stdClass $requestBody = null, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executeEndpoint(new \AntiPatternInc\Saasus\Sdk\Pricing\Endpoint\UpdateMeteringUnitByID($meteringUnitId, $requestBody), $fetch);
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
    public static function create($httpClient = null, array $additionalPlugins = [], array $additionalNormalizers = [])
    {
        if (null === $httpClient) {
            $httpClient = \Http\Discovery\Psr18ClientDiscovery::find();
            $plugins = [];
            $uri = \Http\Discovery\Psr17FactoryDiscovery::findUriFactory()->createUri('https://api.saasus.io/v1/pricing');
            $plugins[] = new \Http\Client\Common\Plugin\AddHostPlugin($uri);
            $plugins[] = new \Http\Client\Common\Plugin\AddPathPlugin($uri);
            if (count($additionalPlugins) > 0) {
                $plugins = array_merge($plugins, $additionalPlugins);
            }
            $httpClient = new \Http\Client\Common\PluginClient($httpClient, $plugins);
        }
        $requestFactory = \Http\Discovery\Psr17FactoryDiscovery::findRequestFactory();
        $streamFactory = \Http\Discovery\Psr17FactoryDiscovery::findStreamFactory();
        $normalizers = [new \Symfony\Component\Serializer\Normalizer\ArrayDenormalizer(), new \AntiPatternInc\Saasus\Sdk\Pricing\Normalizer\JaneObjectNormalizer()];
        if (count($additionalNormalizers) > 0) {
            $normalizers = array_merge($normalizers, $additionalNormalizers);
        }
        $serializer = new \Symfony\Component\Serializer\Serializer($normalizers, [new \Symfony\Component\Serializer\Encoder\JsonEncoder(new \Symfony\Component\Serializer\Encoder\JsonEncode(), new \Symfony\Component\Serializer\Encoder\JsonDecode(['json_decode_associative' => true]))]);
        return new static($httpClient, $requestFactory, $serializer, $streamFactory);
    }
}
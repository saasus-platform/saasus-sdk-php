<?php

namespace AntiPatternInc\Saasus\Sdk\Auth\Model;

class PlanReservation extends \ArrayObject
{
    /**
     * @var array
     */
    protected $initialized = [];
    public function isInitialized($property) : bool
    {
        return array_key_exists($property, $this->initialized);
    }
    /**
     * 
     *
     * @var string|null
     */
    protected $nextPlanId;
    /**
    * This parameter is set when reserving a pricing plan change for a future date and time. It is not required for immediate application.
    When specifying the next pricing plan start date and time, please specify a date and time at least 5 minutes after the current time.
    Note for Stripe integration: By specifying the beginning of the current month (00:00 UTC) as the start date and time, you can create a subscription that starts from the first day of that month. (Example: To specify January 1, 2023 00:00 UTC → 1672531200)
    
    *
    * @var int|null
    */
    protected $usingNextPlanFrom;
    /**
     * 
     *
     * @var string|null
     */
    protected $nextPlanTaxRateId;
    /**
    * If you have a strine linkage, you can set the behavior of the proportional allocation when changing plans.
    When a plan is changed, you can set whether to prorate the billing amount and reflect it on the next invoice, to issue a prorated invoice immediately, or not to prorate at all.
    
    *
    * @var string|null
    */
    protected $prorationBehavior;
    /**
    * If you have a stripe linkage,  you can set whether to delete pay-as-you-go items when changing plans.
    When you change plan, you can remove all pay-as-you-go items included in your current subscription to stop being billed based on pay-as-you-go items.
    The recorded usage is cleared immediately. Since it cannot be restored, please note that plan change reservations with delete_usage set to true cannot be canceled.
    
    *
    * @var bool|null
    */
    protected $deleteUsage;
    /**
     * 
     *
     * @return string|null
     */
    public function getNextPlanId() : ?string
    {
        return $this->nextPlanId;
    }
    /**
     * 
     *
     * @param string|null $nextPlanId
     *
     * @return self
     */
    public function setNextPlanId(?string $nextPlanId) : self
    {
        $this->initialized['nextPlanId'] = true;
        $this->nextPlanId = $nextPlanId;
        return $this;
    }
    /**
    * This parameter is set when reserving a pricing plan change for a future date and time. It is not required for immediate application.
    When specifying the next pricing plan start date and time, please specify a date and time at least 5 minutes after the current time.
    Note for Stripe integration: By specifying the beginning of the current month (00:00 UTC) as the start date and time, you can create a subscription that starts from the first day of that month. (Example: To specify January 1, 2023 00:00 UTC → 1672531200)
    
    *
    * @return int|null
    */
    public function getUsingNextPlanFrom() : ?int
    {
        return $this->usingNextPlanFrom;
    }
    /**
    * This parameter is set when reserving a pricing plan change for a future date and time. It is not required for immediate application.
    When specifying the next pricing plan start date and time, please specify a date and time at least 5 minutes after the current time.
    Note for Stripe integration: By specifying the beginning of the current month (00:00 UTC) as the start date and time, you can create a subscription that starts from the first day of that month. (Example: To specify January 1, 2023 00:00 UTC → 1672531200)
    
    *
    * @param int|null $usingNextPlanFrom
    *
    * @return self
    */
    public function setUsingNextPlanFrom(?int $usingNextPlanFrom) : self
    {
        $this->initialized['usingNextPlanFrom'] = true;
        $this->usingNextPlanFrom = $usingNextPlanFrom;
        return $this;
    }
    /**
     * 
     *
     * @return string|null
     */
    public function getNextPlanTaxRateId() : ?string
    {
        return $this->nextPlanTaxRateId;
    }
    /**
     * 
     *
     * @param string|null $nextPlanTaxRateId
     *
     * @return self
     */
    public function setNextPlanTaxRateId(?string $nextPlanTaxRateId) : self
    {
        $this->initialized['nextPlanTaxRateId'] = true;
        $this->nextPlanTaxRateId = $nextPlanTaxRateId;
        return $this;
    }
    /**
    * If you have a strine linkage, you can set the behavior of the proportional allocation when changing plans.
    When a plan is changed, you can set whether to prorate the billing amount and reflect it on the next invoice, to issue a prorated invoice immediately, or not to prorate at all.
    
    *
    * @return string|null
    */
    public function getProrationBehavior() : ?string
    {
        return $this->prorationBehavior;
    }
    /**
    * If you have a strine linkage, you can set the behavior of the proportional allocation when changing plans.
    When a plan is changed, you can set whether to prorate the billing amount and reflect it on the next invoice, to issue a prorated invoice immediately, or not to prorate at all.
    
    *
    * @param string|null $prorationBehavior
    *
    * @return self
    */
    public function setProrationBehavior(?string $prorationBehavior) : self
    {
        $this->initialized['prorationBehavior'] = true;
        $this->prorationBehavior = $prorationBehavior;
        return $this;
    }
    /**
    * If you have a stripe linkage,  you can set whether to delete pay-as-you-go items when changing plans.
    When you change plan, you can remove all pay-as-you-go items included in your current subscription to stop being billed based on pay-as-you-go items.
    The recorded usage is cleared immediately. Since it cannot be restored, please note that plan change reservations with delete_usage set to true cannot be canceled.
    
    *
    * @return bool|null
    */
    public function getDeleteUsage() : ?bool
    {
        return $this->deleteUsage;
    }
    /**
    * If you have a stripe linkage,  you can set whether to delete pay-as-you-go items when changing plans.
    When you change plan, you can remove all pay-as-you-go items included in your current subscription to stop being billed based on pay-as-you-go items.
    The recorded usage is cleared immediately. Since it cannot be restored, please note that plan change reservations with delete_usage set to true cannot be canceled.
    
    *
    * @param bool|null $deleteUsage
    *
    * @return self
    */
    public function setDeleteUsage(?bool $deleteUsage) : self
    {
        $this->initialized['deleteUsage'] = true;
        $this->deleteUsage = $deleteUsage;
        return $this;
    }
}
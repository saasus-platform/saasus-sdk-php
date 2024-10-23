<?php

namespace AntiPatternInc\Saasus\Sdk\Auth\Model;

class PlanHistory extends \ArrayObject
{
    /**
     * @var array
     */
    protected $initialized = [];
    public function isInitialized($property): bool
    {
        return array_key_exists($property, $this->initialized);
    }
    /**
     * 
     *
     * @var string|null
     */
    protected $planId;
    /**
     * Registration date
     *
     * @var int|null
     */
    protected $planAppliedAt;
    /**
     * 
     *
     * @var string|null
     */
    protected $taxRateId;
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
    public function getPlanId(): ?string
    {
        return $this->planId;
    }
    /**
     * 
     *
     * @param string|null $planId
     *
     * @return self
     */
    public function setPlanId(?string $planId): self
    {
        $this->initialized['planId'] = true;
        $this->planId = $planId;
        return $this;
    }
    /**
     * Registration date
     *
     * @return int|null
     */
    public function getPlanAppliedAt(): ?int
    {
        return $this->planAppliedAt;
    }
    /**
     * Registration date
     *
     * @param int|null $planAppliedAt
     *
     * @return self
     */
    public function setPlanAppliedAt(?int $planAppliedAt): self
    {
        $this->initialized['planAppliedAt'] = true;
        $this->planAppliedAt = $planAppliedAt;
        return $this;
    }
    /**
     * 
     *
     * @return string|null
     */
    public function getTaxRateId(): ?string
    {
        return $this->taxRateId;
    }
    /**
     * 
     *
     * @param string|null $taxRateId
     *
     * @return self
     */
    public function setTaxRateId(?string $taxRateId): self
    {
        $this->initialized['taxRateId'] = true;
        $this->taxRateId = $taxRateId;
        return $this;
    }
    /**
    * If you have a strine linkage, you can set the behavior of the proportional allocation when changing plans.
    When a plan is changed, you can set whether to prorate the billing amount and reflect it on the next invoice, to issue a prorated invoice immediately, or not to prorate at all.
    
    *
    * @return string|null
    */
    public function getProrationBehavior(): ?string
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
    public function setProrationBehavior(?string $prorationBehavior): self
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
    public function getDeleteUsage(): ?bool
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
    public function setDeleteUsage(?bool $deleteUsage): self
    {
        $this->initialized['deleteUsage'] = true;
        $this->deleteUsage = $deleteUsage;
        return $this;
    }
}
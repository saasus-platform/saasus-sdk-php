<?php

namespace AntiPatternInc\Saasus\Sdk\Auth\Model;

class Tenant extends \ArrayObject
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
    protected $id;
    /**
     * 
     *
     * @var string|null
     */
    protected $planId;
    /**
     * 
     *
     * @var BillingInfo|null
     */
    protected $billingInfo;
    /**
     * tenant name
     *
     * @var string|null
     */
    protected $name;
    /**
     * attribute info
     *
     * @var array<string, mixed>|null
     */
    protected $attributes;
    /**
     * administrative staff email address
     *
     * @var string|null
     */
    protected $backOfficeStaffEmail;
    /**
     * 
     *
     * @var string|null
     */
    protected $nextPlanId;
    /**
     * Next billing plan start time (When using stripe, you can create a subscription that starts at the beginning of the current month by specifying 00:00 (UTC) at the beginning of the current month. Ex. 1672531200 for January 2023.)
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
     * Plan History
     *
     * @var list<PlanHistory>|null
     */
    protected $planHistories;
    /**
     * 
     *
     * @return string|null
     */
    public function getId(): ?string
    {
        return $this->id;
    }
    /**
     * 
     *
     * @param string|null $id
     *
     * @return self
     */
    public function setId(?string $id): self
    {
        $this->initialized['id'] = true;
        $this->id = $id;
        return $this;
    }
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
     * 
     *
     * @return BillingInfo|null
     */
    public function getBillingInfo(): ?BillingInfo
    {
        return $this->billingInfo;
    }
    /**
     * 
     *
     * @param BillingInfo|null $billingInfo
     *
     * @return self
     */
    public function setBillingInfo(?BillingInfo $billingInfo): self
    {
        $this->initialized['billingInfo'] = true;
        $this->billingInfo = $billingInfo;
        return $this;
    }
    /**
     * tenant name
     *
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }
    /**
     * tenant name
     *
     * @param string|null $name
     *
     * @return self
     */
    public function setName(?string $name): self
    {
        $this->initialized['name'] = true;
        $this->name = $name;
        return $this;
    }
    /**
     * attribute info
     *
     * @return array<string, mixed>|null
     */
    public function getAttributes(): ?iterable
    {
        return $this->attributes;
    }
    /**
     * attribute info
     *
     * @param array<string, mixed>|null $attributes
     *
     * @return self
     */
    public function setAttributes(?iterable $attributes): self
    {
        $this->initialized['attributes'] = true;
        $this->attributes = $attributes;
        return $this;
    }
    /**
     * administrative staff email address
     *
     * @return string|null
     */
    public function getBackOfficeStaffEmail(): ?string
    {
        return $this->backOfficeStaffEmail;
    }
    /**
     * administrative staff email address
     *
     * @param string|null $backOfficeStaffEmail
     *
     * @return self
     */
    public function setBackOfficeStaffEmail(?string $backOfficeStaffEmail): self
    {
        $this->initialized['backOfficeStaffEmail'] = true;
        $this->backOfficeStaffEmail = $backOfficeStaffEmail;
        return $this;
    }
    /**
     * 
     *
     * @return string|null
     */
    public function getNextPlanId(): ?string
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
    public function setNextPlanId(?string $nextPlanId): self
    {
        $this->initialized['nextPlanId'] = true;
        $this->nextPlanId = $nextPlanId;
        return $this;
    }
    /**
     * Next billing plan start time (When using stripe, you can create a subscription that starts at the beginning of the current month by specifying 00:00 (UTC) at the beginning of the current month. Ex. 1672531200 for January 2023.)
     *
     * @return int|null
     */
    public function getUsingNextPlanFrom(): ?int
    {
        return $this->usingNextPlanFrom;
    }
    /**
     * Next billing plan start time (When using stripe, you can create a subscription that starts at the beginning of the current month by specifying 00:00 (UTC) at the beginning of the current month. Ex. 1672531200 for January 2023.)
     *
     * @param int|null $usingNextPlanFrom
     *
     * @return self
     */
    public function setUsingNextPlanFrom(?int $usingNextPlanFrom): self
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
    public function getNextPlanTaxRateId(): ?string
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
    public function setNextPlanTaxRateId(?string $nextPlanTaxRateId): self
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
    /**
     * Plan History
     *
     * @return list<PlanHistory>|null
     */
    public function getPlanHistories(): ?array
    {
        return $this->planHistories;
    }
    /**
     * Plan History
     *
     * @param list<PlanHistory>|null $planHistories
     *
     * @return self
     */
    public function setPlanHistories(?array $planHistories): self
    {
        $this->initialized['planHistories'] = true;
        $this->planHistories = $planHistories;
        return $this;
    }
}
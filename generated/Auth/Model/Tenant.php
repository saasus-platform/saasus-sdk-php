<?php

namespace AntiPatternInc\Saasus\Sdk\Auth\Model;

class Tenant extends \ArrayObject
{
    /**
     * @var array
     */
    protected $initialized = array();
    public function isInitialized($property) : bool
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
     * テナント名(tenant name)
     *
     * @var string|null
     */
    protected $name;
    /**
     * 属性情報(attribute info)
     *
     * @var array<string, mixed>|null
     */
    protected $attributes;
    /**
     * 事務管理部門スタッフメールアドレス(administrative staff email address)
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
    * 次回料金プラン開始日時（stripe連携時、当月月初の0時（UTC）を指定すると当月月初開始のサブスクリプションを作成できます。ex. 2023年1月の場合は、1672531200 ）
    (Next billing plan start time (When using stripe, you can create a subscription that starts at the beginning of the current month by specifying 00:00 (UTC) at the beginning of the current month. Ex. 1672531200 for January 2023.))
    
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
    * stripe連携している場合で、プラン変更時の比例配分の挙動を設定できます。
    プラン変更した場合に、請求金額を日割り計算し次回請求書に反映させるか、日割り計算した請求を即時に発行する、日割り計算をしないを設定できます。
    
    If you have a strine linkage, you can set the behavior of the proportional allocation when changing plans.
    When a plan is changed, you can set whether to prorate the billing amount and reflect it on the next invoice, to issue a prorated invoice immediately, or not to prorate at all.
    
    *
    * @var string|null
    */
    protected $prorationBehavior;
    /**
    * stripe連携している場合で、プラン変更時に従量課金アイテムを削除するか設定できます。
    プラン変更した場合に、現在のサブスクリプションに含まれる従量課金アイテムを全て削除して、従量課金アイテムに基づく請求の発生を止めることができます。
    即時に記録している使用量がクリアされます。それらは復元できないため、delete_usageをtrueにしたプラン変更予約は取り消しできません。
    
    If you have a stripe linkage,  you can set whether to delete pay-as-you-go items when changing plans.
    When you change plan, you can remove all pay-as-you-go items included in your current subscription to stop being billed based on pay-as-you-go items.
    The recorded usage is cleared immediately. Since it cannot be restored, please note that plan change reservations with delete_usage set to true cannot be canceled.
    
    *
    * @var bool|null
    */
    protected $deleteUsage;
    /**
     * 料金プラン履歴
     *
     * @var PlanHistory[]|null
     */
    protected $planHistories;
    /**
     * 
     *
     * @return string|null
     */
    public function getId() : ?string
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
    public function setId(?string $id) : self
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
    public function getPlanId() : ?string
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
    public function setPlanId(?string $planId) : self
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
    public function getBillingInfo() : ?BillingInfo
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
    public function setBillingInfo(?BillingInfo $billingInfo) : self
    {
        $this->initialized['billingInfo'] = true;
        $this->billingInfo = $billingInfo;
        return $this;
    }
    /**
     * テナント名(tenant name)
     *
     * @return string|null
     */
    public function getName() : ?string
    {
        return $this->name;
    }
    /**
     * テナント名(tenant name)
     *
     * @param string|null $name
     *
     * @return self
     */
    public function setName(?string $name) : self
    {
        $this->initialized['name'] = true;
        $this->name = $name;
        return $this;
    }
    /**
     * 属性情報(attribute info)
     *
     * @return array<string, mixed>|null
     */
    public function getAttributes() : ?iterable
    {
        return $this->attributes;
    }
    /**
     * 属性情報(attribute info)
     *
     * @param array<string, mixed>|null $attributes
     *
     * @return self
     */
    public function setAttributes(?iterable $attributes) : self
    {
        $this->initialized['attributes'] = true;
        $this->attributes = $attributes;
        return $this;
    }
    /**
     * 事務管理部門スタッフメールアドレス(administrative staff email address)
     *
     * @return string|null
     */
    public function getBackOfficeStaffEmail() : ?string
    {
        return $this->backOfficeStaffEmail;
    }
    /**
     * 事務管理部門スタッフメールアドレス(administrative staff email address)
     *
     * @param string|null $backOfficeStaffEmail
     *
     * @return self
     */
    public function setBackOfficeStaffEmail(?string $backOfficeStaffEmail) : self
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
    * 次回料金プラン開始日時（stripe連携時、当月月初の0時（UTC）を指定すると当月月初開始のサブスクリプションを作成できます。ex. 2023年1月の場合は、1672531200 ）
    (Next billing plan start time (When using stripe, you can create a subscription that starts at the beginning of the current month by specifying 00:00 (UTC) at the beginning of the current month. Ex. 1672531200 for January 2023.))
    
    *
    * @return int|null
    */
    public function getUsingNextPlanFrom() : ?int
    {
        return $this->usingNextPlanFrom;
    }
    /**
    * 次回料金プラン開始日時（stripe連携時、当月月初の0時（UTC）を指定すると当月月初開始のサブスクリプションを作成できます。ex. 2023年1月の場合は、1672531200 ）
    (Next billing plan start time (When using stripe, you can create a subscription that starts at the beginning of the current month by specifying 00:00 (UTC) at the beginning of the current month. Ex. 1672531200 for January 2023.))
    
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
    * stripe連携している場合で、プラン変更時の比例配分の挙動を設定できます。
    プラン変更した場合に、請求金額を日割り計算し次回請求書に反映させるか、日割り計算した請求を即時に発行する、日割り計算をしないを設定できます。
    
    If you have a strine linkage, you can set the behavior of the proportional allocation when changing plans.
    When a plan is changed, you can set whether to prorate the billing amount and reflect it on the next invoice, to issue a prorated invoice immediately, or not to prorate at all.
    
    *
    * @return string|null
    */
    public function getProrationBehavior() : ?string
    {
        return $this->prorationBehavior;
    }
    /**
    * stripe連携している場合で、プラン変更時の比例配分の挙動を設定できます。
    プラン変更した場合に、請求金額を日割り計算し次回請求書に反映させるか、日割り計算した請求を即時に発行する、日割り計算をしないを設定できます。
    
    If you have a strine linkage, you can set the behavior of the proportional allocation when changing plans.
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
    * stripe連携している場合で、プラン変更時に従量課金アイテムを削除するか設定できます。
    プラン変更した場合に、現在のサブスクリプションに含まれる従量課金アイテムを全て削除して、従量課金アイテムに基づく請求の発生を止めることができます。
    即時に記録している使用量がクリアされます。それらは復元できないため、delete_usageをtrueにしたプラン変更予約は取り消しできません。
    
    If you have a stripe linkage,  you can set whether to delete pay-as-you-go items when changing plans.
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
    * stripe連携している場合で、プラン変更時に従量課金アイテムを削除するか設定できます。
    プラン変更した場合に、現在のサブスクリプションに含まれる従量課金アイテムを全て削除して、従量課金アイテムに基づく請求の発生を止めることができます。
    即時に記録している使用量がクリアされます。それらは復元できないため、delete_usageをtrueにしたプラン変更予約は取り消しできません。
    
    If you have a stripe linkage,  you can set whether to delete pay-as-you-go items when changing plans.
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
    /**
     * 料金プラン履歴
     *
     * @return PlanHistory[]|null
     */
    public function getPlanHistories() : ?array
    {
        return $this->planHistories;
    }
    /**
     * 料金プラン履歴
     *
     * @param PlanHistory[]|null $planHistories
     *
     * @return self
     */
    public function setPlanHistories(?array $planHistories) : self
    {
        $this->initialized['planHistories'] = true;
        $this->planHistories = $planHistories;
        return $this;
    }
}
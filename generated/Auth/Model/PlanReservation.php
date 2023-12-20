<?php

namespace AntiPatternInc\Saasus\Sdk\Auth\Model;

class PlanReservation extends \ArrayObject
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
     * @var string
     */
    protected $nextPlanId;
    /**
    * 次回料金プラン開始日時（stripe連携時、当月月初の0時（UTC）を指定すると当月月初開始のサブスクリプションを作成できます。ex. 2023年1月の場合は、1672531200 ）
    (Next billing plan start time (When using stripe, you can create a subscription that starts at the beginning of the current month by specifying 00:00 (UTC) at the beginning of the current month. Ex. 1672531200 for January 2023.))
    
    *
    * @var int
    */
    protected $usingNextPlanFrom;
    /**
     * 
     *
     * @var string
     */
    protected $nextPlanTaxRateId;
    /**
    * stripe連携している場合で、プラン変更時の比例配分の挙動を設定できます。
    プラン変更した場合に、請求金額を日割り計算し次回請求書に反映させるか、日割り計算した請求を即時に発行する、日割り計算をしないを設定できます。
    
    If you have a strine linkage, you can set the behavior of the proportional allocation when changing plans.
    When a plan is changed, you can set whether to prorate the billing amount and reflect it on the next invoice, to issue a prorated invoice immediately, or not to prorate at all.
    
    *
    * @var string
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
    * @var bool
    */
    protected $deleteUsage;
    /**
     * 
     *
     * @return string
     */
    public function getNextPlanId() : string
    {
        return $this->nextPlanId;
    }
    /**
     * 
     *
     * @param string $nextPlanId
     *
     * @return self
     */
    public function setNextPlanId(string $nextPlanId) : self
    {
        $this->initialized['nextPlanId'] = true;
        $this->nextPlanId = $nextPlanId;
        return $this;
    }
    /**
    * 次回料金プラン開始日時（stripe連携時、当月月初の0時（UTC）を指定すると当月月初開始のサブスクリプションを作成できます。ex. 2023年1月の場合は、1672531200 ）
    (Next billing plan start time (When using stripe, you can create a subscription that starts at the beginning of the current month by specifying 00:00 (UTC) at the beginning of the current month. Ex. 1672531200 for January 2023.))
    
    *
    * @return int
    */
    public function getUsingNextPlanFrom() : int
    {
        return $this->usingNextPlanFrom;
    }
    /**
    * 次回料金プラン開始日時（stripe連携時、当月月初の0時（UTC）を指定すると当月月初開始のサブスクリプションを作成できます。ex. 2023年1月の場合は、1672531200 ）
    (Next billing plan start time (When using stripe, you can create a subscription that starts at the beginning of the current month by specifying 00:00 (UTC) at the beginning of the current month. Ex. 1672531200 for January 2023.))
    
    *
    * @param int $usingNextPlanFrom
    *
    * @return self
    */
    public function setUsingNextPlanFrom(int $usingNextPlanFrom) : self
    {
        $this->initialized['usingNextPlanFrom'] = true;
        $this->usingNextPlanFrom = $usingNextPlanFrom;
        return $this;
    }
    /**
     * 
     *
     * @return string
     */
    public function getNextPlanTaxRateId() : string
    {
        return $this->nextPlanTaxRateId;
    }
    /**
     * 
     *
     * @param string $nextPlanTaxRateId
     *
     * @return self
     */
    public function setNextPlanTaxRateId(string $nextPlanTaxRateId) : self
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
    * @return string
    */
    public function getProrationBehavior() : string
    {
        return $this->prorationBehavior;
    }
    /**
    * stripe連携している場合で、プラン変更時の比例配分の挙動を設定できます。
    プラン変更した場合に、請求金額を日割り計算し次回請求書に反映させるか、日割り計算した請求を即時に発行する、日割り計算をしないを設定できます。
    
    If you have a strine linkage, you can set the behavior of the proportional allocation when changing plans.
    When a plan is changed, you can set whether to prorate the billing amount and reflect it on the next invoice, to issue a prorated invoice immediately, or not to prorate at all.
    
    *
    * @param string $prorationBehavior
    *
    * @return self
    */
    public function setProrationBehavior(string $prorationBehavior) : self
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
    * @return bool
    */
    public function getDeleteUsage() : bool
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
    * @param bool $deleteUsage
    *
    * @return self
    */
    public function setDeleteUsage(bool $deleteUsage) : self
    {
        $this->initialized['deleteUsage'] = true;
        $this->deleteUsage = $deleteUsage;
        return $this;
    }
}
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
}
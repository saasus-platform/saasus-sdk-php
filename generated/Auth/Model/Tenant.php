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
     * @var string
     */
    protected $id;
    /**
     * 
     *
     * @var string
     */
    protected $planId;
    /**
     * テナント名
     *
     * @var string
     */
    protected $name;
    /**
     * 属性情報
     *
     * @var mixed[]
     */
    protected $attributes;
    /**
     * 
     *
     * @var string
     */
    protected $nextPlanId;
    /**
     * 次回料金プラン開始日
     *
     * @var string
     */
    protected $usingNextPlanFrom;
    /**
     * 事務管理部門スタッフメールアドレス
     *
     * @var string
     */
    protected $backOfficeStaffEmail;
    /**
     * 料金プラン履歴
     *
     * @var PlanHistory[]
     */
    protected $planHistories;
    /**
     * 
     *
     * @return string
     */
    public function getId() : string
    {
        return $this->id;
    }
    /**
     * 
     *
     * @param string $id
     *
     * @return self
     */
    public function setId(string $id) : self
    {
        $this->initialized['id'] = true;
        $this->id = $id;
        return $this;
    }
    /**
     * 
     *
     * @return string
     */
    public function getPlanId() : string
    {
        return $this->planId;
    }
    /**
     * 
     *
     * @param string $planId
     *
     * @return self
     */
    public function setPlanId(string $planId) : self
    {
        $this->initialized['planId'] = true;
        $this->planId = $planId;
        return $this;
    }
    /**
     * テナント名
     *
     * @return string
     */
    public function getName() : string
    {
        return $this->name;
    }
    /**
     * テナント名
     *
     * @param string $name
     *
     * @return self
     */
    public function setName(string $name) : self
    {
        $this->initialized['name'] = true;
        $this->name = $name;
        return $this;
    }
    /**
     * 属性情報
     *
     * @return mixed[]
     */
    public function getAttributes() : iterable
    {
        return $this->attributes;
    }
    /**
     * 属性情報
     *
     * @param mixed[] $attributes
     *
     * @return self
     */
    public function setAttributes(iterable $attributes) : self
    {
        $this->initialized['attributes'] = true;
        $this->attributes = $attributes;
        return $this;
    }
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
     * 次回料金プラン開始日
     *
     * @return string
     */
    public function getUsingNextPlanFrom() : string
    {
        return $this->usingNextPlanFrom;
    }
    /**
     * 次回料金プラン開始日
     *
     * @param string $usingNextPlanFrom
     *
     * @return self
     */
    public function setUsingNextPlanFrom(string $usingNextPlanFrom) : self
    {
        $this->initialized['usingNextPlanFrom'] = true;
        $this->usingNextPlanFrom = $usingNextPlanFrom;
        return $this;
    }
    /**
     * 事務管理部門スタッフメールアドレス
     *
     * @return string
     */
    public function getBackOfficeStaffEmail() : string
    {
        return $this->backOfficeStaffEmail;
    }
    /**
     * 事務管理部門スタッフメールアドレス
     *
     * @param string $backOfficeStaffEmail
     *
     * @return self
     */
    public function setBackOfficeStaffEmail(string $backOfficeStaffEmail) : self
    {
        $this->initialized['backOfficeStaffEmail'] = true;
        $this->backOfficeStaffEmail = $backOfficeStaffEmail;
        return $this;
    }
    /**
     * 料金プラン履歴
     *
     * @return PlanHistory[]
     */
    public function getPlanHistories() : array
    {
        return $this->planHistories;
    }
    /**
     * 料金プラン履歴
     *
     * @param PlanHistory[] $planHistories
     *
     * @return self
     */
    public function setPlanHistories(array $planHistories) : self
    {
        $this->initialized['planHistories'] = true;
        $this->planHistories = $planHistories;
        return $this;
    }
}
<?php

namespace AntiPatternInc\Saasus\Sdk\Auth\Model;

class PlanHistory extends \ArrayObject
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
    protected $planId;
    /**
     * 登録日
     *
     * @var string
     */
    protected $planAppliedAt;
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
     * 登録日
     *
     * @return string
     */
    public function getPlanAppliedAt() : string
    {
        return $this->planAppliedAt;
    }
    /**
     * 登録日
     *
     * @param string $planAppliedAt
     *
     * @return self
     */
    public function setPlanAppliedAt(string $planAppliedAt) : self
    {
        $this->initialized['planAppliedAt'] = true;
        $this->planAppliedAt = $planAppliedAt;
        return $this;
    }
}
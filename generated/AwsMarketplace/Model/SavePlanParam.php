<?php

namespace AntiPatternInc\Saasus\Sdk\AwsMarketplace\Model;

class SavePlanParam extends \ArrayObject
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
     * 
     *
     * @var string
     */
    protected $planName;
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
     * 
     *
     * @return string
     */
    public function getPlanName() : string
    {
        return $this->planName;
    }
    /**
     * 
     *
     * @param string $planName
     *
     * @return self
     */
    public function setPlanName(string $planName) : self
    {
        $this->initialized['planName'] = true;
        $this->planName = $planName;
        return $this;
    }
}
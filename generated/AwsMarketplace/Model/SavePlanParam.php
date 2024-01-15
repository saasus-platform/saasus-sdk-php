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
     * @var string|null
     */
    protected $planId;
    /**
     * 
     *
     * @var string|null
     */
    protected $planName;
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
     * @return string|null
     */
    public function getPlanName() : ?string
    {
        return $this->planName;
    }
    /**
     * 
     *
     * @param string|null $planName
     *
     * @return self
     */
    public function setPlanName(?string $planName) : self
    {
        $this->initialized['planName'] = true;
        $this->planName = $planName;
        return $this;
    }
}
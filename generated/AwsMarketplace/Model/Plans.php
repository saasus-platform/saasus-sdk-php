<?php

namespace AntiPatternInc\Saasus\Sdk\AwsMarketplace\Model;

class Plans extends \ArrayObject
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
     * @var Plan[]
     */
    protected $plans;
    /**
     * 
     *
     * @return Plan[]
     */
    public function getPlans() : array
    {
        return $this->plans;
    }
    /**
     * 
     *
     * @param Plan[] $plans
     *
     * @return self
     */
    public function setPlans(array $plans) : self
    {
        $this->initialized['plans'] = true;
        $this->plans = $plans;
        return $this;
    }
}
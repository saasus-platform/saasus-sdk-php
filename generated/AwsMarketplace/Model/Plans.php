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
     * @var Plan[]|null
     */
    protected $plans;
    /**
     * 
     *
     * @return Plan[]|null
     */
    public function getPlans() : ?array
    {
        return $this->plans;
    }
    /**
     * 
     *
     * @param Plan[]|null $plans
     *
     * @return self
     */
    public function setPlans(?array $plans) : self
    {
        $this->initialized['plans'] = true;
        $this->plans = $plans;
        return $this;
    }
}
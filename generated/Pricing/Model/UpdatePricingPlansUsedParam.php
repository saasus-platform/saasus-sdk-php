<?php

namespace AntiPatternInc\Saasus\Sdk\Pricing\Model;

class UpdatePricingPlansUsedParam extends \ArrayObject
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
     * @var string[]
     */
    protected $planIds;
    /**
     * 
     *
     * @return string[]
     */
    public function getPlanIds() : array
    {
        return $this->planIds;
    }
    /**
     * 
     *
     * @param string[] $planIds
     *
     * @return self
     */
    public function setPlanIds(array $planIds) : self
    {
        $this->initialized['planIds'] = true;
        $this->planIds = $planIds;
        return $this;
    }
}
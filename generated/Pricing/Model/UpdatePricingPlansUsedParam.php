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
     * @var string[]|null
     */
    protected $planIds;
    /**
     * 
     *
     * @return string[]|null
     */
    public function getPlanIds() : ?array
    {
        return $this->planIds;
    }
    /**
     * 
     *
     * @param string[]|null $planIds
     *
     * @return self
     */
    public function setPlanIds(?array $planIds) : self
    {
        $this->initialized['planIds'] = true;
        $this->planIds = $planIds;
        return $this;
    }
}
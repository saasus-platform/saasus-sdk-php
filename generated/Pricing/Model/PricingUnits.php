<?php

namespace AntiPatternInc\Saasus\Sdk\Pricing\Model;

class PricingUnits extends \ArrayObject
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
     * @var mixed[][]
     */
    protected $units;
    /**
     * 
     *
     * @return mixed[][]
     */
    public function getUnits() : array
    {
        return $this->units;
    }
    /**
     * 
     *
     * @param mixed[][] $units
     *
     * @return self
     */
    public function setUnits(array $units) : self
    {
        $this->initialized['units'] = true;
        $this->units = $units;
        return $this;
    }
}
<?php

namespace AntiPatternInc\Saasus\Sdk\Pricing\Model;

class PricingMenus extends \ArrayObject
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
    protected $pricingMenus;
    /**
     * 
     *
     * @return mixed[][]
     */
    public function getPricingMenus() : array
    {
        return $this->pricingMenus;
    }
    /**
     * 
     *
     * @param mixed[][] $pricingMenus
     *
     * @return self
     */
    public function setPricingMenus(array $pricingMenus) : self
    {
        $this->initialized['pricingMenus'] = true;
        $this->pricingMenus = $pricingMenus;
        return $this;
    }
}
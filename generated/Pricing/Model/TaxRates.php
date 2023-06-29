<?php

namespace AntiPatternInc\Saasus\Sdk\Pricing\Model;

class TaxRates extends \ArrayObject
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
    protected $taxRates;
    /**
     * 
     *
     * @return mixed[][]
     */
    public function getTaxRates() : array
    {
        return $this->taxRates;
    }
    /**
     * 
     *
     * @param mixed[][] $taxRates
     *
     * @return self
     */
    public function setTaxRates(array $taxRates) : self
    {
        $this->initialized['taxRates'] = true;
        $this->taxRates = $taxRates;
        return $this;
    }
}
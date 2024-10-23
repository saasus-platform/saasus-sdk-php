<?php

namespace AntiPatternInc\Saasus\Sdk\Pricing\Model;

class TaxRates extends \ArrayObject
{
    /**
     * @var array
     */
    protected $initialized = [];
    public function isInitialized($property): bool
    {
        return array_key_exists($property, $this->initialized);
    }
    /**
     * 
     *
     * @var list<array<string, mixed>>|null
     */
    protected $taxRates;
    /**
     * 
     *
     * @return list<array<string, mixed>>|null
     */
    public function getTaxRates(): ?array
    {
        return $this->taxRates;
    }
    /**
     * 
     *
     * @param list<array<string, mixed>>|null $taxRates
     *
     * @return self
     */
    public function setTaxRates(?array $taxRates): self
    {
        $this->initialized['taxRates'] = true;
        $this->taxRates = $taxRates;
        return $this;
    }
}
<?php

namespace AntiPatternInc\Saasus\Sdk\Pricing\Model;

class PricingPlans extends \ArrayObject
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
    protected $pricingPlans;
    /**
     * 
     *
     * @return list<array<string, mixed>>|null
     */
    public function getPricingPlans(): ?array
    {
        return $this->pricingPlans;
    }
    /**
     * 
     *
     * @param list<array<string, mixed>>|null $pricingPlans
     *
     * @return self
     */
    public function setPricingPlans(?array $pricingPlans): self
    {
        $this->initialized['pricingPlans'] = true;
        $this->pricingPlans = $pricingPlans;
        return $this;
    }
}
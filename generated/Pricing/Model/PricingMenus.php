<?php

namespace AntiPatternInc\Saasus\Sdk\Pricing\Model;

class PricingMenus extends \ArrayObject
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
    protected $pricingMenus;
    /**
     * 
     *
     * @return list<array<string, mixed>>|null
     */
    public function getPricingMenus(): ?array
    {
        return $this->pricingMenus;
    }
    /**
     * 
     *
     * @param list<array<string, mixed>>|null $pricingMenus
     *
     * @return self
     */
    public function setPricingMenus(?array $pricingMenus): self
    {
        $this->initialized['pricingMenus'] = true;
        $this->pricingMenus = $pricingMenus;
        return $this;
    }
}
<?php

namespace AntiPatternInc\Saasus\Sdk\Pricing\Model;

class PricingTiers extends \ArrayObject
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
     * @var list<PricingTier>|null
     */
    protected $tiers;
    /**
     * 
     *
     * @return list<PricingTier>|null
     */
    public function getTiers(): ?array
    {
        return $this->tiers;
    }
    /**
     * 
     *
     * @param list<PricingTier>|null $tiers
     *
     * @return self
     */
    public function setTiers(?array $tiers): self
    {
        $this->initialized['tiers'] = true;
        $this->tiers = $tiers;
        return $this;
    }
}
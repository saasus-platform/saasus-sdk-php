<?php

namespace AntiPatternInc\Saasus\Sdk\Pricing\Model;

class UpdatePricingPlansUsedParam extends \ArrayObject
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
     * @var list<string>|null
     */
    protected $planIds;
    /**
     * 
     *
     * @return list<string>|null
     */
    public function getPlanIds(): ?array
    {
        return $this->planIds;
    }
    /**
     * 
     *
     * @param list<string>|null $planIds
     *
     * @return self
     */
    public function setPlanIds(?array $planIds): self
    {
        $this->initialized['planIds'] = true;
        $this->planIds = $planIds;
        return $this;
    }
}
<?php

namespace AntiPatternInc\Saasus\Sdk\AwsMarketplace\Model;

class Plans extends \ArrayObject
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
     * @var list<Plan>|null
     */
    protected $plans;
    /**
     * 
     *
     * @return list<Plan>|null
     */
    public function getPlans(): ?array
    {
        return $this->plans;
    }
    /**
     * 
     *
     * @param list<Plan>|null $plans
     *
     * @return self
     */
    public function setPlans(?array $plans): self
    {
        $this->initialized['plans'] = true;
        $this->plans = $plans;
        return $this;
    }
}
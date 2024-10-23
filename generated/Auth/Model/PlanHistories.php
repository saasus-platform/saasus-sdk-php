<?php

namespace AntiPatternInc\Saasus\Sdk\Auth\Model;

class PlanHistories extends \ArrayObject
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
     * Plan History
     *
     * @var list<PlanHistory>|null
     */
    protected $planHistories;
    /**
     * Plan History
     *
     * @return list<PlanHistory>|null
     */
    public function getPlanHistories(): ?array
    {
        return $this->planHistories;
    }
    /**
     * Plan History
     *
     * @param list<PlanHistory>|null $planHistories
     *
     * @return self
     */
    public function setPlanHistories(?array $planHistories): self
    {
        $this->initialized['planHistories'] = true;
        $this->planHistories = $planHistories;
        return $this;
    }
}
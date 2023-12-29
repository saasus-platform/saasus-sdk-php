<?php

namespace AntiPatternInc\Saasus\Sdk\Auth\Model;

class PlanHistories extends \ArrayObject
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
     * 料金プラン履歴
     *
     * @var PlanHistory[]|null
     */
    protected $planHistories;
    /**
     * 料金プラン履歴
     *
     * @return PlanHistory[]|null
     */
    public function getPlanHistories() : ?array
    {
        return $this->planHistories;
    }
    /**
     * 料金プラン履歴
     *
     * @param PlanHistory[]|null $planHistories
     *
     * @return self
     */
    public function setPlanHistories(?array $planHistories) : self
    {
        $this->initialized['planHistories'] = true;
        $this->planHistories = $planHistories;
        return $this;
    }
}
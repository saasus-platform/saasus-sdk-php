<?php

namespace AntiPatternInc\Saasus\Sdk\Pricing\Model;

class MeteringUnitMonthCounts extends \ArrayObject
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
     * @var MeteringUnitMonthCount[]|null
     */
    protected $counts;
    /**
     * 
     *
     * @return MeteringUnitMonthCount[]|null
     */
    public function getCounts() : ?array
    {
        return $this->counts;
    }
    /**
     * 
     *
     * @param MeteringUnitMonthCount[]|null $counts
     *
     * @return self
     */
    public function setCounts(?array $counts) : self
    {
        $this->initialized['counts'] = true;
        $this->counts = $counts;
        return $this;
    }
}
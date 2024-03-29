<?php

namespace AntiPatternInc\Saasus\Sdk\Pricing\Model;

class MeteringUnitDateCounts extends \ArrayObject
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
     * @var MeteringUnitDateCount[]|null
     */
    protected $counts;
    /**
     * 
     *
     * @return MeteringUnitDateCount[]|null
     */
    public function getCounts() : ?array
    {
        return $this->counts;
    }
    /**
     * 
     *
     * @param MeteringUnitDateCount[]|null $counts
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
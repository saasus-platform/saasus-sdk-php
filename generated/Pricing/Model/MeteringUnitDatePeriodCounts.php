<?php

namespace AntiPatternInc\Saasus\Sdk\Pricing\Model;

class MeteringUnitDatePeriodCounts extends \ArrayObject
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
     * 計測ユニット名(metering unit name)
     *
     * @var string
     */
    protected $meteringUnitName;
    /**
     * 
     *
     * @var MeteringUnitCount[]
     */
    protected $counts;
    /**
     * 計測ユニット名(metering unit name)
     *
     * @return string
     */
    public function getMeteringUnitName() : string
    {
        return $this->meteringUnitName;
    }
    /**
     * 計測ユニット名(metering unit name)
     *
     * @param string $meteringUnitName
     *
     * @return self
     */
    public function setMeteringUnitName(string $meteringUnitName) : self
    {
        $this->initialized['meteringUnitName'] = true;
        $this->meteringUnitName = $meteringUnitName;
        return $this;
    }
    /**
     * 
     *
     * @return MeteringUnitCount[]
     */
    public function getCounts() : array
    {
        return $this->counts;
    }
    /**
     * 
     *
     * @param MeteringUnitCount[] $counts
     *
     * @return self
     */
    public function setCounts(array $counts) : self
    {
        $this->initialized['counts'] = true;
        $this->counts = $counts;
        return $this;
    }
}
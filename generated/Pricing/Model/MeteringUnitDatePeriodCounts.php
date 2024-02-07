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
     * @var string|null
     */
    protected $meteringUnitName;
    /**
     * 
     *
     * @var MeteringUnitCount[]|null
     */
    protected $counts;
    /**
     * 計測ユニット名(metering unit name)
     *
     * @return string|null
     */
    public function getMeteringUnitName() : ?string
    {
        return $this->meteringUnitName;
    }
    /**
     * 計測ユニット名(metering unit name)
     *
     * @param string|null $meteringUnitName
     *
     * @return self
     */
    public function setMeteringUnitName(?string $meteringUnitName) : self
    {
        $this->initialized['meteringUnitName'] = true;
        $this->meteringUnitName = $meteringUnitName;
        return $this;
    }
    /**
     * 
     *
     * @return MeteringUnitCount[]|null
     */
    public function getCounts() : ?array
    {
        return $this->counts;
    }
    /**
     * 
     *
     * @param MeteringUnitCount[]|null $counts
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
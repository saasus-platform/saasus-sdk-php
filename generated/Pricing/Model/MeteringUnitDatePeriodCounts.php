<?php

namespace AntiPatternInc\Saasus\Sdk\Pricing\Model;

class MeteringUnitDatePeriodCounts extends \ArrayObject
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
     * Metering unit name
     *
     * @var string|null
     */
    protected $meteringUnitName;
    /**
     * 
     *
     * @var list<MeteringUnitCount>|null
     */
    protected $counts;
    /**
     * Metering unit name
     *
     * @return string|null
     */
    public function getMeteringUnitName(): ?string
    {
        return $this->meteringUnitName;
    }
    /**
     * Metering unit name
     *
     * @param string|null $meteringUnitName
     *
     * @return self
     */
    public function setMeteringUnitName(?string $meteringUnitName): self
    {
        $this->initialized['meteringUnitName'] = true;
        $this->meteringUnitName = $meteringUnitName;
        return $this;
    }
    /**
     * 
     *
     * @return list<MeteringUnitCount>|null
     */
    public function getCounts(): ?array
    {
        return $this->counts;
    }
    /**
     * 
     *
     * @param list<MeteringUnitCount>|null $counts
     *
     * @return self
     */
    public function setCounts(?array $counts): self
    {
        $this->initialized['counts'] = true;
        $this->counts = $counts;
        return $this;
    }
}
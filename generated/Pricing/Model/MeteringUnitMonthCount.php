<?php

namespace AntiPatternInc\Saasus\Sdk\Pricing\Model;

class MeteringUnitMonthCount extends \ArrayObject
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
     * Month
     *
     * @var string|null
     */
    protected $month;
    /**
     * Count
     *
     * @var int|null
     */
    protected $count;
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
     * Month
     *
     * @return string|null
     */
    public function getMonth(): ?string
    {
        return $this->month;
    }
    /**
     * Month
     *
     * @param string|null $month
     *
     * @return self
     */
    public function setMonth(?string $month): self
    {
        $this->initialized['month'] = true;
        $this->month = $month;
        return $this;
    }
    /**
     * Count
     *
     * @return int|null
     */
    public function getCount(): ?int
    {
        return $this->count;
    }
    /**
     * Count
     *
     * @param int|null $count
     *
     * @return self
     */
    public function setCount(?int $count): self
    {
        $this->initialized['count'] = true;
        $this->count = $count;
        return $this;
    }
}
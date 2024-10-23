<?php

namespace AntiPatternInc\Saasus\Sdk\Pricing\Model;

class MeteringUnitTimestampCount extends \ArrayObject
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
     * Timestamp
     *
     * @var int|null
     */
    protected $timestamp;
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
     * Timestamp
     *
     * @return int|null
     */
    public function getTimestamp(): ?int
    {
        return $this->timestamp;
    }
    /**
     * Timestamp
     *
     * @param int|null $timestamp
     *
     * @return self
     */
    public function setTimestamp(?int $timestamp): self
    {
        $this->initialized['timestamp'] = true;
        $this->timestamp = $timestamp;
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
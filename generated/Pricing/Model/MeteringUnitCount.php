<?php

namespace AntiPatternInc\Saasus\Sdk\Pricing\Model;

class MeteringUnitCount extends \ArrayObject
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
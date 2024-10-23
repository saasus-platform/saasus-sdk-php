<?php

namespace AntiPatternInc\Saasus\Sdk\Pricing\Model;

class MeteringUnits extends \ArrayObject
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
     * 
     *
     * @var list<array<string, mixed>>|null
     */
    protected $units;
    /**
     * 
     *
     * @return list<array<string, mixed>>|null
     */
    public function getUnits(): ?array
    {
        return $this->units;
    }
    /**
     * 
     *
     * @param list<array<string, mixed>>|null $units
     *
     * @return self
     */
    public function setUnits(?array $units): self
    {
        $this->initialized['units'] = true;
        $this->units = $units;
        return $this;
    }
}
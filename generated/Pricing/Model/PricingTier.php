<?php

namespace AntiPatternInc\Saasus\Sdk\Pricing\Model;

class PricingTier extends \ArrayObject
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
     * Upper limit
     *
     * @var int|null
     */
    protected $upTo;
    /**
     * Amount per unit
     *
     * @var int|null
     */
    protected $unitAmount;
    /**
     * Fixed amount
     *
     * @var int|null
     */
    protected $flatAmount;
    /**
     * Indefinite
     *
     * @var bool|null
     */
    protected $inf;
    /**
     * Upper limit
     *
     * @return int|null
     */
    public function getUpTo(): ?int
    {
        return $this->upTo;
    }
    /**
     * Upper limit
     *
     * @param int|null $upTo
     *
     * @return self
     */
    public function setUpTo(?int $upTo): self
    {
        $this->initialized['upTo'] = true;
        $this->upTo = $upTo;
        return $this;
    }
    /**
     * Amount per unit
     *
     * @return int|null
     */
    public function getUnitAmount(): ?int
    {
        return $this->unitAmount;
    }
    /**
     * Amount per unit
     *
     * @param int|null $unitAmount
     *
     * @return self
     */
    public function setUnitAmount(?int $unitAmount): self
    {
        $this->initialized['unitAmount'] = true;
        $this->unitAmount = $unitAmount;
        return $this;
    }
    /**
     * Fixed amount
     *
     * @return int|null
     */
    public function getFlatAmount(): ?int
    {
        return $this->flatAmount;
    }
    /**
     * Fixed amount
     *
     * @param int|null $flatAmount
     *
     * @return self
     */
    public function setFlatAmount(?int $flatAmount): self
    {
        $this->initialized['flatAmount'] = true;
        $this->flatAmount = $flatAmount;
        return $this;
    }
    /**
     * Indefinite
     *
     * @return bool|null
     */
    public function getInf(): ?bool
    {
        return $this->inf;
    }
    /**
     * Indefinite
     *
     * @param bool|null $inf
     *
     * @return self
     */
    public function setInf(?bool $inf): self
    {
        $this->initialized['inf'] = true;
        $this->inf = $inf;
        return $this;
    }
}
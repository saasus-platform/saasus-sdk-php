<?php

namespace AntiPatternInc\Saasus\Sdk\Pricing\Model;

class PricingTier extends \ArrayObject
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
     * 上限(upper limit)
     *
     * @var int|null
     */
    protected $upTo;
    /**
     * 単位金額(amount per unit)
     *
     * @var int|null
     */
    protected $unitAmount;
    /**
     * 固定金額(fixed Amount)
     *
     * @var int|null
     */
    protected $flatAmount;
    /**
     * inf
     *
     * @var bool|null
     */
    protected $inf;
    /**
     * 上限(upper limit)
     *
     * @return int|null
     */
    public function getUpTo() : ?int
    {
        return $this->upTo;
    }
    /**
     * 上限(upper limit)
     *
     * @param int|null $upTo
     *
     * @return self
     */
    public function setUpTo(?int $upTo) : self
    {
        $this->initialized['upTo'] = true;
        $this->upTo = $upTo;
        return $this;
    }
    /**
     * 単位金額(amount per unit)
     *
     * @return int|null
     */
    public function getUnitAmount() : ?int
    {
        return $this->unitAmount;
    }
    /**
     * 単位金額(amount per unit)
     *
     * @param int|null $unitAmount
     *
     * @return self
     */
    public function setUnitAmount(?int $unitAmount) : self
    {
        $this->initialized['unitAmount'] = true;
        $this->unitAmount = $unitAmount;
        return $this;
    }
    /**
     * 固定金額(fixed Amount)
     *
     * @return int|null
     */
    public function getFlatAmount() : ?int
    {
        return $this->flatAmount;
    }
    /**
     * 固定金額(fixed Amount)
     *
     * @param int|null $flatAmount
     *
     * @return self
     */
    public function setFlatAmount(?int $flatAmount) : self
    {
        $this->initialized['flatAmount'] = true;
        $this->flatAmount = $flatAmount;
        return $this;
    }
    /**
     * inf
     *
     * @return bool|null
     */
    public function getInf() : ?bool
    {
        return $this->inf;
    }
    /**
     * inf
     *
     * @param bool|null $inf
     *
     * @return self
     */
    public function setInf(?bool $inf) : self
    {
        $this->initialized['inf'] = true;
        $this->inf = $inf;
        return $this;
    }
}
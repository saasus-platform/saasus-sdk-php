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
     * @var int
     */
    protected $upTo;
    /**
     * 単位金額(amount per unit)
     *
     * @var int
     */
    protected $unitAmount;
    /**
     * 固定金額(fixed Amount)
     *
     * @var int
     */
    protected $flatAmount;
    /**
     * inf
     *
     * @var bool
     */
    protected $inf;
    /**
     * 上限(upper limit)
     *
     * @return int
     */
    public function getUpTo() : int
    {
        return $this->upTo;
    }
    /**
     * 上限(upper limit)
     *
     * @param int $upTo
     *
     * @return self
     */
    public function setUpTo(int $upTo) : self
    {
        $this->initialized['upTo'] = true;
        $this->upTo = $upTo;
        return $this;
    }
    /**
     * 単位金額(amount per unit)
     *
     * @return int
     */
    public function getUnitAmount() : int
    {
        return $this->unitAmount;
    }
    /**
     * 単位金額(amount per unit)
     *
     * @param int $unitAmount
     *
     * @return self
     */
    public function setUnitAmount(int $unitAmount) : self
    {
        $this->initialized['unitAmount'] = true;
        $this->unitAmount = $unitAmount;
        return $this;
    }
    /**
     * 固定金額(fixed Amount)
     *
     * @return int
     */
    public function getFlatAmount() : int
    {
        return $this->flatAmount;
    }
    /**
     * 固定金額(fixed Amount)
     *
     * @param int $flatAmount
     *
     * @return self
     */
    public function setFlatAmount(int $flatAmount) : self
    {
        $this->initialized['flatAmount'] = true;
        $this->flatAmount = $flatAmount;
        return $this;
    }
    /**
     * inf
     *
     * @return bool
     */
    public function getInf() : bool
    {
        return $this->inf;
    }
    /**
     * inf
     *
     * @param bool $inf
     *
     * @return self
     */
    public function setInf(bool $inf) : self
    {
        $this->initialized['inf'] = true;
        $this->inf = $inf;
        return $this;
    }
}
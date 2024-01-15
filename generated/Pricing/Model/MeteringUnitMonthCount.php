<?php

namespace AntiPatternInc\Saasus\Sdk\Pricing\Model;

class MeteringUnitMonthCount extends \ArrayObject
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
     * 月(month)
     *
     * @var string|null
     */
    protected $month;
    /**
     * 件数(count)
     *
     * @var int|null
     */
    protected $count;
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
     * 月(month)
     *
     * @return string|null
     */
    public function getMonth() : ?string
    {
        return $this->month;
    }
    /**
     * 月(month)
     *
     * @param string|null $month
     *
     * @return self
     */
    public function setMonth(?string $month) : self
    {
        $this->initialized['month'] = true;
        $this->month = $month;
        return $this;
    }
    /**
     * 件数(count)
     *
     * @return int|null
     */
    public function getCount() : ?int
    {
        return $this->count;
    }
    /**
     * 件数(count)
     *
     * @param int|null $count
     *
     * @return self
     */
    public function setCount(?int $count) : self
    {
        $this->initialized['count'] = true;
        $this->count = $count;
        return $this;
    }
}
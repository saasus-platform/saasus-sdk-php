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
     * 計測ユニット名
     *
     * @var string
     */
    protected $meteringUnitName;
    /**
     * 月
     *
     * @var string
     */
    protected $month;
    /**
     * 件数
     *
     * @var int
     */
    protected $count;
    /**
     * 計測ユニット名
     *
     * @return string
     */
    public function getMeteringUnitName() : string
    {
        return $this->meteringUnitName;
    }
    /**
     * 計測ユニット名
     *
     * @param string $meteringUnitName
     *
     * @return self
     */
    public function setMeteringUnitName(string $meteringUnitName) : self
    {
        $this->initialized['meteringUnitName'] = true;
        $this->meteringUnitName = $meteringUnitName;
        return $this;
    }
    /**
     * 月
     *
     * @return string
     */
    public function getMonth() : string
    {
        return $this->month;
    }
    /**
     * 月
     *
     * @param string $month
     *
     * @return self
     */
    public function setMonth(string $month) : self
    {
        $this->initialized['month'] = true;
        $this->month = $month;
        return $this;
    }
    /**
     * 件数
     *
     * @return int
     */
    public function getCount() : int
    {
        return $this->count;
    }
    /**
     * 件数
     *
     * @param int $count
     *
     * @return self
     */
    public function setCount(int $count) : self
    {
        $this->initialized['count'] = true;
        $this->count = $count;
        return $this;
    }
}
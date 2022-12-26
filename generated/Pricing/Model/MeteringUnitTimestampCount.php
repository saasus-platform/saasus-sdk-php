<?php

namespace AntiPatternInc\Saasus\Sdk\Pricing\Model;

class MeteringUnitTimestampCount extends \ArrayObject
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
     * @var string
     */
    protected $meteringUnitName;
    /**
     * タイムスタンプ(timestamp)
     *
     * @var int
     */
    protected $timestamp;
    /**
     * 件数(count)
     *
     * @var int
     */
    protected $count;
    /**
     * 計測ユニット名(metering unit name)
     *
     * @return string
     */
    public function getMeteringUnitName() : string
    {
        return $this->meteringUnitName;
    }
    /**
     * 計測ユニット名(metering unit name)
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
     * タイムスタンプ(timestamp)
     *
     * @return int
     */
    public function getTimestamp() : int
    {
        return $this->timestamp;
    }
    /**
     * タイムスタンプ(timestamp)
     *
     * @param int $timestamp
     *
     * @return self
     */
    public function setTimestamp(int $timestamp) : self
    {
        $this->initialized['timestamp'] = true;
        $this->timestamp = $timestamp;
        return $this;
    }
    /**
     * 件数(count)
     *
     * @return int
     */
    public function getCount() : int
    {
        return $this->count;
    }
    /**
     * 件数(count)
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
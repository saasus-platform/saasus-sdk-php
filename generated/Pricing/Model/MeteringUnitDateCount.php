<?php

namespace AntiPatternInc\Saasus\Sdk\Pricing\Model;

class MeteringUnitDateCount extends \ArrayObject
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
     * 日(date)
     *
     * @var string|null
     */
    protected $date;
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
     * 日(date)
     *
     * @return string|null
     */
    public function getDate() : ?string
    {
        return $this->date;
    }
    /**
     * 日(date)
     *
     * @param string|null $date
     *
     * @return self
     */
    public function setDate(?string $date) : self
    {
        $this->initialized['date'] = true;
        $this->date = $date;
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
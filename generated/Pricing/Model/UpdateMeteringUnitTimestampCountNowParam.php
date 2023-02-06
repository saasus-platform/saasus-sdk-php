<?php

namespace AntiPatternInc\Saasus\Sdk\Pricing\Model;

class UpdateMeteringUnitTimestampCountNowParam extends \ArrayObject
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
    * 更新方法(update method)
    add: 加算(addition)
    sub: 減算(subtraction)
    direct: 上書き(overwrite)
    *
    * @var string
    */
    protected $method;
    /**
     * 件数(count)
     *
     * @var int
     */
    protected $count;
    /**
    * 更新方法(update method)
    add: 加算(addition)
    sub: 減算(subtraction)
    direct: 上書き(overwrite)
    *
    * @return string
    */
    public function getMethod() : string
    {
        return $this->method;
    }
    /**
    * 更新方法(update method)
    add: 加算(addition)
    sub: 減算(subtraction)
    direct: 上書き(overwrite)
    *
    * @param string $method
    *
    * @return self
    */
    public function setMethod(string $method) : self
    {
        $this->initialized['method'] = true;
        $this->method = $method;
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
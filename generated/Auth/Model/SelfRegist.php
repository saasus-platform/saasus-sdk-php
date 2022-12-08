<?php

namespace AntiPatternInc\Saasus\Sdk\Auth\Model;

class SelfRegist extends \ArrayObject
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
     * 
     *
     * @var bool
     */
    protected $enable;
    /**
     * 
     *
     * @return bool
     */
    public function getEnable() : bool
    {
        return $this->enable;
    }
    /**
     * 
     *
     * @param bool $enable
     *
     * @return self
     */
    public function setEnable(bool $enable) : self
    {
        $this->initialized['enable'] = true;
        $this->enable = $enable;
        return $this;
    }
}
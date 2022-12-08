<?php

namespace AntiPatternInc\Saasus\Sdk\Auth\Model;

class MfaPreference extends \ArrayObject
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
    protected $enabled;
    /**
     * enabledがtrueの場合は必須です
     *
     * @var string
     */
    protected $method;
    /**
     * 
     *
     * @return bool
     */
    public function getEnabled() : bool
    {
        return $this->enabled;
    }
    /**
     * 
     *
     * @param bool $enabled
     *
     * @return self
     */
    public function setEnabled(bool $enabled) : self
    {
        $this->initialized['enabled'] = true;
        $this->enabled = $enabled;
        return $this;
    }
    /**
     * enabledがtrueの場合は必須です
     *
     * @return string
     */
    public function getMethod() : string
    {
        return $this->method;
    }
    /**
     * enabledがtrueの場合は必須です
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
}
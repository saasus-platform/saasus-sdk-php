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
     * MFAを有効にするか否か(Whether to enable MFA)
     *
     * @var bool
     */
    protected $enabled;
    /**
     * MFAの方法(enabledがtrueの場合は必須)(MFA method (required if enabled is true))
     *
     * @var string
     */
    protected $method;
    /**
     * MFAを有効にするか否か(Whether to enable MFA)
     *
     * @return bool
     */
    public function getEnabled() : bool
    {
        return $this->enabled;
    }
    /**
     * MFAを有効にするか否か(Whether to enable MFA)
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
     * MFAの方法(enabledがtrueの場合は必須)(MFA method (required if enabled is true))
     *
     * @return string
     */
    public function getMethod() : string
    {
        return $this->method;
    }
    /**
     * MFAの方法(enabledがtrueの場合は必須)(MFA method (required if enabled is true))
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
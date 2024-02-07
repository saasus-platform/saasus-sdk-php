<?php

namespace AntiPatternInc\Saasus\Sdk\Auth\Model;

class DeviceConfiguration extends \ArrayObject
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
    * always: 常に記憶する(always remember)
    userOptIn: ユーザーオプトイン(user opt-in)
    no: (don't save)
    
    *
    * @var string|null
    */
    protected $deviceRemembering;
    /**
    * always: 常に記憶する(always remember)
    userOptIn: ユーザーオプトイン(user opt-in)
    no: (don't save)
    
    *
    * @return string|null
    */
    public function getDeviceRemembering() : ?string
    {
        return $this->deviceRemembering;
    }
    /**
    * always: 常に記憶する(always remember)
    userOptIn: ユーザーオプトイン(user opt-in)
    no: (don't save)
    
    *
    * @param string|null $deviceRemembering
    *
    * @return self
    */
    public function setDeviceRemembering(?string $deviceRemembering) : self
    {
        $this->initialized['deviceRemembering'] = true;
        $this->deviceRemembering = $deviceRemembering;
        return $this;
    }
}
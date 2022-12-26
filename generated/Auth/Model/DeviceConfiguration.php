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
    userOptIn: ユーザーオプトイン(User opt-in)
    no: (don't save)
    
    *
    * @var string
    */
    protected $deviceRemembering;
    /**
    * always: 常に記憶する(always remember)
    userOptIn: ユーザーオプトイン(User opt-in)
    no: (don't save)
    
    *
    * @return string
    */
    public function getDeviceRemembering() : string
    {
        return $this->deviceRemembering;
    }
    /**
    * always: 常に記憶する(always remember)
    userOptIn: ユーザーオプトイン(User opt-in)
    no: (don't save)
    
    *
    * @param string $deviceRemembering
    *
    * @return self
    */
    public function setDeviceRemembering(string $deviceRemembering) : self
    {
        $this->initialized['deviceRemembering'] = true;
        $this->deviceRemembering = $deviceRemembering;
        return $this;
    }
}
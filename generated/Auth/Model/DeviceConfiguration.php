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
    * always: 常に記憶する
    userOptIn: ユーザーオプトイン
    no: 記憶しない
    
    *
    * @var string
    */
    protected $deviceRemembering;
    /**
    * always: 常に記憶する
    userOptIn: ユーザーオプトイン
    no: 記憶しない
    
    *
    * @return string
    */
    public function getDeviceRemembering() : string
    {
        return $this->deviceRemembering;
    }
    /**
    * always: 常に記憶する
    userOptIn: ユーザーオプトイン
    no: 記憶しない
    
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
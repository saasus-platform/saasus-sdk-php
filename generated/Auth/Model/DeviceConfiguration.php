<?php

namespace AntiPatternInc\Saasus\Sdk\Auth\Model;

class DeviceConfiguration extends \ArrayObject
{
    /**
     * @var array
     */
    protected $initialized = [];
    public function isInitialized($property): bool
    {
        return array_key_exists($property, $this->initialized);
    }
    /**
    * always: always remember
    userOptIn: user opt-in
    no: don't save
    
    *
    * @var string|null
    */
    protected $deviceRemembering;
    /**
    * always: always remember
    userOptIn: user opt-in
    no: don't save
    
    *
    * @return string|null
    */
    public function getDeviceRemembering(): ?string
    {
        return $this->deviceRemembering;
    }
    /**
    * always: always remember
    userOptIn: user opt-in
    no: don't save
    
    *
    * @param string|null $deviceRemembering
    *
    * @return self
    */
    public function setDeviceRemembering(?string $deviceRemembering): self
    {
        $this->initialized['deviceRemembering'] = true;
        $this->deviceRemembering = $deviceRemembering;
        return $this;
    }
}
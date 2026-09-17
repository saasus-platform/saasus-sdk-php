<?php

namespace AntiPatternInc\Saasus\Sdk\Auth\Model;

class ConfirmDeviceResult extends \ArrayObject
{
    /**
     * @var array
     */
    protected $initialized = [];
    public function isInitialized($property) : bool
    {
        return array_key_exists($property, $this->initialized);
    }
    /**
    * When true, the user must confirm that they want to remember the device.
    When false, the device is immediately set as remembered.
    
    *
    * @var bool|null
    */
    protected $userConfirmationNecessary;
    /**
    * When true, the user must confirm that they want to remember the device.
    When false, the device is immediately set as remembered.
    
    *
    * @return bool|null
    */
    public function getUserConfirmationNecessary() : ?bool
    {
        return $this->userConfirmationNecessary;
    }
    /**
    * When true, the user must confirm that they want to remember the device.
    When false, the device is immediately set as remembered.
    
    *
    * @param bool|null $userConfirmationNecessary
    *
    * @return self
    */
    public function setUserConfirmationNecessary(?bool $userConfirmationNecessary) : self
    {
        $this->initialized['userConfirmationNecessary'] = true;
        $this->userConfirmationNecessary = $userConfirmationNecessary;
        return $this;
    }
}
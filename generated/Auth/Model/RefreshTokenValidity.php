<?php

namespace AntiPatternInc\Saasus\Sdk\Auth\Model;

class RefreshTokenValidity extends \ArrayObject
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
     * Refresh token validity value. The duration must be between 60 minutes and 10 years.
     *
     * @var int|null
     */
    protected $value;
    /**
    * Unit for the refresh token validity period.
    seconds: seconds
    minutes: minutes
    hours: hours
    days: days
    
    *
    * @var string|null
    */
    protected $unit;
    /**
     * Refresh token validity value. The duration must be between 60 minutes and 10 years.
     *
     * @return int|null
     */
    public function getValue() : ?int
    {
        return $this->value;
    }
    /**
     * Refresh token validity value. The duration must be between 60 minutes and 10 years.
     *
     * @param int|null $value
     *
     * @return self
     */
    public function setValue(?int $value) : self
    {
        $this->initialized['value'] = true;
        $this->value = $value;
        return $this;
    }
    /**
    * Unit for the refresh token validity period.
    seconds: seconds
    minutes: minutes
    hours: hours
    days: days
    
    *
    * @return string|null
    */
    public function getUnit() : ?string
    {
        return $this->unit;
    }
    /**
    * Unit for the refresh token validity period.
    seconds: seconds
    minutes: minutes
    hours: hours
    days: days
    
    *
    * @param string|null $unit
    *
    * @return self
    */
    public function setUnit(?string $unit) : self
    {
        $this->initialized['unit'] = true;
        $this->unit = $unit;
        return $this;
    }
}
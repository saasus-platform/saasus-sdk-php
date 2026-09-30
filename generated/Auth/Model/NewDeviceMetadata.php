<?php

namespace AntiPatternInc\Saasus\Sdk\Auth\Model;

class NewDeviceMetadata extends \ArrayObject
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
     * Device key identifier
     *
     * @var string|null
     */
    protected $deviceKey;
    /**
     * Device group key identifier
     *
     * @var string|null
     */
    protected $deviceGroupKey;
    /**
     * Device key identifier
     *
     * @return string|null
     */
    public function getDeviceKey() : ?string
    {
        return $this->deviceKey;
    }
    /**
     * Device key identifier
     *
     * @param string|null $deviceKey
     *
     * @return self
     */
    public function setDeviceKey(?string $deviceKey) : self
    {
        $this->initialized['deviceKey'] = true;
        $this->deviceKey = $deviceKey;
        return $this;
    }
    /**
     * Device group key identifier
     *
     * @return string|null
     */
    public function getDeviceGroupKey() : ?string
    {
        return $this->deviceGroupKey;
    }
    /**
     * Device group key identifier
     *
     * @param string|null $deviceGroupKey
     *
     * @return self
     */
    public function setDeviceGroupKey(?string $deviceGroupKey) : self
    {
        $this->initialized['deviceGroupKey'] = true;
        $this->deviceGroupKey = $deviceGroupKey;
        return $this;
    }
}
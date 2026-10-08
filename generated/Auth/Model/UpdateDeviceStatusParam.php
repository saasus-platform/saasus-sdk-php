<?php

namespace AntiPatternInc\Saasus\Sdk\Auth\Model;

class UpdateDeviceStatusParam extends \ArrayObject
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
     * A valid access token.
     *
     * @var string|null
     */
    protected $accessToken;
    /**
     * The unique identifier of the device.
     *
     * @var string|null
     */
    protected $deviceKey;
    /**
    * The status of whether a device is remembered.
    "remembered" enables device authentication, "not_remembered" disables it.
    
    *
    * @var string|null
    */
    protected $deviceRememberedStatus;
    /**
     * A valid access token.
     *
     * @return string|null
     */
    public function getAccessToken() : ?string
    {
        return $this->accessToken;
    }
    /**
     * A valid access token.
     *
     * @param string|null $accessToken
     *
     * @return self
     */
    public function setAccessToken(?string $accessToken) : self
    {
        $this->initialized['accessToken'] = true;
        $this->accessToken = $accessToken;
        return $this;
    }
    /**
     * The unique identifier of the device.
     *
     * @return string|null
     */
    public function getDeviceKey() : ?string
    {
        return $this->deviceKey;
    }
    /**
     * The unique identifier of the device.
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
    * The status of whether a device is remembered.
    "remembered" enables device authentication, "not_remembered" disables it.
    
    *
    * @return string|null
    */
    public function getDeviceRememberedStatus() : ?string
    {
        return $this->deviceRememberedStatus;
    }
    /**
    * The status of whether a device is remembered.
    "remembered" enables device authentication, "not_remembered" disables it.
    
    *
    * @param string|null $deviceRememberedStatus
    *
    * @return self
    */
    public function setDeviceRememberedStatus(?string $deviceRememberedStatus) : self
    {
        $this->initialized['deviceRememberedStatus'] = true;
        $this->deviceRememberedStatus = $deviceRememberedStatus;
        return $this;
    }
}
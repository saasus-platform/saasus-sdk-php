<?php

namespace AntiPatternInc\Saasus\Sdk\Auth\Model;

class ConfirmDeviceParam extends \ArrayObject
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
     * A friendly name for the device.
     *
     * @var string|null
     */
    protected $deviceName;
    /**
     * The configuration of the device secret verifier.
     *
     * @var DeviceSecretVerifierConfig|null
     */
    protected $deviceSecretVerifierConfig;
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
     * A friendly name for the device.
     *
     * @return string|null
     */
    public function getDeviceName() : ?string
    {
        return $this->deviceName;
    }
    /**
     * A friendly name for the device.
     *
     * @param string|null $deviceName
     *
     * @return self
     */
    public function setDeviceName(?string $deviceName) : self
    {
        $this->initialized['deviceName'] = true;
        $this->deviceName = $deviceName;
        return $this;
    }
    /**
     * The configuration of the device secret verifier.
     *
     * @return DeviceSecretVerifierConfig|null
     */
    public function getDeviceSecretVerifierConfig() : ?DeviceSecretVerifierConfig
    {
        return $this->deviceSecretVerifierConfig;
    }
    /**
     * The configuration of the device secret verifier.
     *
     * @param DeviceSecretVerifierConfig|null $deviceSecretVerifierConfig
     *
     * @return self
     */
    public function setDeviceSecretVerifierConfig(?DeviceSecretVerifierConfig $deviceSecretVerifierConfig) : self
    {
        $this->initialized['deviceSecretVerifierConfig'] = true;
        $this->deviceSecretVerifierConfig = $deviceSecretVerifierConfig;
        return $this;
    }
}
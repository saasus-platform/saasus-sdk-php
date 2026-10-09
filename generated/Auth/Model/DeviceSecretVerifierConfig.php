<?php

namespace AntiPatternInc\Saasus\Sdk\Auth\Model;

class DeviceSecretVerifierConfig extends \ArrayObject
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
     * A password verifier for a user's device. Used in SRP authentication.
     *
     * @var string|null
     */
    protected $passwordVerifier;
    /**
     * The salt for SRP authentication with the user's device.
     *
     * @var string|null
     */
    protected $salt;
    /**
     * A password verifier for a user's device. Used in SRP authentication.
     *
     * @return string|null
     */
    public function getPasswordVerifier() : ?string
    {
        return $this->passwordVerifier;
    }
    /**
     * A password verifier for a user's device. Used in SRP authentication.
     *
     * @param string|null $passwordVerifier
     *
     * @return self
     */
    public function setPasswordVerifier(?string $passwordVerifier) : self
    {
        $this->initialized['passwordVerifier'] = true;
        $this->passwordVerifier = $passwordVerifier;
        return $this;
    }
    /**
     * The salt for SRP authentication with the user's device.
     *
     * @return string|null
     */
    public function getSalt() : ?string
    {
        return $this->salt;
    }
    /**
     * The salt for SRP authentication with the user's device.
     *
     * @param string|null $salt
     *
     * @return self
     */
    public function setSalt(?string $salt) : self
    {
        $this->initialized['salt'] = true;
        $this->salt = $salt;
        return $this;
    }
}
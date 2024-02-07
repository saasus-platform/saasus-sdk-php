<?php

namespace AntiPatternInc\Saasus\Sdk\AwsMarketplace\Model;

class VerifyRegistrationTokenParam extends \ArrayObject
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
     * 
     *
     * @var string|null
     */
    protected $registrationToken;
    /**
     * 
     *
     * @return string|null
     */
    public function getRegistrationToken() : ?string
    {
        return $this->registrationToken;
    }
    /**
     * 
     *
     * @param string|null $registrationToken
     *
     * @return self
     */
    public function setRegistrationToken(?string $registrationToken) : self
    {
        $this->initialized['registrationToken'] = true;
        $this->registrationToken = $registrationToken;
        return $this;
    }
}
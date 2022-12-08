<?php

namespace AntiPatternInc\Saasus\Sdk\Auth\Model;

class UpdateSoftwareTokenParam extends \ArrayObject
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
     * @var string
     */
    protected $accessToken;
    /**
     * 
     *
     * @var string
     */
    protected $verificationCode;
    /**
     * 
     *
     * @return string
     */
    public function getAccessToken() : string
    {
        return $this->accessToken;
    }
    /**
     * 
     *
     * @param string $accessToken
     *
     * @return self
     */
    public function setAccessToken(string $accessToken) : self
    {
        $this->initialized['accessToken'] = true;
        $this->accessToken = $accessToken;
        return $this;
    }
    /**
     * 
     *
     * @return string
     */
    public function getVerificationCode() : string
    {
        return $this->verificationCode;
    }
    /**
     * 
     *
     * @param string $verificationCode
     *
     * @return self
     */
    public function setVerificationCode(string $verificationCode) : self
    {
        $this->initialized['verificationCode'] = true;
        $this->verificationCode = $verificationCode;
        return $this;
    }
}
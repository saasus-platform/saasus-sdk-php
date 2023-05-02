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
     * アクセストークン(access token)
     *
     * @var string
     */
    protected $accessToken;
    /**
     * 検証コード(verification code)
     *
     * @var string
     */
    protected $verificationCode;
    /**
     * アクセストークン(access token)
     *
     * @return string
     */
    public function getAccessToken() : string
    {
        return $this->accessToken;
    }
    /**
     * アクセストークン(access token)
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
     * 検証コード(verification code)
     *
     * @return string
     */
    public function getVerificationCode() : string
    {
        return $this->verificationCode;
    }
    /**
     * 検証コード(verification code)
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
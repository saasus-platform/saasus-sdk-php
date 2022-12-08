<?php

namespace AntiPatternInc\Saasus\Sdk\Auth\Model;

class RecaptchaProps extends \ArrayObject
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
     * Site key
     *
     * @var string
     */
    protected $siteKey;
    /**
     * Secret key
     *
     * @var string
     */
    protected $secretKey;
    /**
     * Site key
     *
     * @return string
     */
    public function getSiteKey() : string
    {
        return $this->siteKey;
    }
    /**
     * Site key
     *
     * @param string $siteKey
     *
     * @return self
     */
    public function setSiteKey(string $siteKey) : self
    {
        $this->initialized['siteKey'] = true;
        $this->siteKey = $siteKey;
        return $this;
    }
    /**
     * Secret key
     *
     * @return string
     */
    public function getSecretKey() : string
    {
        return $this->secretKey;
    }
    /**
     * Secret key
     *
     * @param string $secretKey
     *
     * @return self
     */
    public function setSecretKey(string $secretKey) : self
    {
        $this->initialized['secretKey'] = true;
        $this->secretKey = $secretKey;
        return $this;
    }
}
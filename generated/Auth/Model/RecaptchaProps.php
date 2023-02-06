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
     * サイトキー(site key)
     *
     * @var string
     */
    protected $siteKey;
    /**
     * シークレットキー(secret key)
     *
     * @var string
     */
    protected $secretKey;
    /**
     * サイトキー(site key)
     *
     * @return string
     */
    public function getSiteKey() : string
    {
        return $this->siteKey;
    }
    /**
     * サイトキー(site key)
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
     * シークレットキー(secret key)
     *
     * @return string
     */
    public function getSecretKey() : string
    {
        return $this->secretKey;
    }
    /**
     * シークレットキー(secret key)
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
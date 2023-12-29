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
     * @var string|null
     */
    protected $siteKey;
    /**
     * シークレットキー(secret key)
     *
     * @var string|null
     */
    protected $secretKey;
    /**
     * サイトキー(site key)
     *
     * @return string|null
     */
    public function getSiteKey() : ?string
    {
        return $this->siteKey;
    }
    /**
     * サイトキー(site key)
     *
     * @param string|null $siteKey
     *
     * @return self
     */
    public function setSiteKey(?string $siteKey) : self
    {
        $this->initialized['siteKey'] = true;
        $this->siteKey = $siteKey;
        return $this;
    }
    /**
     * シークレットキー(secret key)
     *
     * @return string|null
     */
    public function getSecretKey() : ?string
    {
        return $this->secretKey;
    }
    /**
     * シークレットキー(secret key)
     *
     * @param string|null $secretKey
     *
     * @return self
     */
    public function setSecretKey(?string $secretKey) : self
    {
        $this->initialized['secretKey'] = true;
        $this->secretKey = $secretKey;
        return $this;
    }
}
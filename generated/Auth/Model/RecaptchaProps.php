<?php

namespace AntiPatternInc\Saasus\Sdk\Auth\Model;

class RecaptchaProps extends \ArrayObject
{
    /**
     * @var array
     */
    protected $initialized = [];
    public function isInitialized($property): bool
    {
        return array_key_exists($property, $this->initialized);
    }
    /**
     * site key
     *
     * @var string|null
     */
    protected $siteKey;
    /**
     * secret key
     *
     * @var string|null
     */
    protected $secretKey;
    /**
     * site key
     *
     * @return string|null
     */
    public function getSiteKey(): ?string
    {
        return $this->siteKey;
    }
    /**
     * site key
     *
     * @param string|null $siteKey
     *
     * @return self
     */
    public function setSiteKey(?string $siteKey): self
    {
        $this->initialized['siteKey'] = true;
        $this->siteKey = $siteKey;
        return $this;
    }
    /**
     * secret key
     *
     * @return string|null
     */
    public function getSecretKey(): ?string
    {
        return $this->secretKey;
    }
    /**
     * secret key
     *
     * @param string|null $secretKey
     *
     * @return self
     */
    public function setSecretKey(?string $secretKey): self
    {
        $this->initialized['secretKey'] = true;
        $this->secretKey = $secretKey;
        return $this;
    }
}
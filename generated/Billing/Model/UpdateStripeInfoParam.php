<?php

namespace AntiPatternInc\Saasus\Sdk\Billing\Model;

class UpdateStripeInfoParam extends \ArrayObject
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
     * シークレットキー(secret key)
     *
     * @var string
     */
    protected $secretKey;
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
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
     * 
     *
     * @var string
     */
    protected $secretKey;
    /**
     * 
     *
     * @return string
     */
    public function getSecretKey() : string
    {
        return $this->secretKey;
    }
    /**
     * 
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
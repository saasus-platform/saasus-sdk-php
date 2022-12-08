<?php

namespace AntiPatternInc\Saasus\Sdk\Auth\Model;

class SoftwareTokenSecretCode extends \ArrayObject
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
    protected $secretCode;
    /**
     * 
     *
     * @return string
     */
    public function getSecretCode() : string
    {
        return $this->secretCode;
    }
    /**
     * 
     *
     * @param string $secretCode
     *
     * @return self
     */
    public function setSecretCode(string $secretCode) : self
    {
        $this->initialized['secretCode'] = true;
        $this->secretCode = $secretCode;
        return $this;
    }
}
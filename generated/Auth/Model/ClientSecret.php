<?php

namespace AntiPatternInc\Saasus\Sdk\Auth\Model;

class ClientSecret extends \ArrayObject
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
     * クライアントシークレット(client secret)
     *
     * @var string
     */
    protected $clientSecret;
    /**
     * クライアントシークレット(client secret)
     *
     * @return string
     */
    public function getClientSecret() : string
    {
        return $this->clientSecret;
    }
    /**
     * クライアントシークレット(client secret)
     *
     * @param string $clientSecret
     *
     * @return self
     */
    public function setClientSecret(string $clientSecret) : self
    {
        $this->initialized['clientSecret'] = true;
        $this->clientSecret = $clientSecret;
        return $this;
    }
}
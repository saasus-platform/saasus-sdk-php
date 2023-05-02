<?php

namespace AntiPatternInc\Saasus\Sdk\Auth\Model;

class AuthInfo extends \ArrayObject
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
     * 認証後遷移先(Redirect After Authentication)
     *
     * @var string
     */
    protected $callbackUrl;
    /**
     * 認証後遷移先(Redirect After Authentication)
     *
     * @return string
     */
    public function getCallbackUrl() : string
    {
        return $this->callbackUrl;
    }
    /**
     * 認証後遷移先(Redirect After Authentication)
     *
     * @param string $callbackUrl
     *
     * @return self
     */
    public function setCallbackUrl(string $callbackUrl) : self
    {
        $this->initialized['callbackUrl'] = true;
        $this->callbackUrl = $callbackUrl;
        return $this;
    }
}
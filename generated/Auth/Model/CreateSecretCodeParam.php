<?php

namespace AntiPatternInc\Saasus\Sdk\Auth\Model;

class CreateSecretCodeParam extends \ArrayObject
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
     * @var string|null
     */
    protected $accessToken;
    /**
     * アクセストークン(access token)
     *
     * @return string|null
     */
    public function getAccessToken() : ?string
    {
        return $this->accessToken;
    }
    /**
     * アクセストークン(access token)
     *
     * @param string|null $accessToken
     *
     * @return self
     */
    public function setAccessToken(?string $accessToken) : self
    {
        $this->initialized['accessToken'] = true;
        $this->accessToken = $accessToken;
        return $this;
    }
}
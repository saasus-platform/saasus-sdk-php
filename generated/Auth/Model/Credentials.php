<?php

namespace AntiPatternInc\Saasus\Sdk\Auth\Model;

class Credentials extends \ArrayObject
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
    protected $idToken;
    /**
     * 
     *
     * @var string
     */
    protected $accessToken;
    /**
     * 
     *
     * @var string
     */
    protected $refreshToken;
    /**
     * 
     *
     * @return string
     */
    public function getIdToken() : string
    {
        return $this->idToken;
    }
    /**
     * 
     *
     * @param string $idToken
     *
     * @return self
     */
    public function setIdToken(string $idToken) : self
    {
        $this->initialized['idToken'] = true;
        $this->idToken = $idToken;
        return $this;
    }
    /**
     * 
     *
     * @return string
     */
    public function getAccessToken() : string
    {
        return $this->accessToken;
    }
    /**
     * 
     *
     * @param string $accessToken
     *
     * @return self
     */
    public function setAccessToken(string $accessToken) : self
    {
        $this->initialized['accessToken'] = true;
        $this->accessToken = $accessToken;
        return $this;
    }
    /**
     * 
     *
     * @return string
     */
    public function getRefreshToken() : string
    {
        return $this->refreshToken;
    }
    /**
     * 
     *
     * @param string $refreshToken
     *
     * @return self
     */
    public function setRefreshToken(string $refreshToken) : self
    {
        $this->initialized['refreshToken'] = true;
        $this->refreshToken = $refreshToken;
        return $this;
    }
}
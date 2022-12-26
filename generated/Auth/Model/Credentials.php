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
     * IDトークン(ID token)
     *
     * @var string
     */
    protected $idToken;
    /**
     * アクセストークン(access token)
     *
     * @var string
     */
    protected $accessToken;
    /**
     * リフレッシュトークン(refresh token)
     *
     * @var string
     */
    protected $refreshToken;
    /**
     * IDトークン(ID token)
     *
     * @return string
     */
    public function getIdToken() : string
    {
        return $this->idToken;
    }
    /**
     * IDトークン(ID token)
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
     * アクセストークン(access token)
     *
     * @return string
     */
    public function getAccessToken() : string
    {
        return $this->accessToken;
    }
    /**
     * アクセストークン(access token)
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
     * リフレッシュトークン(refresh token)
     *
     * @return string
     */
    public function getRefreshToken() : string
    {
        return $this->refreshToken;
    }
    /**
     * リフレッシュトークン(refresh token)
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
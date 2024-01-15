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
     * @var string|null
     */
    protected $idToken;
    /**
     * アクセストークン(access token)
     *
     * @var string|null
     */
    protected $accessToken;
    /**
     * リフレッシュトークン(refresh token)
     *
     * @var string|null
     */
    protected $refreshToken;
    /**
     * IDトークン(ID token)
     *
     * @return string|null
     */
    public function getIdToken() : ?string
    {
        return $this->idToken;
    }
    /**
     * IDトークン(ID token)
     *
     * @param string|null $idToken
     *
     * @return self
     */
    public function setIdToken(?string $idToken) : self
    {
        $this->initialized['idToken'] = true;
        $this->idToken = $idToken;
        return $this;
    }
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
    /**
     * リフレッシュトークン(refresh token)
     *
     * @return string|null
     */
    public function getRefreshToken() : ?string
    {
        return $this->refreshToken;
    }
    /**
     * リフレッシュトークン(refresh token)
     *
     * @param string|null $refreshToken
     *
     * @return self
     */
    public function setRefreshToken(?string $refreshToken) : self
    {
        $this->initialized['refreshToken'] = true;
        $this->refreshToken = $refreshToken;
        return $this;
    }
}
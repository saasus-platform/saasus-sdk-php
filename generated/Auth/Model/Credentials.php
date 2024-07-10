<?php

namespace AntiPatternInc\Saasus\Sdk\Auth\Model;

class Credentials extends \ArrayObject
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
     * ID token
     *
     * @var string|null
     */
    protected $idToken;
    /**
     * Access token
     *
     * @var string|null
     */
    protected $accessToken;
    /**
     * Refresh token
     *
     * @var string|null
     */
    protected $refreshToken;
    /**
     * ID token
     *
     * @return string|null
     */
    public function getIdToken(): ?string
    {
        return $this->idToken;
    }
    /**
     * ID token
     *
     * @param string|null $idToken
     *
     * @return self
     */
    public function setIdToken(?string $idToken): self
    {
        $this->initialized['idToken'] = true;
        $this->idToken = $idToken;
        return $this;
    }
    /**
     * Access token
     *
     * @return string|null
     */
    public function getAccessToken(): ?string
    {
        return $this->accessToken;
    }
    /**
     * Access token
     *
     * @param string|null $accessToken
     *
     * @return self
     */
    public function setAccessToken(?string $accessToken): self
    {
        $this->initialized['accessToken'] = true;
        $this->accessToken = $accessToken;
        return $this;
    }
    /**
     * Refresh token
     *
     * @return string|null
     */
    public function getRefreshToken(): ?string
    {
        return $this->refreshToken;
    }
    /**
     * Refresh token
     *
     * @param string|null $refreshToken
     *
     * @return self
     */
    public function setRefreshToken(?string $refreshToken): self
    {
        $this->initialized['refreshToken'] = true;
        $this->refreshToken = $refreshToken;
        return $this;
    }
}
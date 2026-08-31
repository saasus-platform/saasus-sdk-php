<?php

namespace AntiPatternInc\Saasus\Sdk\Auth\Model;

class RevokeTokenParam extends \ArrayObject
{
    /**
     * @var array
     */
    protected $initialized = [];
    public function isInitialized($property) : bool
    {
        return array_key_exists($property, $this->initialized);
    }
    /**
     * Refresh token to revoke
     *
     * @var string|null
     */
    protected $refreshToken;
    /**
     * Refresh token to revoke
     *
     * @return string|null
     */
    public function getRefreshToken() : ?string
    {
        return $this->refreshToken;
    }
    /**
     * Refresh token to revoke
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
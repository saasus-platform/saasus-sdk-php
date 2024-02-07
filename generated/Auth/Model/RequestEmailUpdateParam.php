<?php

namespace AntiPatternInc\Saasus\Sdk\Auth\Model;

class RequestEmailUpdateParam extends \ArrayObject
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
     * メールアドレス(Email Address)
     *
     * @var string|null
     */
    protected $email;
    /**
     * 
     *
     * @var string|null
     */
    protected $accessToken;
    /**
     * メールアドレス(Email Address)
     *
     * @return string|null
     */
    public function getEmail() : ?string
    {
        return $this->email;
    }
    /**
     * メールアドレス(Email Address)
     *
     * @param string|null $email
     *
     * @return self
     */
    public function setEmail(?string $email) : self
    {
        $this->initialized['email'] = true;
        $this->email = $email;
        return $this;
    }
    /**
     * 
     *
     * @return string|null
     */
    public function getAccessToken() : ?string
    {
        return $this->accessToken;
    }
    /**
     * 
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
<?php

namespace AntiPatternInc\Saasus\Sdk\Auth\Model;

class ValidateInvitationParam extends \ArrayObject
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
     * 招待されたユーザーのアクセストークン(access token of the invited user)
     *
     * @var string|null
     */
    protected $accessToken;
    /**
     * 招待されたユーザーのメールアドレス(email address of the invited user)
     *
     * @var string|null
     */
    protected $email;
    /**
     * 招待されたユーザーのパスワード(password of the invited user)
     *
     * @var string|null
     */
    protected $password;
    /**
     * 招待されたユーザーのアクセストークン(access token of the invited user)
     *
     * @return string|null
     */
    public function getAccessToken() : ?string
    {
        return $this->accessToken;
    }
    /**
     * 招待されたユーザーのアクセストークン(access token of the invited user)
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
     * 招待されたユーザーのメールアドレス(email address of the invited user)
     *
     * @return string|null
     */
    public function getEmail() : ?string
    {
        return $this->email;
    }
    /**
     * 招待されたユーザーのメールアドレス(email address of the invited user)
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
     * 招待されたユーザーのパスワード(password of the invited user)
     *
     * @return string|null
     */
    public function getPassword() : ?string
    {
        return $this->password;
    }
    /**
     * 招待されたユーザーのパスワード(password of the invited user)
     *
     * @param string|null $password
     *
     * @return self
     */
    public function setPassword(?string $password) : self
    {
        $this->initialized['password'] = true;
        $this->password = $password;
        return $this;
    }
}
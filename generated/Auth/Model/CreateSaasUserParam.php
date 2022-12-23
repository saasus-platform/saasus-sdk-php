<?php

namespace AntiPatternInc\Saasus\Sdk\Auth\Model;

class CreateSaasUserParam extends \ArrayObject
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
     * メールアドレス(e-mail)
     *
     * @var string
     */
    protected $email;
    /**
     * パスワード(password)
     *
     * @var string
     */
    protected $password;
    /**
     * メールアドレス(e-mail)
     *
     * @return string
     */
    public function getEmail() : string
    {
        return $this->email;
    }
    /**
     * メールアドレス(e-mail)
     *
     * @param string $email
     *
     * @return self
     */
    public function setEmail(string $email) : self
    {
        $this->initialized['email'] = true;
        $this->email = $email;
        return $this;
    }
    /**
     * パスワード(password)
     *
     * @return string
     */
    public function getPassword() : string
    {
        return $this->password;
    }
    /**
     * パスワード(password)
     *
     * @param string $password
     *
     * @return self
     */
    public function setPassword(string $password) : self
    {
        $this->initialized['password'] = true;
        $this->password = $password;
        return $this;
    }
}
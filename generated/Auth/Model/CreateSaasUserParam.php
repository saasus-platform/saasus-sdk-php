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
     * メールアドレス(E-mail)
     *
     * @var string
     */
    protected $email;
    /**
     * パスワード(Password)
     *
     * @var string
     */
    protected $password;
    /**
     * メールアドレス(E-mail)
     *
     * @return string
     */
    public function getEmail() : string
    {
        return $this->email;
    }
    /**
     * メールアドレス(E-mail)
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
     * パスワード(Password)
     *
     * @return string
     */
    public function getPassword() : string
    {
        return $this->password;
    }
    /**
     * パスワード(Password)
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
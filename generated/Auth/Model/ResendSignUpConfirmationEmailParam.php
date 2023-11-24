<?php

namespace AntiPatternInc\Saasus\Sdk\Auth\Model;

class ResendSignUpConfirmationEmailParam extends \ArrayObject
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
     * @var string
     */
    protected $email;
    /**
     * メールアドレス(Email Address)
     *
     * @return string
     */
    public function getEmail() : string
    {
        return $this->email;
    }
    /**
     * メールアドレス(Email Address)
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
}
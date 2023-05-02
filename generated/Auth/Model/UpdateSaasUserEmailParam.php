<?php

namespace AntiPatternInc\Saasus\Sdk\Auth\Model;

class UpdateSaasUserEmailParam extends \ArrayObject
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
}
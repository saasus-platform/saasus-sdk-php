<?php

namespace AntiPatternInc\Saasus\Sdk\Auth\Model;

class UpdateSaasUserPasswordParam extends \ArrayObject
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
     * パスワード(password)
     *
     * @var string|null
     */
    protected $password;
    /**
     * パスワード(password)
     *
     * @return string|null
     */
    public function getPassword() : ?string
    {
        return $this->password;
    }
    /**
     * パスワード(password)
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
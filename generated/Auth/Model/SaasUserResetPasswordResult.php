<?php

namespace AntiPatternInc\Saasus\Sdk\Auth\Model;

class SaasUserResetPasswordResult extends \ArrayObject
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
     * Auto-generated temporary password
     *
     * @var string|null
     */
    protected $password;
    /**
     * Auto-generated temporary password
     *
     * @return string|null
     */
    public function getPassword() : ?string
    {
        return $this->password;
    }
    /**
     * Auto-generated temporary password
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
<?php

namespace AntiPatternInc\Saasus\Sdk\Auth\Model;

class UpdateSaasUserPasswordParam extends \ArrayObject
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
     * Password
     *
     * @var string|null
     */
    protected $password;
    /**
     * Set to true to mark the new password as a temporary password (user must change on next sign-in)
     *
     * @var bool|null
     */
    protected $temporary;
    /**
     * Password
     *
     * @return string|null
     */
    public function getPassword() : ?string
    {
        return $this->password;
    }
    /**
     * Password
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
    /**
     * Set to true to mark the new password as a temporary password (user must change on next sign-in)
     *
     * @return bool|null
     */
    public function getTemporary() : ?bool
    {
        return $this->temporary;
    }
    /**
     * Set to true to mark the new password as a temporary password (user must change on next sign-in)
     *
     * @param bool|null $temporary
     *
     * @return self
     */
    public function setTemporary(?bool $temporary) : self
    {
        $this->initialized['temporary'] = true;
        $this->temporary = $temporary;
        return $this;
    }
}
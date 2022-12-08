<?php

namespace AntiPatternInc\Saasus\Sdk\Auth\Model;

class Roles extends \ArrayObject
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
     * 
     *
     * @var Role[]
     */
    protected $roles;
    /**
     * 
     *
     * @return Role[]
     */
    public function getRoles() : array
    {
        return $this->roles;
    }
    /**
     * 
     *
     * @param Role[] $roles
     *
     * @return self
     */
    public function setRoles(array $roles) : self
    {
        $this->initialized['roles'] = true;
        $this->roles = $roles;
        return $this;
    }
}
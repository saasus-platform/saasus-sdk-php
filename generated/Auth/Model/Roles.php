<?php

namespace AntiPatternInc\Saasus\Sdk\Auth\Model;

class Roles extends \ArrayObject
{
    /**
     * @var array
     */
    protected $initialized = [];
    public function isInitialized($property): bool
    {
        return array_key_exists($property, $this->initialized);
    }
    /**
     * 
     *
     * @var list<Role>|null
     */
    protected $roles;
    /**
     * 
     *
     * @return list<Role>|null
     */
    public function getRoles(): ?array
    {
        return $this->roles;
    }
    /**
     * 
     *
     * @param list<Role>|null $roles
     *
     * @return self
     */
    public function setRoles(?array $roles): self
    {
        $this->initialized['roles'] = true;
        $this->roles = $roles;
        return $this;
    }
}
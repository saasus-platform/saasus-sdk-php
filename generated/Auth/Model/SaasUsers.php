<?php

namespace AntiPatternInc\Saasus\Sdk\Auth\Model;

class SaasUsers extends \ArrayObject
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
     * @var list<SaasUser>|null
     */
    protected $users;
    /**
     * 
     *
     * @return list<SaasUser>|null
     */
    public function getUsers(): ?array
    {
        return $this->users;
    }
    /**
     * 
     *
     * @param list<SaasUser>|null $users
     *
     * @return self
     */
    public function setUsers(?array $users): self
    {
        $this->initialized['users'] = true;
        $this->users = $users;
        return $this;
    }
}
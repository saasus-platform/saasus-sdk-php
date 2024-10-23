<?php

namespace AntiPatternInc\Saasus\Sdk\Communication\Model;

class Users extends \ArrayObject
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
     * @var list<User>|null
     */
    protected $users;
    /**
     * 
     *
     * @return list<User>|null
     */
    public function getUsers(): ?array
    {
        return $this->users;
    }
    /**
     * 
     *
     * @param list<User>|null $users
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
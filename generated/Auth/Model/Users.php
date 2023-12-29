<?php

namespace AntiPatternInc\Saasus\Sdk\Auth\Model;

class Users extends \ArrayObject
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
     * @var User[]|null
     */
    protected $users;
    /**
     * 
     *
     * @return User[]|null
     */
    public function getUsers() : ?array
    {
        return $this->users;
    }
    /**
     * 
     *
     * @param User[]|null $users
     *
     * @return self
     */
    public function setUsers(?array $users) : self
    {
        $this->initialized['users'] = true;
        $this->users = $users;
        return $this;
    }
}
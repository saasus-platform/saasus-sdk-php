<?php

namespace AntiPatternInc\Saasus\Sdk\Communication\Model;

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
     * @var User[]
     */
    protected $users;
    /**
     * 
     *
     * @return User[]
     */
    public function getUsers() : array
    {
        return $this->users;
    }
    /**
     * 
     *
     * @param User[] $users
     *
     * @return self
     */
    public function setUsers(array $users) : self
    {
        $this->initialized['users'] = true;
        $this->users = $users;
        return $this;
    }
}
<?php

namespace AntiPatternInc\Saasus\Sdk\Communication\Model;

class Votes extends \ArrayObject
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
     * @var int|null
     */
    protected $count;
    /**
     * 
     *
     * @var User[]|null
     */
    protected $users;
    /**
     * 
     *
     * @return int|null
     */
    public function getCount() : ?int
    {
        return $this->count;
    }
    /**
     * 
     *
     * @param int|null $count
     *
     * @return self
     */
    public function setCount(?int $count) : self
    {
        $this->initialized['count'] = true;
        $this->count = $count;
        return $this;
    }
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
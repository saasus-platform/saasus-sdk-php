<?php

namespace AntiPatternInc\Saasus\Sdk\Auth\Model;

class SearchTenantUsersResult extends \ArrayObject
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
     * 
     *
     * @var list<User>|null
     */
    protected $users;
    /**
     * Pagination cursor for the next page
     *
     * @var string|null
     */
    protected $cursor;
    /**
     * 
     *
     * @return list<User>|null
     */
    public function getUsers() : ?array
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
    public function setUsers(?array $users) : self
    {
        $this->initialized['users'] = true;
        $this->users = $users;
        return $this;
    }
    /**
     * Pagination cursor for the next page
     *
     * @return string|null
     */
    public function getCursor() : ?string
    {
        return $this->cursor;
    }
    /**
     * Pagination cursor for the next page
     *
     * @param string|null $cursor
     *
     * @return self
     */
    public function setCursor(?string $cursor) : self
    {
        $this->initialized['cursor'] = true;
        $this->cursor = $cursor;
        return $this;
    }
}
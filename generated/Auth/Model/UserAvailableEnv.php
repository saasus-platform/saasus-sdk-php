<?php

namespace AntiPatternInc\Saasus\Sdk\Auth\Model;

class UserAvailableEnv extends \ArrayObject
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
     * @var int
     */
    protected $id;
    /**
     * 環境名
     *
     * @var string
     */
    protected $name;
    /**
     * 役割情報
     *
     * @var Role[]
     */
    protected $roles;
    /**
     * 
     *
     * @return int
     */
    public function getId() : int
    {
        return $this->id;
    }
    /**
     * 
     *
     * @param int $id
     *
     * @return self
     */
    public function setId(int $id) : self
    {
        $this->initialized['id'] = true;
        $this->id = $id;
        return $this;
    }
    /**
     * 環境名
     *
     * @return string
     */
    public function getName() : string
    {
        return $this->name;
    }
    /**
     * 環境名
     *
     * @param string $name
     *
     * @return self
     */
    public function setName(string $name) : self
    {
        $this->initialized['name'] = true;
        $this->name = $name;
        return $this;
    }
    /**
     * 役割情報
     *
     * @return Role[]
     */
    public function getRoles() : array
    {
        return $this->roles;
    }
    /**
     * 役割情報
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
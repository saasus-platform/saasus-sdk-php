<?php

namespace AntiPatternInc\Saasus\Sdk\Auth\Model;

class CreateTenantInvitationParamEnvsItem extends \ArrayObject
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
     * 役割名(role name)
     *
     * @var string[]
     */
    protected $roleNames;
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
     * 役割名(role name)
     *
     * @return string[]
     */
    public function getRoleNames() : array
    {
        return $this->roleNames;
    }
    /**
     * 役割名(role name)
     *
     * @param string[] $roleNames
     *
     * @return self
     */
    public function setRoleNames(array $roleNames) : self
    {
        $this->initialized['roleNames'] = true;
        $this->roleNames = $roleNames;
        return $this;
    }
}
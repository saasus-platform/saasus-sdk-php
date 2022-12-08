<?php

namespace AntiPatternInc\Saasus\Sdk\Auth\Model;

class CreateTenantUserRolesParam extends \ArrayObject
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
     * 役割情報
     *
     * @var string[]
     */
    protected $roleNames;
    /**
     * 役割情報
     *
     * @return string[]
     */
    public function getRoleNames() : array
    {
        return $this->roleNames;
    }
    /**
     * 役割情報
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
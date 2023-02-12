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
     * 役割(ロール)情報(Role Info)
     *
     * @var string[]
     */
    protected $roleNames;
    /**
     * 役割(ロール)情報(Role Info)
     *
     * @return string[]
     */
    public function getRoleNames() : array
    {
        return $this->roleNames;
    }
    /**
     * 役割(ロール)情報(Role Info)
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
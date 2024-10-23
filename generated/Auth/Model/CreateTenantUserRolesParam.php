<?php

namespace AntiPatternInc\Saasus\Sdk\Auth\Model;

class CreateTenantUserRolesParam extends \ArrayObject
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
     * Role Info
     *
     * @var list<string>|null
     */
    protected $roleNames;
    /**
     * Role Info
     *
     * @return list<string>|null
     */
    public function getRoleNames(): ?array
    {
        return $this->roleNames;
    }
    /**
     * Role Info
     *
     * @param list<string>|null $roleNames
     *
     * @return self
     */
    public function setRoleNames(?array $roleNames): self
    {
        $this->initialized['roleNames'] = true;
        $this->roleNames = $roleNames;
        return $this;
    }
}
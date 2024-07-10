<?php

namespace AntiPatternInc\Saasus\Sdk\Auth\Model;

class CreateTenantInvitationParamEnvsItem extends \ArrayObject
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
     * @var int|null
     */
    protected $id;
    /**
     * Role name
     *
     * @var list<string>|null
     */
    protected $roleNames;
    /**
     * 
     *
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }
    /**
     * 
     *
     * @param int|null $id
     *
     * @return self
     */
    public function setId(?int $id): self
    {
        $this->initialized['id'] = true;
        $this->id = $id;
        return $this;
    }
    /**
     * Role name
     *
     * @return list<string>|null
     */
    public function getRoleNames(): ?array
    {
        return $this->roleNames;
    }
    /**
     * Role name
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
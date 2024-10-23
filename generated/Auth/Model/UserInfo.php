<?php

namespace AntiPatternInc\Saasus\Sdk\Auth\Model;

class UserInfo extends \ArrayObject
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
     * @var string|null
     */
    protected $id;
    /**
     * E-mail
     *
     * @var string|null
     */
    protected $email;
    /**
     * Tenant Info
     *
     * @var list<UserAvailableTenant>|null
     */
    protected $tenants;
    /**
     * 
     *
     * @return string|null
     */
    public function getId(): ?string
    {
        return $this->id;
    }
    /**
     * 
     *
     * @param string|null $id
     *
     * @return self
     */
    public function setId(?string $id): self
    {
        $this->initialized['id'] = true;
        $this->id = $id;
        return $this;
    }
    /**
     * E-mail
     *
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }
    /**
     * E-mail
     *
     * @param string|null $email
     *
     * @return self
     */
    public function setEmail(?string $email): self
    {
        $this->initialized['email'] = true;
        $this->email = $email;
        return $this;
    }
    /**
     * Tenant Info
     *
     * @return list<UserAvailableTenant>|null
     */
    public function getTenants(): ?array
    {
        return $this->tenants;
    }
    /**
     * Tenant Info
     *
     * @param list<UserAvailableTenant>|null $tenants
     *
     * @return self
     */
    public function setTenants(?array $tenants): self
    {
        $this->initialized['tenants'] = true;
        $this->tenants = $tenants;
        return $this;
    }
}
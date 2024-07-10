<?php

namespace AntiPatternInc\Saasus\Sdk\Auth\Model;

class User extends \ArrayObject
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
     * User ID
     *
     * @var string|null
     */
    protected $id;
    /**
     * 
     *
     * @var string|null
     */
    protected $tenantId;
    /**
     * Tenant Name
     *
     * @var string|null
     */
    protected $tenantName;
    /**
     * E-mail
     *
     * @var string|null
     */
    protected $email;
    /**
     * Attribute information (Get information set by defining user attributes in the SaaS development console)
     *
     * @var array<string, mixed>|null
     */
    protected $attributes;
    /**
     * 
     *
     * @var list<object>|null
     */
    protected $envs;
    /**
     * User ID
     *
     * @return string|null
     */
    public function getId(): ?string
    {
        return $this->id;
    }
    /**
     * User ID
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
     * 
     *
     * @return string|null
     */
    public function getTenantId(): ?string
    {
        return $this->tenantId;
    }
    /**
     * 
     *
     * @param string|null $tenantId
     *
     * @return self
     */
    public function setTenantId(?string $tenantId): self
    {
        $this->initialized['tenantId'] = true;
        $this->tenantId = $tenantId;
        return $this;
    }
    /**
     * Tenant Name
     *
     * @return string|null
     */
    public function getTenantName(): ?string
    {
        return $this->tenantName;
    }
    /**
     * Tenant Name
     *
     * @param string|null $tenantName
     *
     * @return self
     */
    public function setTenantName(?string $tenantName): self
    {
        $this->initialized['tenantName'] = true;
        $this->tenantName = $tenantName;
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
     * Attribute information (Get information set by defining user attributes in the SaaS development console)
     *
     * @return array<string, mixed>|null
     */
    public function getAttributes(): ?iterable
    {
        return $this->attributes;
    }
    /**
     * Attribute information (Get information set by defining user attributes in the SaaS development console)
     *
     * @param array<string, mixed>|null $attributes
     *
     * @return self
     */
    public function setAttributes(?iterable $attributes): self
    {
        $this->initialized['attributes'] = true;
        $this->attributes = $attributes;
        return $this;
    }
    /**
     * 
     *
     * @return list<object>|null
     */
    public function getEnvs(): ?array
    {
        return $this->envs;
    }
    /**
     * 
     *
     * @param list<object>|null $envs
     *
     * @return self
     */
    public function setEnvs(?array $envs): self
    {
        $this->initialized['envs'] = true;
        $this->envs = $envs;
        return $this;
    }
}
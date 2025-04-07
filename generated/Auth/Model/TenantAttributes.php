<?php

namespace AntiPatternInc\Saasus\Sdk\Auth\Model;

class TenantAttributes extends \ArrayObject
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
     * Tenant Attribute Definition
     *
     * @var list<Attribute>|null
     */
    protected $tenantAttributes;
    /**
     * Tenant Attribute Definition
     *
     * @return list<Attribute>|null
     */
    public function getTenantAttributes(): ?array
    {
        return $this->tenantAttributes;
    }
    /**
     * Tenant Attribute Definition
     *
     * @param list<Attribute>|null $tenantAttributes
     *
     * @return self
     */
    public function setTenantAttributes(?array $tenantAttributes): self
    {
        $this->initialized['tenantAttributes'] = true;
        $this->tenantAttributes = $tenantAttributes;
        return $this;
    }
}
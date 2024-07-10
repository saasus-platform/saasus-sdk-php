<?php

namespace AntiPatternInc\Saasus\Sdk\Auth\Model;

class Tenants extends \ArrayObject
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
     * @var list<array<string, mixed>>|null
     */
    protected $tenants;
    /**
     * 
     *
     * @return list<array<string, mixed>>|null
     */
    public function getTenants(): ?array
    {
        return $this->tenants;
    }
    /**
     * 
     *
     * @param list<array<string, mixed>>|null $tenants
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
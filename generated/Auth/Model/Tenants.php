<?php

namespace AntiPatternInc\Saasus\Sdk\Auth\Model;

class Tenants extends \ArrayObject
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
     * @var array<string, mixed>[]|null
     */
    protected $tenants;
    /**
     * 
     *
     * @return array<string, mixed>[]|null
     */
    public function getTenants() : ?array
    {
        return $this->tenants;
    }
    /**
     * 
     *
     * @param array<string, mixed>[]|null $tenants
     *
     * @return self
     */
    public function setTenants(?array $tenants) : self
    {
        $this->initialized['tenants'] = true;
        $this->tenants = $tenants;
        return $this;
    }
}
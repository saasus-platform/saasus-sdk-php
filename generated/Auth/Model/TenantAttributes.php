<?php

namespace AntiPatternInc\Saasus\Sdk\Auth\Model;

class TenantAttributes extends \ArrayObject
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
     * テナント属性定義(Tenant attribute definition)
     *
     * @var Attribute[]
     */
    protected $tenantAttributes;
    /**
     * テナント属性定義(Tenant attribute definition)
     *
     * @return Attribute[]
     */
    public function getTenantAttributes() : array
    {
        return $this->tenantAttributes;
    }
    /**
     * テナント属性定義(Tenant attribute definition)
     *
     * @param Attribute[] $tenantAttributes
     *
     * @return self
     */
    public function setTenantAttributes(array $tenantAttributes) : self
    {
        $this->initialized['tenantAttributes'] = true;
        $this->tenantAttributes = $tenantAttributes;
        return $this;
    }
}
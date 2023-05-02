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
     * テナント属性定義(Tenant Attribute Definition)
     *
     * @var Attribute[]
     */
    protected $tenantAttributes;
    /**
     * テナント属性定義(Tenant Attribute Definition)
     *
     * @return Attribute[]
     */
    public function getTenantAttributes() : array
    {
        return $this->tenantAttributes;
    }
    /**
     * テナント属性定義(Tenant Attribute Definition)
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
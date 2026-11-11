<?php

namespace AntiPatternInc\Saasus\Sdk\Auth\Model;

class SaveTenantUsersCountsParam extends \ArrayObject
{
    /**
     * @var array
     */
    protected $initialized = [];
    public function isInitialized($property) : bool
    {
        return array_key_exists($property, $this->initialized);
    }
    /**
     * 
     *
     * @var list<SaveTenantUserCountParam>|null
     */
    protected $tenantUserCounts;
    /**
     * 
     *
     * @return list<SaveTenantUserCountParam>|null
     */
    public function getTenantUserCounts() : ?array
    {
        return $this->tenantUserCounts;
    }
    /**
     * 
     *
     * @param list<SaveTenantUserCountParam>|null $tenantUserCounts
     *
     * @return self
     */
    public function setTenantUserCounts(?array $tenantUserCounts) : self
    {
        $this->initialized['tenantUserCounts'] = true;
        $this->tenantUserCounts = $tenantUserCounts;
        return $this;
    }
}
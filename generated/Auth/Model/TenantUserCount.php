<?php

namespace AntiPatternInc\Saasus\Sdk\Auth\Model;

class TenantUserCount extends \ArrayObject
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
     * @var string|null
     */
    protected $tenantId;
    /**
     * Count of tenant users
     *
     * @var int|null
     */
    protected $count;
    /**
     * Unix timestamp (seconds) of the last update
     *
     * @var int|null
     */
    protected $updatedAt;
    /**
     * 
     *
     * @return string|null
     */
    public function getTenantId() : ?string
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
    public function setTenantId(?string $tenantId) : self
    {
        $this->initialized['tenantId'] = true;
        $this->tenantId = $tenantId;
        return $this;
    }
    /**
     * Count of tenant users
     *
     * @return int|null
     */
    public function getCount() : ?int
    {
        return $this->count;
    }
    /**
     * Count of tenant users
     *
     * @param int|null $count
     *
     * @return self
     */
    public function setCount(?int $count) : self
    {
        $this->initialized['count'] = true;
        $this->count = $count;
        return $this;
    }
    /**
     * Unix timestamp (seconds) of the last update
     *
     * @return int|null
     */
    public function getUpdatedAt() : ?int
    {
        return $this->updatedAt;
    }
    /**
     * Unix timestamp (seconds) of the last update
     *
     * @param int|null $updatedAt
     *
     * @return self
     */
    public function setUpdatedAt(?int $updatedAt) : self
    {
        $this->initialized['updatedAt'] = true;
        $this->updatedAt = $updatedAt;
        return $this;
    }
}
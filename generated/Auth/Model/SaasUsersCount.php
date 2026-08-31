<?php

namespace AntiPatternInc\Saasus\Sdk\Auth\Model;

class SaasUsersCount extends \ArrayObject
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
     * Count of SaaS users
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
     * Count of SaaS users
     *
     * @return int|null
     */
    public function getCount() : ?int
    {
        return $this->count;
    }
    /**
     * Count of SaaS users
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
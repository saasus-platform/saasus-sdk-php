<?php

namespace AntiPatternInc\Saasus\Sdk\Auth\Model;

class SaveSaasUsersCountParam extends \ArrayObject
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
}
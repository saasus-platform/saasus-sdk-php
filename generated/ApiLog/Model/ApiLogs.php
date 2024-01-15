<?php

namespace AntiPatternInc\Saasus\Sdk\ApiLog\Model;

class ApiLogs extends \ArrayObject
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
    protected $apiLogs;
    /**
     * 
     *
     * @return array<string, mixed>[]|null
     */
    public function getApiLogs() : ?array
    {
        return $this->apiLogs;
    }
    /**
     * 
     *
     * @param array<string, mixed>[]|null $apiLogs
     *
     * @return self
     */
    public function setApiLogs(?array $apiLogs) : self
    {
        $this->initialized['apiLogs'] = true;
        $this->apiLogs = $apiLogs;
        return $this;
    }
}
<?php

namespace AntiPatternInc\Saasus\Sdk\ApiLog\Model;

class ApiLogs extends \ArrayObject
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
    protected $apiLogs;
    /**
     * Cursor for cursor pagination
     *
     * @var string|null
     */
    protected $cursor;
    /**
     * 
     *
     * @return list<array<string, mixed>>|null
     */
    public function getApiLogs(): ?array
    {
        return $this->apiLogs;
    }
    /**
     * 
     *
     * @param list<array<string, mixed>>|null $apiLogs
     *
     * @return self
     */
    public function setApiLogs(?array $apiLogs): self
    {
        $this->initialized['apiLogs'] = true;
        $this->apiLogs = $apiLogs;
        return $this;
    }
    /**
     * Cursor for cursor pagination
     *
     * @return string|null
     */
    public function getCursor(): ?string
    {
        return $this->cursor;
    }
    /**
     * Cursor for cursor pagination
     *
     * @param string|null $cursor
     *
     * @return self
     */
    public function setCursor(?string $cursor): self
    {
        $this->initialized['cursor'] = true;
        $this->cursor = $cursor;
        return $this;
    }
}
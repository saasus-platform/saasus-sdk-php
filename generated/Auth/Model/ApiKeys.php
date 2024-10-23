<?php

namespace AntiPatternInc\Saasus\Sdk\Auth\Model;

class ApiKeys extends \ArrayObject
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
     * API Key
     *
     * @var list<string>|null
     */
    protected $apiKeys;
    /**
     * API Key
     *
     * @return list<string>|null
     */
    public function getApiKeys(): ?array
    {
        return $this->apiKeys;
    }
    /**
     * API Key
     *
     * @param list<string>|null $apiKeys
     *
     * @return self
     */
    public function setApiKeys(?array $apiKeys): self
    {
        $this->initialized['apiKeys'] = true;
        $this->apiKeys = $apiKeys;
        return $this;
    }
}
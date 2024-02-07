<?php

namespace AntiPatternInc\Saasus\Sdk\Auth\Model;

class ApiKeys extends \ArrayObject
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
     * APIキー(API Key)
     *
     * @var string[]|null
     */
    protected $apiKeys;
    /**
     * APIキー(API Key)
     *
     * @return string[]|null
     */
    public function getApiKeys() : ?array
    {
        return $this->apiKeys;
    }
    /**
     * APIキー(API Key)
     *
     * @param string[]|null $apiKeys
     *
     * @return self
     */
    public function setApiKeys(?array $apiKeys) : self
    {
        $this->initialized['apiKeys'] = true;
        $this->apiKeys = $apiKeys;
        return $this;
    }
}
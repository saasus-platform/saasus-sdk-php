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
     * APIキー(API key)
     *
     * @var string[]
     */
    protected $apiKeys;
    /**
     * APIキー(API key)
     *
     * @return string[]
     */
    public function getApiKeys() : array
    {
        return $this->apiKeys;
    }
    /**
     * APIキー(API key)
     *
     * @param string[] $apiKeys
     *
     * @return self
     */
    public function setApiKeys(array $apiKeys) : self
    {
        $this->initialized['apiKeys'] = true;
        $this->apiKeys = $apiKeys;
        return $this;
    }
}
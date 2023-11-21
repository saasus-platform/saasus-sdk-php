<?php

namespace AntiPatternInc\Saasus\Sdk\Auth\Model;

class UpdateEnvParam extends \ArrayObject
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
     * 環境名(env name)
     *
     * @var string
     */
    protected $name;
    /**
     * 環境表示名(env display name)
     *
     * @var string
     */
    protected $displayName;
    /**
     * 環境名(env name)
     *
     * @return string
     */
    public function getName() : string
    {
        return $this->name;
    }
    /**
     * 環境名(env name)
     *
     * @param string $name
     *
     * @return self
     */
    public function setName(string $name) : self
    {
        $this->initialized['name'] = true;
        $this->name = $name;
        return $this;
    }
    /**
     * 環境表示名(env display name)
     *
     * @return string
     */
    public function getDisplayName() : string
    {
        return $this->displayName;
    }
    /**
     * 環境表示名(env display name)
     *
     * @param string $displayName
     *
     * @return self
     */
    public function setDisplayName(string $displayName) : self
    {
        $this->initialized['displayName'] = true;
        $this->displayName = $displayName;
        return $this;
    }
}
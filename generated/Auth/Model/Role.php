<?php

namespace AntiPatternInc\Saasus\Sdk\Auth\Model;

class Role extends \ArrayObject
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
     * 役割名
     *
     * @var string
     */
    protected $roleName;
    /**
     * 役割表示名
     *
     * @var string
     */
    protected $displayName;
    /**
     * 役割名
     *
     * @return string
     */
    public function getRoleName() : string
    {
        return $this->roleName;
    }
    /**
     * 役割名
     *
     * @param string $roleName
     *
     * @return self
     */
    public function setRoleName(string $roleName) : self
    {
        $this->initialized['roleName'] = true;
        $this->roleName = $roleName;
        return $this;
    }
    /**
     * 役割表示名
     *
     * @return string
     */
    public function getDisplayName() : string
    {
        return $this->displayName;
    }
    /**
     * 役割表示名
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
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
     * 役割(ロール)名(role name)
     *
     * @var string
     */
    protected $roleName;
    /**
     * 役割(ロール)表示名(role display name)
     *
     * @var string
     */
    protected $displayName;
    /**
     * 役割(ロール)名(role name)
     *
     * @return string
     */
    public function getRoleName() : string
    {
        return $this->roleName;
    }
    /**
     * 役割(ロール)名(role name)
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
     * 役割(ロール)表示名(role display name)
     *
     * @return string
     */
    public function getDisplayName() : string
    {
        return $this->displayName;
    }
    /**
     * 役割(ロール)表示名(role display name)
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
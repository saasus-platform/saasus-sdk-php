<?php

namespace AntiPatternInc\Saasus\Sdk\Auth\Model;

class UserAvailableEnv extends \ArrayObject
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
     * @var int|null
     */
    protected $id;
    /**
     * 環境名(env name)
     *
     * @var string|null
     */
    protected $name;
    /**
     * 環境表示名(env display name)
     *
     * @var string|null
     */
    protected $displayName;
    /**
     * 役割(ロール)情報(role info)
     *
     * @var Role[]|null
     */
    protected $roles;
    /**
     * 
     *
     * @return int|null
     */
    public function getId() : ?int
    {
        return $this->id;
    }
    /**
     * 
     *
     * @param int|null $id
     *
     * @return self
     */
    public function setId(?int $id) : self
    {
        $this->initialized['id'] = true;
        $this->id = $id;
        return $this;
    }
    /**
     * 環境名(env name)
     *
     * @return string|null
     */
    public function getName() : ?string
    {
        return $this->name;
    }
    /**
     * 環境名(env name)
     *
     * @param string|null $name
     *
     * @return self
     */
    public function setName(?string $name) : self
    {
        $this->initialized['name'] = true;
        $this->name = $name;
        return $this;
    }
    /**
     * 環境表示名(env display name)
     *
     * @return string|null
     */
    public function getDisplayName() : ?string
    {
        return $this->displayName;
    }
    /**
     * 環境表示名(env display name)
     *
     * @param string|null $displayName
     *
     * @return self
     */
    public function setDisplayName(?string $displayName) : self
    {
        $this->initialized['displayName'] = true;
        $this->displayName = $displayName;
        return $this;
    }
    /**
     * 役割(ロール)情報(role info)
     *
     * @return Role[]|null
     */
    public function getRoles() : ?array
    {
        return $this->roles;
    }
    /**
     * 役割(ロール)情報(role info)
     *
     * @param Role[]|null $roles
     *
     * @return self
     */
    public function setRoles(?array $roles) : self
    {
        $this->initialized['roles'] = true;
        $this->roles = $roles;
        return $this;
    }
}
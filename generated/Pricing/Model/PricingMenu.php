<?php

namespace AntiPatternInc\Saasus\Sdk\Pricing\Model;

class PricingMenu extends \ArrayObject
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
     * @var string
     */
    protected $id;
    /**
     * メニュー名(menu name)
     *
     * @var string
     */
    protected $name;
    /**
     * メニュー表示名(menu display name)
     *
     * @var string
     */
    protected $displayName;
    /**
     * メニュー説明(menu description)
     *
     * @var string
     */
    protected $description;
    /**
     * メニューの使用済み設定(menu used settings)
     *
     * @var bool
     */
    protected $used;
    /**
     * 
     *
     * @var mixed[][]
     */
    protected $units;
    /**
     * 
     *
     * @return string
     */
    public function getId() : string
    {
        return $this->id;
    }
    /**
     * 
     *
     * @param string $id
     *
     * @return self
     */
    public function setId(string $id) : self
    {
        $this->initialized['id'] = true;
        $this->id = $id;
        return $this;
    }
    /**
     * メニュー名(menu name)
     *
     * @return string
     */
    public function getName() : string
    {
        return $this->name;
    }
    /**
     * メニュー名(menu name)
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
     * メニュー表示名(menu display name)
     *
     * @return string
     */
    public function getDisplayName() : string
    {
        return $this->displayName;
    }
    /**
     * メニュー表示名(menu display name)
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
    /**
     * メニュー説明(menu description)
     *
     * @return string
     */
    public function getDescription() : string
    {
        return $this->description;
    }
    /**
     * メニュー説明(menu description)
     *
     * @param string $description
     *
     * @return self
     */
    public function setDescription(string $description) : self
    {
        $this->initialized['description'] = true;
        $this->description = $description;
        return $this;
    }
    /**
     * メニューの使用済み設定(menu used settings)
     *
     * @return bool
     */
    public function getUsed() : bool
    {
        return $this->used;
    }
    /**
     * メニューの使用済み設定(menu used settings)
     *
     * @param bool $used
     *
     * @return self
     */
    public function setUsed(bool $used) : self
    {
        $this->initialized['used'] = true;
        $this->used = $used;
        return $this;
    }
    /**
     * 
     *
     * @return mixed[][]
     */
    public function getUnits() : array
    {
        return $this->units;
    }
    /**
     * 
     *
     * @param mixed[][] $units
     *
     * @return self
     */
    public function setUnits(array $units) : self
    {
        $this->initialized['units'] = true;
        $this->units = $units;
        return $this;
    }
}
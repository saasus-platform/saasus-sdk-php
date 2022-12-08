<?php

namespace AntiPatternInc\Saasus\Sdk\Pricing\Model;

class PricingPlan extends \ArrayObject
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
     * 料金プラン名
     *
     * @var string
     */
    protected $name;
    /**
     * 
     *
     * @var string
     */
    protected $displayName;
    /**
     * 料金プラン説明
     *
     * @var string
     */
    protected $description;
    /**
     * 料金プランの使用済み設定
     *
     * @var bool
     */
    protected $used;
    /**
     * 
     *
     * @var mixed[][]
     */
    protected $pricingMenus;
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
     * 料金プラン名
     *
     * @return string
     */
    public function getName() : string
    {
        return $this->name;
    }
    /**
     * 料金プラン名
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
     * 
     *
     * @return string
     */
    public function getDisplayName() : string
    {
        return $this->displayName;
    }
    /**
     * 
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
     * 料金プラン説明
     *
     * @return string
     */
    public function getDescription() : string
    {
        return $this->description;
    }
    /**
     * 料金プラン説明
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
     * 料金プランの使用済み設定
     *
     * @return bool
     */
    public function getUsed() : bool
    {
        return $this->used;
    }
    /**
     * 料金プランの使用済み設定
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
    public function getPricingMenus() : array
    {
        return $this->pricingMenus;
    }
    /**
     * 
     *
     * @param mixed[][] $pricingMenus
     *
     * @return self
     */
    public function setPricingMenus(array $pricingMenus) : self
    {
        $this->initialized['pricingMenus'] = true;
        $this->pricingMenus = $pricingMenus;
        return $this;
    }
}
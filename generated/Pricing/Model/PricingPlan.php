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
     * @var string|null
     */
    protected $id;
    /**
     * 料金プラン名(pricing plan name)
     *
     * @var string|null
     */
    protected $name;
    /**
     * 料金プラン表示名(pricing plan display name)
     *
     * @var string|null
     */
    protected $displayName;
    /**
     * 料金プラン説明(pricing plan description)
     *
     * @var string|null
     */
    protected $description;
    /**
     * 料金プランの使用済み設定(pricing plan used settings)
     *
     * @var bool|null
     */
    protected $used;
    /**
     * 
     *
     * @var array<string, mixed>[]|null
     */
    protected $pricingMenus;
    /**
     * 
     *
     * @return string|null
     */
    public function getId() : ?string
    {
        return $this->id;
    }
    /**
     * 
     *
     * @param string|null $id
     *
     * @return self
     */
    public function setId(?string $id) : self
    {
        $this->initialized['id'] = true;
        $this->id = $id;
        return $this;
    }
    /**
     * 料金プラン名(pricing plan name)
     *
     * @return string|null
     */
    public function getName() : ?string
    {
        return $this->name;
    }
    /**
     * 料金プラン名(pricing plan name)
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
     * 料金プラン表示名(pricing plan display name)
     *
     * @return string|null
     */
    public function getDisplayName() : ?string
    {
        return $this->displayName;
    }
    /**
     * 料金プラン表示名(pricing plan display name)
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
     * 料金プラン説明(pricing plan description)
     *
     * @return string|null
     */
    public function getDescription() : ?string
    {
        return $this->description;
    }
    /**
     * 料金プラン説明(pricing plan description)
     *
     * @param string|null $description
     *
     * @return self
     */
    public function setDescription(?string $description) : self
    {
        $this->initialized['description'] = true;
        $this->description = $description;
        return $this;
    }
    /**
     * 料金プランの使用済み設定(pricing plan used settings)
     *
     * @return bool|null
     */
    public function getUsed() : ?bool
    {
        return $this->used;
    }
    /**
     * 料金プランの使用済み設定(pricing plan used settings)
     *
     * @param bool|null $used
     *
     * @return self
     */
    public function setUsed(?bool $used) : self
    {
        $this->initialized['used'] = true;
        $this->used = $used;
        return $this;
    }
    /**
     * 
     *
     * @return array<string, mixed>[]|null
     */
    public function getPricingMenus() : ?array
    {
        return $this->pricingMenus;
    }
    /**
     * 
     *
     * @param array<string, mixed>[]|null $pricingMenus
     *
     * @return self
     */
    public function setPricingMenus(?array $pricingMenus) : self
    {
        $this->initialized['pricingMenus'] = true;
        $this->pricingMenus = $pricingMenus;
        return $this;
    }
}
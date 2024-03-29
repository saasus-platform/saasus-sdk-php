<?php

namespace AntiPatternInc\Saasus\Sdk\Pricing\Model;

class SavePricingPlanParam extends \ArrayObject
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
    * メニューID（料金プランに追加するメニューIDを設定）
    Menu ID (menu ID to be added to the pricing plan)
    
    *
    * @var string[]|null
    */
    protected $menuIds;
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
    * メニューID（料金プランに追加するメニューIDを設定）
    Menu ID (menu ID to be added to the pricing plan)
    
    *
    * @return string[]|null
    */
    public function getMenuIds() : ?array
    {
        return $this->menuIds;
    }
    /**
    * メニューID（料金プランに追加するメニューIDを設定）
    Menu ID (menu ID to be added to the pricing plan)
    
    *
    * @param string[]|null $menuIds
    *
    * @return self
    */
    public function setMenuIds(?array $menuIds) : self
    {
        $this->initialized['menuIds'] = true;
        $this->menuIds = $menuIds;
        return $this;
    }
}
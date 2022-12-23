<?php

namespace AntiPatternInc\Saasus\Sdk\Pricing\Model;

class SavePricingMenuParam extends \ArrayObject
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
     * メニュー名(Menu name)
     *
     * @var string
     */
    protected $name;
    /**
     * メニュー表示名(Menu display name)
     *
     * @var string
     */
    protected $displayName;
    /**
     * メニュー説明(Menu description)
     *
     * @var string
     */
    protected $description;
    /**
     * 追加するユニットID(the unit id to add)
     *
     * @var string[]
     */
    protected $unitIds;
    /**
     * メニュー名(Menu name)
     *
     * @return string
     */
    public function getName() : string
    {
        return $this->name;
    }
    /**
     * メニュー名(Menu name)
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
     * メニュー表示名(Menu display name)
     *
     * @return string
     */
    public function getDisplayName() : string
    {
        return $this->displayName;
    }
    /**
     * メニュー表示名(Menu display name)
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
     * メニュー説明(Menu description)
     *
     * @return string
     */
    public function getDescription() : string
    {
        return $this->description;
    }
    /**
     * メニュー説明(Menu description)
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
     * 追加するユニットID(the unit id to add)
     *
     * @return string[]
     */
    public function getUnitIds() : array
    {
        return $this->unitIds;
    }
    /**
     * 追加するユニットID(the unit id to add)
     *
     * @param string[] $unitIds
     *
     * @return self
     */
    public function setUnitIds(array $unitIds) : self
    {
        $this->initialized['unitIds'] = true;
        $this->unitIds = $unitIds;
        return $this;
    }
}
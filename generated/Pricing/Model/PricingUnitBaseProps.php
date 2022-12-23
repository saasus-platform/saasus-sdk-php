<?php

namespace AntiPatternInc\Saasus\Sdk\Pricing\Model;

class PricingUnitBaseProps extends \ArrayObject
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
     * 名前(name)
     *
     * @var string
     */
    protected $name;
    /**
     * 表示名(display name)
     *
     * @var string
     */
    protected $displayName;
    /**
     * 説明(description)
     *
     * @var string
     */
    protected $description;
    /**
    * 計測単位の種別(Type of unit of measurement)
    fixed: 固定ユニット(fixed unit)
    usage: 使用量ユニット(usage unit)
    tiered: 段階ユニット(tiered unit)
    tiered_usage: 段階的使用量ユニット(tiered usage unit)
    
    *
    * @var string
    */
    protected $type;
    /**
     * 通貨(currency)
     *
     * @var string
     */
    protected $currency;
    /**
     * 名前(name)
     *
     * @return string
     */
    public function getName() : string
    {
        return $this->name;
    }
    /**
     * 名前(name)
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
     * 表示名(display name)
     *
     * @return string
     */
    public function getDisplayName() : string
    {
        return $this->displayName;
    }
    /**
     * 表示名(display name)
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
     * 説明(description)
     *
     * @return string
     */
    public function getDescription() : string
    {
        return $this->description;
    }
    /**
     * 説明(description)
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
    * 計測単位の種別(Type of unit of measurement)
    fixed: 固定ユニット(fixed unit)
    usage: 使用量ユニット(usage unit)
    tiered: 段階ユニット(tiered unit)
    tiered_usage: 段階的使用量ユニット(tiered usage unit)
    
    *
    * @return string
    */
    public function getType() : string
    {
        return $this->type;
    }
    /**
    * 計測単位の種別(Type of unit of measurement)
    fixed: 固定ユニット(fixed unit)
    usage: 使用量ユニット(usage unit)
    tiered: 段階ユニット(tiered unit)
    tiered_usage: 段階的使用量ユニット(tiered usage unit)
    
    *
    * @param string $type
    *
    * @return self
    */
    public function setType(string $type) : self
    {
        $this->initialized['type'] = true;
        $this->type = $type;
        return $this;
    }
    /**
     * 通貨(currency)
     *
     * @return string
     */
    public function getCurrency() : string
    {
        return $this->currency;
    }
    /**
     * 通貨(currency)
     *
     * @param string $currency
     *
     * @return self
     */
    public function setCurrency(string $currency) : self
    {
        $this->initialized['currency'] = true;
        $this->currency = $currency;
        return $this;
    }
}
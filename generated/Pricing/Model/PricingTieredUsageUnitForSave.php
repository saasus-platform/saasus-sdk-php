<?php

namespace AntiPatternInc\Saasus\Sdk\Pricing\Model;

class PricingTieredUsageUnitForSave extends \ArrayObject
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
     * 上限値(upper limit)
     *
     * @var int
     */
    protected $upperCount;
    /**
     * 計測ユニット名(metering unit name)
     *
     * @var string
     */
    protected $meteringUnitName;
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
    * 計測単位の種別(unit of measurement type)
    fixed: 固定ユニット(fixed unit)
    usage: 使用量ユニット(usage unit)
    tiered: 段階ユニット(tiered unit)
    tiered_usage: 段階的使用量ユニット(tiered usage unit)
    
    *
    * @var string
    */
    protected $type;
    /**
     * 計測単位の通貨(unit of currency)
     *
     * @var string
     */
    protected $currency;
    /**
     * 
     *
     * @var PricingTier[]
     */
    protected $tiers;
    /**
     * 上限値(upper limit)
     *
     * @return int
     */
    public function getUpperCount() : int
    {
        return $this->upperCount;
    }
    /**
     * 上限値(upper limit)
     *
     * @param int $upperCount
     *
     * @return self
     */
    public function setUpperCount(int $upperCount) : self
    {
        $this->initialized['upperCount'] = true;
        $this->upperCount = $upperCount;
        return $this;
    }
    /**
     * 計測ユニット名(metering unit name)
     *
     * @return string
     */
    public function getMeteringUnitName() : string
    {
        return $this->meteringUnitName;
    }
    /**
     * 計測ユニット名(metering unit name)
     *
     * @param string $meteringUnitName
     *
     * @return self
     */
    public function setMeteringUnitName(string $meteringUnitName) : self
    {
        $this->initialized['meteringUnitName'] = true;
        $this->meteringUnitName = $meteringUnitName;
        return $this;
    }
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
    * 計測単位の種別(unit of measurement type)
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
    * 計測単位の種別(unit of measurement type)
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
     * 計測単位の通貨(unit of currency)
     *
     * @return string
     */
    public function getCurrency() : string
    {
        return $this->currency;
    }
    /**
     * 計測単位の通貨(unit of currency)
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
    /**
     * 
     *
     * @return PricingTier[]
     */
    public function getTiers() : array
    {
        return $this->tiers;
    }
    /**
     * 
     *
     * @param PricingTier[] $tiers
     *
     * @return self
     */
    public function setTiers(array $tiers) : self
    {
        $this->initialized['tiers'] = true;
        $this->tiers = $tiers;
        return $this;
    }
}
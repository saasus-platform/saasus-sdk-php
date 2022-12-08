<?php

namespace AntiPatternInc\Saasus\Sdk\Pricing\Model;

class PricingTieredUnitForSave extends \ArrayObject
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
     * 上限値
     *
     * @var int
     */
    protected $upperCount;
    /**
     * 
     *
     * @var string
     */
    protected $meteringUnitName;
    /**
     * 
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
     * 
     *
     * @var string
     */
    protected $description;
    /**
    * 計測単位の種別
    fixed: 固定ユニット
    usage: 使用量ユニット
    tiered: 段階ユニット
    tiered_usage: 段階的使用量ユニット
    
    *
    * @var string
    */
    protected $type;
    /**
     * 
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
     * 上限値
     *
     * @return int
     */
    public function getUpperCount() : int
    {
        return $this->upperCount;
    }
    /**
     * 上限値
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
     * 
     *
     * @return string
     */
    public function getMeteringUnitName() : string
    {
        return $this->meteringUnitName;
    }
    /**
     * 
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
     * 
     *
     * @return string
     */
    public function getName() : string
    {
        return $this->name;
    }
    /**
     * 
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
     * 
     *
     * @return string
     */
    public function getDescription() : string
    {
        return $this->description;
    }
    /**
     * 
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
    * 計測単位の種別
    fixed: 固定ユニット
    usage: 使用量ユニット
    tiered: 段階ユニット
    tiered_usage: 段階的使用量ユニット
    
    *
    * @return string
    */
    public function getType() : string
    {
        return $this->type;
    }
    /**
    * 計測単位の種別
    fixed: 固定ユニット
    usage: 使用量ユニット
    tiered: 段階ユニット
    tiered_usage: 段階的使用量ユニット
    
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
     * 
     *
     * @return string
     */
    public function getCurrency() : string
    {
        return $this->currency;
    }
    /**
     * 
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
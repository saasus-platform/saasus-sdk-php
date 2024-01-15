<?php

namespace AntiPatternInc\Saasus\Sdk\Pricing\Model;

class PricingUsageUnitForSave extends \ArrayObject
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
     * @var int|null
     */
    protected $upperCount;
    /**
     * 使用量あたりの金額(amount per usage)
     *
     * @var int|null
     */
    protected $unitAmount;
    /**
     * 
     *
     * @var string|null
     */
    protected $meteringUnitName;
    /**
    * 使用量の集計方法(aggregate usage)
    sum: 期間内の使用量の合計(total usage during the period)
    max: 期間内の使用量の最大値(maximum usage during the period)
    
    *
    * @var string|null
    */
    protected $aggregateUsage;
    /**
     * 名前(name)
     *
     * @var string|null
     */
    protected $name;
    /**
     * 表示名(display name)
     *
     * @var string|null
     */
    protected $displayName;
    /**
     * 説明(description)
     *
     * @var string|null
     */
    protected $description;
    /**
    * 計測単位の種別(unit of measurement type)
    fixed: 固定ユニット(fixed unit)
    usage: 使用量ユニット(usage unit)
    tiered: 段階ユニット(tiered unit)
    tiered_usage: 段階的使用量ユニット(tiered usage unit)
    
    *
    * @var string|null
    */
    protected $type;
    /**
     * 計測単位の通貨(unit of currency)
     *
     * @var string|null
     */
    protected $currency;
    /**
     * 上限値(upper limit)
     *
     * @return int|null
     */
    public function getUpperCount() : ?int
    {
        return $this->upperCount;
    }
    /**
     * 上限値(upper limit)
     *
     * @param int|null $upperCount
     *
     * @return self
     */
    public function setUpperCount(?int $upperCount) : self
    {
        $this->initialized['upperCount'] = true;
        $this->upperCount = $upperCount;
        return $this;
    }
    /**
     * 使用量あたりの金額(amount per usage)
     *
     * @return int|null
     */
    public function getUnitAmount() : ?int
    {
        return $this->unitAmount;
    }
    /**
     * 使用量あたりの金額(amount per usage)
     *
     * @param int|null $unitAmount
     *
     * @return self
     */
    public function setUnitAmount(?int $unitAmount) : self
    {
        $this->initialized['unitAmount'] = true;
        $this->unitAmount = $unitAmount;
        return $this;
    }
    /**
     * 
     *
     * @return string|null
     */
    public function getMeteringUnitName() : ?string
    {
        return $this->meteringUnitName;
    }
    /**
     * 
     *
     * @param string|null $meteringUnitName
     *
     * @return self
     */
    public function setMeteringUnitName(?string $meteringUnitName) : self
    {
        $this->initialized['meteringUnitName'] = true;
        $this->meteringUnitName = $meteringUnitName;
        return $this;
    }
    /**
    * 使用量の集計方法(aggregate usage)
    sum: 期間内の使用量の合計(total usage during the period)
    max: 期間内の使用量の最大値(maximum usage during the period)
    
    *
    * @return string|null
    */
    public function getAggregateUsage() : ?string
    {
        return $this->aggregateUsage;
    }
    /**
    * 使用量の集計方法(aggregate usage)
    sum: 期間内の使用量の合計(total usage during the period)
    max: 期間内の使用量の最大値(maximum usage during the period)
    
    *
    * @param string|null $aggregateUsage
    *
    * @return self
    */
    public function setAggregateUsage(?string $aggregateUsage) : self
    {
        $this->initialized['aggregateUsage'] = true;
        $this->aggregateUsage = $aggregateUsage;
        return $this;
    }
    /**
     * 名前(name)
     *
     * @return string|null
     */
    public function getName() : ?string
    {
        return $this->name;
    }
    /**
     * 名前(name)
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
     * 表示名(display name)
     *
     * @return string|null
     */
    public function getDisplayName() : ?string
    {
        return $this->displayName;
    }
    /**
     * 表示名(display name)
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
     * 説明(description)
     *
     * @return string|null
     */
    public function getDescription() : ?string
    {
        return $this->description;
    }
    /**
     * 説明(description)
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
    * 計測単位の種別(unit of measurement type)
    fixed: 固定ユニット(fixed unit)
    usage: 使用量ユニット(usage unit)
    tiered: 段階ユニット(tiered unit)
    tiered_usage: 段階的使用量ユニット(tiered usage unit)
    
    *
    * @return string|null
    */
    public function getType() : ?string
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
    * @param string|null $type
    *
    * @return self
    */
    public function setType(?string $type) : self
    {
        $this->initialized['type'] = true;
        $this->type = $type;
        return $this;
    }
    /**
     * 計測単位の通貨(unit of currency)
     *
     * @return string|null
     */
    public function getCurrency() : ?string
    {
        return $this->currency;
    }
    /**
     * 計測単位の通貨(unit of currency)
     *
     * @param string|null $currency
     *
     * @return self
     */
    public function setCurrency(?string $currency) : self
    {
        $this->initialized['currency'] = true;
        $this->currency = $currency;
        return $this;
    }
}
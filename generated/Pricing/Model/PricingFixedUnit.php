<?php

namespace AntiPatternInc\Saasus\Sdk\Pricing\Model;

class PricingFixedUnit extends \ArrayObject
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
     * 
     *
     * @var bool|null
     */
    protected $used;
    /**
     * 料金(price)
     *
     * @var int|null
     */
    protected $unitAmount;
    /**
    * 繰り返し期間(cycle)
    month: 月単位(monthly)
    year: 年単位(yearly)
    
    *
    * @var string|null
    */
    protected $recurringInterval;
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
     * 
     *
     * @return bool|null
     */
    public function getUsed() : ?bool
    {
        return $this->used;
    }
    /**
     * 
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
     * 料金(price)
     *
     * @return int|null
     */
    public function getUnitAmount() : ?int
    {
        return $this->unitAmount;
    }
    /**
     * 料金(price)
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
    * 繰り返し期間(cycle)
    month: 月単位(monthly)
    year: 年単位(yearly)
    
    *
    * @return string|null
    */
    public function getRecurringInterval() : ?string
    {
        return $this->recurringInterval;
    }
    /**
    * 繰り返し期間(cycle)
    month: 月単位(monthly)
    year: 年単位(yearly)
    
    *
    * @param string|null $recurringInterval
    *
    * @return self
    */
    public function setRecurringInterval(?string $recurringInterval) : self
    {
        $this->initialized['recurringInterval'] = true;
        $this->recurringInterval = $recurringInterval;
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
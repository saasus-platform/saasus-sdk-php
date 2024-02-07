<?php

namespace AntiPatternInc\Saasus\Sdk\Pricing\Model;

class MeteringUnitProps extends \ArrayObject
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
     * 計測ユニット名(metering unit name)
     *
     * @var string|null
     */
    protected $unitName;
    /**
    * 使用量の集計方法(aggregate usage)
    sum: 期間内の使用量の合計(total usage during the period)
    max: 期間内の使用量の最大値(maximum usage during the period)
    
    *
    * @var string|null
    */
    protected $aggregateUsage;
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
     * 計測ユニット名(metering unit name)
     *
     * @return string|null
     */
    public function getUnitName() : ?string
    {
        return $this->unitName;
    }
    /**
     * 計測ユニット名(metering unit name)
     *
     * @param string|null $unitName
     *
     * @return self
     */
    public function setUnitName(?string $unitName) : self
    {
        $this->initialized['unitName'] = true;
        $this->unitName = $unitName;
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
}
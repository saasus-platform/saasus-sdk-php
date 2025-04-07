<?php

namespace AntiPatternInc\Saasus\Sdk\Pricing\Model;

class PricingUsageUnit extends \ArrayObject
{
    /**
     * @var array
     */
    protected $initialized = [];
    public function isInitialized($property): bool
    {
        return array_key_exists($property, $this->initialized);
    }
    /**
     * Universally Unique Identifier
     *
     * @var string|null
     */
    protected $id;
    /**
     * Universally Unique Identifier
     *
     * @var string|null
     */
    protected $meteringUnitId;
    /**
    * Cycle
    month: Monthly
    year: Yearly
    
    *
    * @var string|null
    */
    protected $recurringInterval;
    /**
     * 
     *
     * @var bool|null
     */
    protected $used;
    /**
     * Upper limit
     *
     * @var int|null
     */
    protected $upperCount;
    /**
     * Amount per usage
     *
     * @var int|null
     */
    protected $unitAmount;
    /**
     * Metering unit name
     *
     * @var string|null
     */
    protected $meteringUnitName;
    /**
    * Aggregate usage
    sum: Total usage during the period
    max: Maximum usage during the period
    
    *
    * @var string|null
    */
    protected $aggregateUsage;
    /**
     * Name
     *
     * @var string|null
     */
    protected $name;
    /**
     * Display Name
     *
     * @var string|null
     */
    protected $displayName;
    /**
     * Description
     *
     * @var string|null
     */
    protected $description;
    /**
    * Unit of measurement type
    fixed: Fixed unit
    usage: Usage unit
    tiered: Tiered unit
    tiered_usage: Tiered usage unit
    
    *
    * @var string|null
    */
    protected $type;
    /**
     * Unit of currency
     *
     * @var string|null
     */
    protected $currency;
    /**
     * Universally Unique Identifier
     *
     * @return string|null
     */
    public function getId(): ?string
    {
        return $this->id;
    }
    /**
     * Universally Unique Identifier
     *
     * @param string|null $id
     *
     * @return self
     */
    public function setId(?string $id): self
    {
        $this->initialized['id'] = true;
        $this->id = $id;
        return $this;
    }
    /**
     * Universally Unique Identifier
     *
     * @return string|null
     */
    public function getMeteringUnitId(): ?string
    {
        return $this->meteringUnitId;
    }
    /**
     * Universally Unique Identifier
     *
     * @param string|null $meteringUnitId
     *
     * @return self
     */
    public function setMeteringUnitId(?string $meteringUnitId): self
    {
        $this->initialized['meteringUnitId'] = true;
        $this->meteringUnitId = $meteringUnitId;
        return $this;
    }
    /**
    * Cycle
    month: Monthly
    year: Yearly
    
    *
    * @return string|null
    */
    public function getRecurringInterval(): ?string
    {
        return $this->recurringInterval;
    }
    /**
    * Cycle
    month: Monthly
    year: Yearly
    
    *
    * @param string|null $recurringInterval
    *
    * @return self
    */
    public function setRecurringInterval(?string $recurringInterval): self
    {
        $this->initialized['recurringInterval'] = true;
        $this->recurringInterval = $recurringInterval;
        return $this;
    }
    /**
     * 
     *
     * @return bool|null
     */
    public function getUsed(): ?bool
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
    public function setUsed(?bool $used): self
    {
        $this->initialized['used'] = true;
        $this->used = $used;
        return $this;
    }
    /**
     * Upper limit
     *
     * @return int|null
     */
    public function getUpperCount(): ?int
    {
        return $this->upperCount;
    }
    /**
     * Upper limit
     *
     * @param int|null $upperCount
     *
     * @return self
     */
    public function setUpperCount(?int $upperCount): self
    {
        $this->initialized['upperCount'] = true;
        $this->upperCount = $upperCount;
        return $this;
    }
    /**
     * Amount per usage
     *
     * @return int|null
     */
    public function getUnitAmount(): ?int
    {
        return $this->unitAmount;
    }
    /**
     * Amount per usage
     *
     * @param int|null $unitAmount
     *
     * @return self
     */
    public function setUnitAmount(?int $unitAmount): self
    {
        $this->initialized['unitAmount'] = true;
        $this->unitAmount = $unitAmount;
        return $this;
    }
    /**
     * Metering unit name
     *
     * @return string|null
     */
    public function getMeteringUnitName(): ?string
    {
        return $this->meteringUnitName;
    }
    /**
     * Metering unit name
     *
     * @param string|null $meteringUnitName
     *
     * @return self
     */
    public function setMeteringUnitName(?string $meteringUnitName): self
    {
        $this->initialized['meteringUnitName'] = true;
        $this->meteringUnitName = $meteringUnitName;
        return $this;
    }
    /**
    * Aggregate usage
    sum: Total usage during the period
    max: Maximum usage during the period
    
    *
    * @return string|null
    */
    public function getAggregateUsage(): ?string
    {
        return $this->aggregateUsage;
    }
    /**
    * Aggregate usage
    sum: Total usage during the period
    max: Maximum usage during the period
    
    *
    * @param string|null $aggregateUsage
    *
    * @return self
    */
    public function setAggregateUsage(?string $aggregateUsage): self
    {
        $this->initialized['aggregateUsage'] = true;
        $this->aggregateUsage = $aggregateUsage;
        return $this;
    }
    /**
     * Name
     *
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }
    /**
     * Name
     *
     * @param string|null $name
     *
     * @return self
     */
    public function setName(?string $name): self
    {
        $this->initialized['name'] = true;
        $this->name = $name;
        return $this;
    }
    /**
     * Display Name
     *
     * @return string|null
     */
    public function getDisplayName(): ?string
    {
        return $this->displayName;
    }
    /**
     * Display Name
     *
     * @param string|null $displayName
     *
     * @return self
     */
    public function setDisplayName(?string $displayName): self
    {
        $this->initialized['displayName'] = true;
        $this->displayName = $displayName;
        return $this;
    }
    /**
     * Description
     *
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }
    /**
     * Description
     *
     * @param string|null $description
     *
     * @return self
     */
    public function setDescription(?string $description): self
    {
        $this->initialized['description'] = true;
        $this->description = $description;
        return $this;
    }
    /**
    * Unit of measurement type
    fixed: Fixed unit
    usage: Usage unit
    tiered: Tiered unit
    tiered_usage: Tiered usage unit
    
    *
    * @return string|null
    */
    public function getType(): ?string
    {
        return $this->type;
    }
    /**
    * Unit of measurement type
    fixed: Fixed unit
    usage: Usage unit
    tiered: Tiered unit
    tiered_usage: Tiered usage unit
    
    *
    * @param string|null $type
    *
    * @return self
    */
    public function setType(?string $type): self
    {
        $this->initialized['type'] = true;
        $this->type = $type;
        return $this;
    }
    /**
     * Unit of currency
     *
     * @return string|null
     */
    public function getCurrency(): ?string
    {
        return $this->currency;
    }
    /**
     * Unit of currency
     *
     * @param string|null $currency
     *
     * @return self
     */
    public function setCurrency(?string $currency): self
    {
        $this->initialized['currency'] = true;
        $this->currency = $currency;
        return $this;
    }
}
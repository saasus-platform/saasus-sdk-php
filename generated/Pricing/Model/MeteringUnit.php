<?php

namespace AntiPatternInc\Saasus\Sdk\Pricing\Model;

class MeteringUnit extends \ArrayObject
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
     * Metering unit used settings
     *
     * @var bool|null
     */
    protected $used;
    /**
     * Metering unit name
     *
     * @var string|null
     */
    protected $unitName;
    /**
    * Aggregate usage
    sum: Total usage during the period
    max: Maximum usage during the period
    
    *
    * @var string|null
    */
    protected $aggregateUsage;
    /**
     * Display name
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
     * Metering unit used settings
     *
     * @return bool|null
     */
    public function getUsed(): ?bool
    {
        return $this->used;
    }
    /**
     * Metering unit used settings
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
     * Metering unit name
     *
     * @return string|null
     */
    public function getUnitName(): ?string
    {
        return $this->unitName;
    }
    /**
     * Metering unit name
     *
     * @param string|null $unitName
     *
     * @return self
     */
    public function setUnitName(?string $unitName): self
    {
        $this->initialized['unitName'] = true;
        $this->unitName = $unitName;
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
     * Display name
     *
     * @return string|null
     */
    public function getDisplayName(): ?string
    {
        return $this->displayName;
    }
    /**
     * Display name
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
}
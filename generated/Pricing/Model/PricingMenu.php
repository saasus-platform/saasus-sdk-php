<?php

namespace AntiPatternInc\Saasus\Sdk\Pricing\Model;

class PricingMenu extends \ArrayObject
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
     * Menu name
     *
     * @var string|null
     */
    protected $name;
    /**
     * Menu display name
     *
     * @var string|null
     */
    protected $displayName;
    /**
     * Menu description
     *
     * @var string|null
     */
    protected $description;
    /**
     * Menu used settings
     *
     * @var bool|null
     */
    protected $used;
    /**
     * 
     *
     * @var list<array<string, mixed>>|null
     */
    protected $units;
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
     * Menu name
     *
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }
    /**
     * Menu name
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
     * Menu display name
     *
     * @return string|null
     */
    public function getDisplayName(): ?string
    {
        return $this->displayName;
    }
    /**
     * Menu display name
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
     * Menu description
     *
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }
    /**
     * Menu description
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
     * Menu used settings
     *
     * @return bool|null
     */
    public function getUsed(): ?bool
    {
        return $this->used;
    }
    /**
     * Menu used settings
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
     * 
     *
     * @return list<array<string, mixed>>|null
     */
    public function getUnits(): ?array
    {
        return $this->units;
    }
    /**
     * 
     *
     * @param list<array<string, mixed>>|null $units
     *
     * @return self
     */
    public function setUnits(?array $units): self
    {
        $this->initialized['units'] = true;
        $this->units = $units;
        return $this;
    }
}
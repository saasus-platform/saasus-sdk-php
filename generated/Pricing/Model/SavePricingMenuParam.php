<?php

namespace AntiPatternInc\Saasus\Sdk\Pricing\Model;

class SavePricingMenuParam extends \ArrayObject
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
     * Unit IDs to add
     *
     * @var list<string>|null
     */
    protected $unitIds;
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
     * Unit IDs to add
     *
     * @return list<string>|null
     */
    public function getUnitIds(): ?array
    {
        return $this->unitIds;
    }
    /**
     * Unit IDs to add
     *
     * @param list<string>|null $unitIds
     *
     * @return self
     */
    public function setUnitIds(?array $unitIds): self
    {
        $this->initialized['unitIds'] = true;
        $this->unitIds = $unitIds;
        return $this;
    }
}
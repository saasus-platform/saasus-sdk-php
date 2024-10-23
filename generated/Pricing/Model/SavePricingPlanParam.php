<?php

namespace AntiPatternInc\Saasus\Sdk\Pricing\Model;

class SavePricingPlanParam extends \ArrayObject
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
     * Pricing plan name
     *
     * @var string|null
     */
    protected $name;
    /**
     * Pricing plan display name
     *
     * @var string|null
     */
    protected $displayName;
    /**
     * Pricing plan description
     *
     * @var string|null
     */
    protected $description;
    /**
     * Menu ID to be added to the pricing plan
     *
     * @var list<string>|null
     */
    protected $menuIds;
    /**
     * Pricing plan name
     *
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }
    /**
     * Pricing plan name
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
     * Pricing plan display name
     *
     * @return string|null
     */
    public function getDisplayName(): ?string
    {
        return $this->displayName;
    }
    /**
     * Pricing plan display name
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
     * Pricing plan description
     *
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }
    /**
     * Pricing plan description
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
     * Menu ID to be added to the pricing plan
     *
     * @return list<string>|null
     */
    public function getMenuIds(): ?array
    {
        return $this->menuIds;
    }
    /**
     * Menu ID to be added to the pricing plan
     *
     * @param list<string>|null $menuIds
     *
     * @return self
     */
    public function setMenuIds(?array $menuIds): self
    {
        $this->initialized['menuIds'] = true;
        $this->menuIds = $menuIds;
        return $this;
    }
}
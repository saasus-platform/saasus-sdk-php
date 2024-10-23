<?php

namespace AntiPatternInc\Saasus\Sdk\Pricing\Model;

class PricingPlanProps extends \ArrayObject
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
     * Pricing plan used settings
     *
     * @var bool|null
     */
    protected $used;
    /**
     * 
     *
     * @var list<array<string, mixed>>|null
     */
    protected $pricingMenus;
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
     * Pricing plan used settings
     *
     * @return bool|null
     */
    public function getUsed(): ?bool
    {
        return $this->used;
    }
    /**
     * Pricing plan used settings
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
    public function getPricingMenus(): ?array
    {
        return $this->pricingMenus;
    }
    /**
     * 
     *
     * @param list<array<string, mixed>>|null $pricingMenus
     *
     * @return self
     */
    public function setPricingMenus(?array $pricingMenus): self
    {
        $this->initialized['pricingMenus'] = true;
        $this->pricingMenus = $pricingMenus;
        return $this;
    }
}
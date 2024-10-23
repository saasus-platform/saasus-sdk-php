<?php

namespace AntiPatternInc\Saasus\Sdk\Pricing\Model;

class PricingUnitBaseProps extends \ArrayObject
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
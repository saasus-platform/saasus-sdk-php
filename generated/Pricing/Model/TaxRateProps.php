<?php

namespace AntiPatternInc\Saasus\Sdk\Pricing\Model;

class TaxRateProps extends \ArrayObject
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
     * Name of tax rate
     *
     * @var string|null
     */
    protected $name;
    /**
     * Display name
     *
     * @var string|null
     */
    protected $displayName;
    /**
     * Percentage
     *
     * @var float|null
     */
    protected $percentage;
    /**
     * Inclusive or not
     *
     * @var bool|null
     */
    protected $inclusive;
    /**
     * Country code of ISO 3166-1 alpha-2
     *
     * @var string|null
     */
    protected $country;
    /**
     * Description
     *
     * @var string|null
     */
    protected $description;
    /**
     * Name of tax rate
     *
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }
    /**
     * Name of tax rate
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
     * Percentage
     *
     * @return float|null
     */
    public function getPercentage(): ?float
    {
        return $this->percentage;
    }
    /**
     * Percentage
     *
     * @param float|null $percentage
     *
     * @return self
     */
    public function setPercentage(?float $percentage): self
    {
        $this->initialized['percentage'] = true;
        $this->percentage = $percentage;
        return $this;
    }
    /**
     * Inclusive or not
     *
     * @return bool|null
     */
    public function getInclusive(): ?bool
    {
        return $this->inclusive;
    }
    /**
     * Inclusive or not
     *
     * @param bool|null $inclusive
     *
     * @return self
     */
    public function setInclusive(?bool $inclusive): self
    {
        $this->initialized['inclusive'] = true;
        $this->inclusive = $inclusive;
        return $this;
    }
    /**
     * Country code of ISO 3166-1 alpha-2
     *
     * @return string|null
     */
    public function getCountry(): ?string
    {
        return $this->country;
    }
    /**
     * Country code of ISO 3166-1 alpha-2
     *
     * @param string|null $country
     *
     * @return self
     */
    public function setCountry(?string $country): self
    {
        $this->initialized['country'] = true;
        $this->country = $country;
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
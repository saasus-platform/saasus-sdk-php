<?php

namespace AntiPatternInc\Saasus\Sdk\Pricing\Model;

class TaxRate extends \ArrayObject
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
     * 税率の名前(name of tax rate)
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
     * 税率(percentage)
     *
     * @var float|null
     */
    protected $percentage;
    /**
     * 内税かどうか(inclusive or not)
     *
     * @var bool|null
     */
    protected $inclusive;
    /**
     * ISO 3166-1 alpha-2 の国コード(Country code of ISO 3166-1 alpha-2)
     *
     * @var string|null
     */
    protected $country;
    /**
     * 説明(description)
     *
     * @var string|null
     */
    protected $description;
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
     * 税率の名前(name of tax rate)
     *
     * @return string|null
     */
    public function getName() : ?string
    {
        return $this->name;
    }
    /**
     * 税率の名前(name of tax rate)
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
     * 税率(percentage)
     *
     * @return float|null
     */
    public function getPercentage() : ?float
    {
        return $this->percentage;
    }
    /**
     * 税率(percentage)
     *
     * @param float|null $percentage
     *
     * @return self
     */
    public function setPercentage(?float $percentage) : self
    {
        $this->initialized['percentage'] = true;
        $this->percentage = $percentage;
        return $this;
    }
    /**
     * 内税かどうか(inclusive or not)
     *
     * @return bool|null
     */
    public function getInclusive() : ?bool
    {
        return $this->inclusive;
    }
    /**
     * 内税かどうか(inclusive or not)
     *
     * @param bool|null $inclusive
     *
     * @return self
     */
    public function setInclusive(?bool $inclusive) : self
    {
        $this->initialized['inclusive'] = true;
        $this->inclusive = $inclusive;
        return $this;
    }
    /**
     * ISO 3166-1 alpha-2 の国コード(Country code of ISO 3166-1 alpha-2)
     *
     * @return string|null
     */
    public function getCountry() : ?string
    {
        return $this->country;
    }
    /**
     * ISO 3166-1 alpha-2 の国コード(Country code of ISO 3166-1 alpha-2)
     *
     * @param string|null $country
     *
     * @return self
     */
    public function setCountry(?string $country) : self
    {
        $this->initialized['country'] = true;
        $this->country = $country;
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
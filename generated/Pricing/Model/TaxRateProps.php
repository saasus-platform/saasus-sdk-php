<?php

namespace AntiPatternInc\Saasus\Sdk\Pricing\Model;

class TaxRateProps extends \ArrayObject
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
     * 税率の名前(name of tax rate)
     *
     * @var string
     */
    protected $name;
    /**
     * 表示名(display name)
     *
     * @var string
     */
    protected $displayName;
    /**
     * 税率(percentage)
     *
     * @var float
     */
    protected $percentage;
    /**
     * 内税かどうか(inclusive or not)
     *
     * @var bool
     */
    protected $inclusive;
    /**
     * ISO 3166-1 alpha-2 の国コード(Country code of ISO 3166-1 alpha-2)
     *
     * @var string
     */
    protected $country;
    /**
     * 説明(description)
     *
     * @var string
     */
    protected $description;
    /**
     * 税率の名前(name of tax rate)
     *
     * @return string
     */
    public function getName() : string
    {
        return $this->name;
    }
    /**
     * 税率の名前(name of tax rate)
     *
     * @param string $name
     *
     * @return self
     */
    public function setName(string $name) : self
    {
        $this->initialized['name'] = true;
        $this->name = $name;
        return $this;
    }
    /**
     * 表示名(display name)
     *
     * @return string
     */
    public function getDisplayName() : string
    {
        return $this->displayName;
    }
    /**
     * 表示名(display name)
     *
     * @param string $displayName
     *
     * @return self
     */
    public function setDisplayName(string $displayName) : self
    {
        $this->initialized['displayName'] = true;
        $this->displayName = $displayName;
        return $this;
    }
    /**
     * 税率(percentage)
     *
     * @return float
     */
    public function getPercentage() : float
    {
        return $this->percentage;
    }
    /**
     * 税率(percentage)
     *
     * @param float $percentage
     *
     * @return self
     */
    public function setPercentage(float $percentage) : self
    {
        $this->initialized['percentage'] = true;
        $this->percentage = $percentage;
        return $this;
    }
    /**
     * 内税かどうか(inclusive or not)
     *
     * @return bool
     */
    public function getInclusive() : bool
    {
        return $this->inclusive;
    }
    /**
     * 内税かどうか(inclusive or not)
     *
     * @param bool $inclusive
     *
     * @return self
     */
    public function setInclusive(bool $inclusive) : self
    {
        $this->initialized['inclusive'] = true;
        $this->inclusive = $inclusive;
        return $this;
    }
    /**
     * ISO 3166-1 alpha-2 の国コード(Country code of ISO 3166-1 alpha-2)
     *
     * @return string
     */
    public function getCountry() : string
    {
        return $this->country;
    }
    /**
     * ISO 3166-1 alpha-2 の国コード(Country code of ISO 3166-1 alpha-2)
     *
     * @param string $country
     *
     * @return self
     */
    public function setCountry(string $country) : self
    {
        $this->initialized['country'] = true;
        $this->country = $country;
        return $this;
    }
    /**
     * 説明(description)
     *
     * @return string
     */
    public function getDescription() : string
    {
        return $this->description;
    }
    /**
     * 説明(description)
     *
     * @param string $description
     *
     * @return self
     */
    public function setDescription(string $description) : self
    {
        $this->initialized['description'] = true;
        $this->description = $description;
        return $this;
    }
}
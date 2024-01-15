<?php

namespace AntiPatternInc\Saasus\Sdk\Auth\Model;

class BillingAddress extends \ArrayObject
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
    * 住所の通りの名前や番地を含めた部分
    
    Street address, apartment or suite number.
    
    *
    * @var string|null
    */
    protected $street;
    /**
    * 住所の市区町村
    
    City, district, suburb, town, or village.
    
    *
    * @var string|null
    */
    protected $city;
    /**
    * 住所の都道府県または州
    
    State name or abbreviation.
    
    *
    * @var string|null
    */
    protected $state;
    /**
    * 住所の国を ISO 3166-1 alpha-2 コードで指定します。
    
    Country of the address using ISO 3166-1 alpha-2 code.
    
    *
    * @var string|null
    */
    protected $country;
    /**
    * 建物名・部屋番号などの住所に関する追加情報
    
    Additional information about the address, such as a building name, floor, or department name.
    
    *
    * @var string|null
    */
    protected $additionalAddressInfo;
    /**
    * 郵便番号
    
    ZIP or postal code.
    
    *
    * @var string|null
    */
    protected $postalCode;
    /**
    * 住所の通りの名前や番地を含めた部分
    
    Street address, apartment or suite number.
    
    *
    * @return string|null
    */
    public function getStreet() : ?string
    {
        return $this->street;
    }
    /**
    * 住所の通りの名前や番地を含めた部分
    
    Street address, apartment or suite number.
    
    *
    * @param string|null $street
    *
    * @return self
    */
    public function setStreet(?string $street) : self
    {
        $this->initialized['street'] = true;
        $this->street = $street;
        return $this;
    }
    /**
    * 住所の市区町村
    
    City, district, suburb, town, or village.
    
    *
    * @return string|null
    */
    public function getCity() : ?string
    {
        return $this->city;
    }
    /**
    * 住所の市区町村
    
    City, district, suburb, town, or village.
    
    *
    * @param string|null $city
    *
    * @return self
    */
    public function setCity(?string $city) : self
    {
        $this->initialized['city'] = true;
        $this->city = $city;
        return $this;
    }
    /**
    * 住所の都道府県または州
    
    State name or abbreviation.
    
    *
    * @return string|null
    */
    public function getState() : ?string
    {
        return $this->state;
    }
    /**
    * 住所の都道府県または州
    
    State name or abbreviation.
    
    *
    * @param string|null $state
    *
    * @return self
    */
    public function setState(?string $state) : self
    {
        $this->initialized['state'] = true;
        $this->state = $state;
        return $this;
    }
    /**
    * 住所の国を ISO 3166-1 alpha-2 コードで指定します。
    
    Country of the address using ISO 3166-1 alpha-2 code.
    
    *
    * @return string|null
    */
    public function getCountry() : ?string
    {
        return $this->country;
    }
    /**
    * 住所の国を ISO 3166-1 alpha-2 コードで指定します。
    
    Country of the address using ISO 3166-1 alpha-2 code.
    
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
    * 建物名・部屋番号などの住所に関する追加情報
    
    Additional information about the address, such as a building name, floor, or department name.
    
    *
    * @return string|null
    */
    public function getAdditionalAddressInfo() : ?string
    {
        return $this->additionalAddressInfo;
    }
    /**
    * 建物名・部屋番号などの住所に関する追加情報
    
    Additional information about the address, such as a building name, floor, or department name.
    
    *
    * @param string|null $additionalAddressInfo
    *
    * @return self
    */
    public function setAdditionalAddressInfo(?string $additionalAddressInfo) : self
    {
        $this->initialized['additionalAddressInfo'] = true;
        $this->additionalAddressInfo = $additionalAddressInfo;
        return $this;
    }
    /**
    * 郵便番号
    
    ZIP or postal code.
    
    *
    * @return string|null
    */
    public function getPostalCode() : ?string
    {
        return $this->postalCode;
    }
    /**
    * 郵便番号
    
    ZIP or postal code.
    
    *
    * @param string|null $postalCode
    *
    * @return self
    */
    public function setPostalCode(?string $postalCode) : self
    {
        $this->initialized['postalCode'] = true;
        $this->postalCode = $postalCode;
        return $this;
    }
}
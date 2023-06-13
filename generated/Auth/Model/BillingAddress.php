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
    * @var string
    */
    protected $street;
    /**
    * 住所の市区町村
    
    City, district, suburb, town, or village.
    
    *
    * @var string
    */
    protected $city;
    /**
    * 住所の都道府県または州
    
    State name or abbreviation.
    
    *
    * @var string
    */
    protected $state;
    /**
    * 住所の国を ISO 3166-1 alpha-2 コードで指定します。
    
    Country of the address using ISO 3166-1 alpha-2 code.
    
    *
    * @var string
    */
    protected $country;
    /**
    * 建物名・部屋番号などの住所に関する追加情報
    
    Additional information about the address, such as a building name, floor, or department name.
    
    *
    * @var string
    */
    protected $additionalAddressInfo;
    /**
    * 郵便番号
    
    ZIP or postal code.
    
    *
    * @var string
    */
    protected $postalCode;
    /**
    * 住所の通りの名前や番地を含めた部分
    
    Street address, apartment or suite number.
    
    *
    * @return string
    */
    public function getStreet() : string
    {
        return $this->street;
    }
    /**
    * 住所の通りの名前や番地を含めた部分
    
    Street address, apartment or suite number.
    
    *
    * @param string $street
    *
    * @return self
    */
    public function setStreet(string $street) : self
    {
        $this->initialized['street'] = true;
        $this->street = $street;
        return $this;
    }
    /**
    * 住所の市区町村
    
    City, district, suburb, town, or village.
    
    *
    * @return string
    */
    public function getCity() : string
    {
        return $this->city;
    }
    /**
    * 住所の市区町村
    
    City, district, suburb, town, or village.
    
    *
    * @param string $city
    *
    * @return self
    */
    public function setCity(string $city) : self
    {
        $this->initialized['city'] = true;
        $this->city = $city;
        return $this;
    }
    /**
    * 住所の都道府県または州
    
    State name or abbreviation.
    
    *
    * @return string
    */
    public function getState() : string
    {
        return $this->state;
    }
    /**
    * 住所の都道府県または州
    
    State name or abbreviation.
    
    *
    * @param string $state
    *
    * @return self
    */
    public function setState(string $state) : self
    {
        $this->initialized['state'] = true;
        $this->state = $state;
        return $this;
    }
    /**
    * 住所の国を ISO 3166-1 alpha-2 コードで指定します。
    
    Country of the address using ISO 3166-1 alpha-2 code.
    
    *
    * @return string
    */
    public function getCountry() : string
    {
        return $this->country;
    }
    /**
    * 住所の国を ISO 3166-1 alpha-2 コードで指定します。
    
    Country of the address using ISO 3166-1 alpha-2 code.
    
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
    * 建物名・部屋番号などの住所に関する追加情報
    
    Additional information about the address, such as a building name, floor, or department name.
    
    *
    * @return string
    */
    public function getAdditionalAddressInfo() : string
    {
        return $this->additionalAddressInfo;
    }
    /**
    * 建物名・部屋番号などの住所に関する追加情報
    
    Additional information about the address, such as a building name, floor, or department name.
    
    *
    * @param string $additionalAddressInfo
    *
    * @return self
    */
    public function setAdditionalAddressInfo(string $additionalAddressInfo) : self
    {
        $this->initialized['additionalAddressInfo'] = true;
        $this->additionalAddressInfo = $additionalAddressInfo;
        return $this;
    }
    /**
    * 郵便番号
    
    ZIP or postal code.
    
    *
    * @return string
    */
    public function getPostalCode() : string
    {
        return $this->postalCode;
    }
    /**
    * 郵便番号
    
    ZIP or postal code.
    
    *
    * @param string $postalCode
    *
    * @return self
    */
    public function setPostalCode(string $postalCode) : self
    {
        $this->initialized['postalCode'] = true;
        $this->postalCode = $postalCode;
        return $this;
    }
}
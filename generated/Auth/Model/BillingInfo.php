<?php

namespace AntiPatternInc\Saasus\Sdk\Auth\Model;

class BillingInfo extends \ArrayObject
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
    * 請求用のテナント名
    
    Tenant name for billing
    
    *
    * @var string
    */
    protected $name;
    /**
     * 
     *
     * @var BillingAddress
     */
    protected $address;
    /**
    * 請求書の言語
    
    Language of invoice
    
    *
    * @var string
    */
    protected $invoiceLanguage;
    /**
    * 請求用のテナント名
    
    Tenant name for billing
    
    *
    * @return string
    */
    public function getName() : string
    {
        return $this->name;
    }
    /**
    * 請求用のテナント名
    
    Tenant name for billing
    
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
     * 
     *
     * @return BillingAddress
     */
    public function getAddress() : BillingAddress
    {
        return $this->address;
    }
    /**
     * 
     *
     * @param BillingAddress $address
     *
     * @return self
     */
    public function setAddress(BillingAddress $address) : self
    {
        $this->initialized['address'] = true;
        $this->address = $address;
        return $this;
    }
    /**
    * 請求書の言語
    
    Language of invoice
    
    *
    * @return string
    */
    public function getInvoiceLanguage() : string
    {
        return $this->invoiceLanguage;
    }
    /**
    * 請求書の言語
    
    Language of invoice
    
    *
    * @param string $invoiceLanguage
    *
    * @return self
    */
    public function setInvoiceLanguage(string $invoiceLanguage) : self
    {
        $this->initialized['invoiceLanguage'] = true;
        $this->invoiceLanguage = $invoiceLanguage;
        return $this;
    }
}
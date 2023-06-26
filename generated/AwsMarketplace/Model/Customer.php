<?php

namespace AntiPatternInc\Saasus\Sdk\AwsMarketplace\Model;

class Customer extends \ArrayObject
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
     * @var string
     */
    protected $customerIdentifier;
    /**
     * 
     *
     * @var string
     */
    protected $customerAwsAccountId;
    /**
     * 
     *
     * @var string
     */
    protected $tenantId;
    /**
     * 
     *
     * @return string
     */
    public function getCustomerIdentifier() : string
    {
        return $this->customerIdentifier;
    }
    /**
     * 
     *
     * @param string $customerIdentifier
     *
     * @return self
     */
    public function setCustomerIdentifier(string $customerIdentifier) : self
    {
        $this->initialized['customerIdentifier'] = true;
        $this->customerIdentifier = $customerIdentifier;
        return $this;
    }
    /**
     * 
     *
     * @return string
     */
    public function getCustomerAwsAccountId() : string
    {
        return $this->customerAwsAccountId;
    }
    /**
     * 
     *
     * @param string $customerAwsAccountId
     *
     * @return self
     */
    public function setCustomerAwsAccountId(string $customerAwsAccountId) : self
    {
        $this->initialized['customerAwsAccountId'] = true;
        $this->customerAwsAccountId = $customerAwsAccountId;
        return $this;
    }
    /**
     * 
     *
     * @return string
     */
    public function getTenantId() : string
    {
        return $this->tenantId;
    }
    /**
     * 
     *
     * @param string $tenantId
     *
     * @return self
     */
    public function setTenantId(string $tenantId) : self
    {
        $this->initialized['tenantId'] = true;
        $this->tenantId = $tenantId;
        return $this;
    }
}
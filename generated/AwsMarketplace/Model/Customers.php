<?php

namespace AntiPatternInc\Saasus\Sdk\AwsMarketplace\Model;

class Customers extends \ArrayObject
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
     * @var Customer[]
     */
    protected $customers;
    /**
     * 
     *
     * @return Customer[]
     */
    public function getCustomers() : array
    {
        return $this->customers;
    }
    /**
     * 
     *
     * @param Customer[] $customers
     *
     * @return self
     */
    public function setCustomers(array $customers) : self
    {
        $this->initialized['customers'] = true;
        $this->customers = $customers;
        return $this;
    }
}
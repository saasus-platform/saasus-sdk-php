<?php

namespace AntiPatternInc\Saasus\Sdk\AwsMarketplace\Model;

class Customers extends \ArrayObject
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
     * 
     *
     * @var list<Customer>|null
     */
    protected $customers;
    /**
     * 
     *
     * @return list<Customer>|null
     */
    public function getCustomers(): ?array
    {
        return $this->customers;
    }
    /**
     * 
     *
     * @param list<Customer>|null $customers
     *
     * @return self
     */
    public function setCustomers(?array $customers): self
    {
        $this->initialized['customers'] = true;
        $this->customers = $customers;
        return $this;
    }
}
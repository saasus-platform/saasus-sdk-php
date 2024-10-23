<?php

namespace AntiPatternInc\Saasus\Sdk\AwsMarketplace\Model;

class Customer extends \ArrayObject
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
     * @var string|null
     */
    protected $customerIdentifier;
    /**
     * 
     *
     * @var string|null
     */
    protected $customerAwsAccountId;
    /**
     * 
     *
     * @var string|null
     */
    protected $tenantId;
    /**
     * 
     *
     * @return string|null
     */
    public function getCustomerIdentifier(): ?string
    {
        return $this->customerIdentifier;
    }
    /**
     * 
     *
     * @param string|null $customerIdentifier
     *
     * @return self
     */
    public function setCustomerIdentifier(?string $customerIdentifier): self
    {
        $this->initialized['customerIdentifier'] = true;
        $this->customerIdentifier = $customerIdentifier;
        return $this;
    }
    /**
     * 
     *
     * @return string|null
     */
    public function getCustomerAwsAccountId(): ?string
    {
        return $this->customerAwsAccountId;
    }
    /**
     * 
     *
     * @param string|null $customerAwsAccountId
     *
     * @return self
     */
    public function setCustomerAwsAccountId(?string $customerAwsAccountId): self
    {
        $this->initialized['customerAwsAccountId'] = true;
        $this->customerAwsAccountId = $customerAwsAccountId;
        return $this;
    }
    /**
     * 
     *
     * @return string|null
     */
    public function getTenantId(): ?string
    {
        return $this->tenantId;
    }
    /**
     * 
     *
     * @param string|null $tenantId
     *
     * @return self
     */
    public function setTenantId(?string $tenantId): self
    {
        $this->initialized['tenantId'] = true;
        $this->tenantId = $tenantId;
        return $this;
    }
}
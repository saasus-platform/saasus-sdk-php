<?php

namespace AntiPatternInc\Saasus\Sdk\AwsMarketplace\Model;

class CreateCustomerParam extends \ArrayObject
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
    protected $tenantId;
    /**
     * 
     *
     * @var string
     */
    protected $registrationToken;
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
    /**
     * 
     *
     * @return string
     */
    public function getRegistrationToken() : string
    {
        return $this->registrationToken;
    }
    /**
     * 
     *
     * @param string $registrationToken
     *
     * @return self
     */
    public function setRegistrationToken(string $registrationToken) : self
    {
        $this->initialized['registrationToken'] = true;
        $this->registrationToken = $registrationToken;
        return $this;
    }
}
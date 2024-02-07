<?php

namespace AntiPatternInc\Saasus\Sdk\Auth\Model;

class ConfirmSignUpWithAwsMarketplaceParam extends \ArrayObject
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
     * テナント名(tenant name)
     *
     * @var string|null
     */
    protected $tenantName;
    /**
     * アクセストークン(access token)
     *
     * @var string|null
     */
    protected $accessToken;
    /**
     * Registration Token
     *
     * @var string|null
     */
    protected $registrationToken;
    /**
     * テナント名(tenant name)
     *
     * @return string|null
     */
    public function getTenantName() : ?string
    {
        return $this->tenantName;
    }
    /**
     * テナント名(tenant name)
     *
     * @param string|null $tenantName
     *
     * @return self
     */
    public function setTenantName(?string $tenantName) : self
    {
        $this->initialized['tenantName'] = true;
        $this->tenantName = $tenantName;
        return $this;
    }
    /**
     * アクセストークン(access token)
     *
     * @return string|null
     */
    public function getAccessToken() : ?string
    {
        return $this->accessToken;
    }
    /**
     * アクセストークン(access token)
     *
     * @param string|null $accessToken
     *
     * @return self
     */
    public function setAccessToken(?string $accessToken) : self
    {
        $this->initialized['accessToken'] = true;
        $this->accessToken = $accessToken;
        return $this;
    }
    /**
     * Registration Token
     *
     * @return string|null
     */
    public function getRegistrationToken() : ?string
    {
        return $this->registrationToken;
    }
    /**
     * Registration Token
     *
     * @param string|null $registrationToken
     *
     * @return self
     */
    public function setRegistrationToken(?string $registrationToken) : self
    {
        $this->initialized['registrationToken'] = true;
        $this->registrationToken = $registrationToken;
        return $this;
    }
}
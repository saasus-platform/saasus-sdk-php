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
     * @var string
     */
    protected $tenantName;
    /**
     * アクセストークン(access token)
     *
     * @var string
     */
    protected $accessToken;
    /**
     * Registration Token
     *
     * @var string
     */
    protected $registrationToken;
    /**
     * テナント名(tenant name)
     *
     * @return string
     */
    public function getTenantName() : string
    {
        return $this->tenantName;
    }
    /**
     * テナント名(tenant name)
     *
     * @param string $tenantName
     *
     * @return self
     */
    public function setTenantName(string $tenantName) : self
    {
        $this->initialized['tenantName'] = true;
        $this->tenantName = $tenantName;
        return $this;
    }
    /**
     * アクセストークン(access token)
     *
     * @return string
     */
    public function getAccessToken() : string
    {
        return $this->accessToken;
    }
    /**
     * アクセストークン(access token)
     *
     * @param string $accessToken
     *
     * @return self
     */
    public function setAccessToken(string $accessToken) : self
    {
        $this->initialized['accessToken'] = true;
        $this->accessToken = $accessToken;
        return $this;
    }
    /**
     * Registration Token
     *
     * @return string
     */
    public function getRegistrationToken() : string
    {
        return $this->registrationToken;
    }
    /**
     * Registration Token
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
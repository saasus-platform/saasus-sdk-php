<?php

namespace AntiPatternInc\Saasus\Sdk\Auth\Model;

class LinkAwsMarketplaceParam extends \ArrayObject
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
     * テナントID(tenant ID)
     *
     * @var string|null
     */
    protected $tenantId;
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
     * テナントID(tenant ID)
     *
     * @return string|null
     */
    public function getTenantId() : ?string
    {
        return $this->tenantId;
    }
    /**
     * テナントID(tenant ID)
     *
     * @param string|null $tenantId
     *
     * @return self
     */
    public function setTenantId(?string $tenantId) : self
    {
        $this->initialized['tenantId'] = true;
        $this->tenantId = $tenantId;
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
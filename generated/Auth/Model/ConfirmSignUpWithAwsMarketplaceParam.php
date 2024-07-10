<?php

namespace AntiPatternInc\Saasus\Sdk\Auth\Model;

class ConfirmSignUpWithAwsMarketplaceParam extends \ArrayObject
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
     * Tenant name
     *
     * @var string|null
     */
    protected $tenantName;
    /**
     * Access token
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
     * Tenant name
     *
     * @return string|null
     */
    public function getTenantName(): ?string
    {
        return $this->tenantName;
    }
    /**
     * Tenant name
     *
     * @param string|null $tenantName
     *
     * @return self
     */
    public function setTenantName(?string $tenantName): self
    {
        $this->initialized['tenantName'] = true;
        $this->tenantName = $tenantName;
        return $this;
    }
    /**
     * Access token
     *
     * @return string|null
     */
    public function getAccessToken(): ?string
    {
        return $this->accessToken;
    }
    /**
     * Access token
     *
     * @param string|null $accessToken
     *
     * @return self
     */
    public function setAccessToken(?string $accessToken): self
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
    public function getRegistrationToken(): ?string
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
    public function setRegistrationToken(?string $registrationToken): self
    {
        $this->initialized['registrationToken'] = true;
        $this->registrationToken = $registrationToken;
        return $this;
    }
}
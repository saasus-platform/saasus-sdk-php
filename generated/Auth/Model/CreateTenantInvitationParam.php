<?php

namespace AntiPatternInc\Saasus\Sdk\Auth\Model;

class CreateTenantInvitationParam extends \ArrayObject
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
     * Email address of the user to be invited
     *
     * @var string|null
     */
    protected $email;
    /**
     * Access token of the user who creates an invitation
     *
     * @var string|null
     */
    protected $accessToken;
    /**
     * 
     *
     * @var list<CreateTenantInvitationParamEnvsItem>|null
     */
    protected $envs;
    /**
     * Email address of the user to be invited
     *
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }
    /**
     * Email address of the user to be invited
     *
     * @param string|null $email
     *
     * @return self
     */
    public function setEmail(?string $email): self
    {
        $this->initialized['email'] = true;
        $this->email = $email;
        return $this;
    }
    /**
     * Access token of the user who creates an invitation
     *
     * @return string|null
     */
    public function getAccessToken(): ?string
    {
        return $this->accessToken;
    }
    /**
     * Access token of the user who creates an invitation
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
     * 
     *
     * @return list<CreateTenantInvitationParamEnvsItem>|null
     */
    public function getEnvs(): ?array
    {
        return $this->envs;
    }
    /**
     * 
     *
     * @param list<CreateTenantInvitationParamEnvsItem>|null $envs
     *
     * @return self
     */
    public function setEnvs(?array $envs): self
    {
        $this->initialized['envs'] = true;
        $this->envs = $envs;
        return $this;
    }
}
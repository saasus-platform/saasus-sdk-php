<?php

namespace AntiPatternInc\Saasus\Sdk\Auth\Model;

class UserAvailableTenant extends \ArrayObject
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
    protected $id;
    /**
     * Tenant Name
     *
     * @var string|null
     */
    protected $name;
    /**
     * 
     *
     * @var bool|null
     */
    protected $completedSignUp;
    /**
     * environmental info, role info
     *
     * @var list<UserAvailableEnv>|null
     */
    protected $envs;
    /**
     * user additional attributes
     *
     * @var array<string, mixed>|null
     */
    protected $userAttribute;
    /**
     * back office contact email
     *
     * @var string|null
     */
    protected $backOfficeStaffEmail;
    /**
     * 
     *
     * @var string|null
     */
    protected $planId;
    /**
    * tenant payment status
    ※ Currently, it is returned only when stripe is linked.
    
    *
    * @var bool|null
    */
    protected $isPaid;
    /**
     * 
     *
     * @return string|null
     */
    public function getId(): ?string
    {
        return $this->id;
    }
    /**
     * 
     *
     * @param string|null $id
     *
     * @return self
     */
    public function setId(?string $id): self
    {
        $this->initialized['id'] = true;
        $this->id = $id;
        return $this;
    }
    /**
     * Tenant Name
     *
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }
    /**
     * Tenant Name
     *
     * @param string|null $name
     *
     * @return self
     */
    public function setName(?string $name): self
    {
        $this->initialized['name'] = true;
        $this->name = $name;
        return $this;
    }
    /**
     * 
     *
     * @return bool|null
     */
    public function getCompletedSignUp(): ?bool
    {
        return $this->completedSignUp;
    }
    /**
     * 
     *
     * @param bool|null $completedSignUp
     *
     * @return self
     */
    public function setCompletedSignUp(?bool $completedSignUp): self
    {
        $this->initialized['completedSignUp'] = true;
        $this->completedSignUp = $completedSignUp;
        return $this;
    }
    /**
     * environmental info, role info
     *
     * @return list<UserAvailableEnv>|null
     */
    public function getEnvs(): ?array
    {
        return $this->envs;
    }
    /**
     * environmental info, role info
     *
     * @param list<UserAvailableEnv>|null $envs
     *
     * @return self
     */
    public function setEnvs(?array $envs): self
    {
        $this->initialized['envs'] = true;
        $this->envs = $envs;
        return $this;
    }
    /**
     * user additional attributes
     *
     * @return array<string, mixed>|null
     */
    public function getUserAttribute(): ?iterable
    {
        return $this->userAttribute;
    }
    /**
     * user additional attributes
     *
     * @param array<string, mixed>|null $userAttribute
     *
     * @return self
     */
    public function setUserAttribute(?iterable $userAttribute): self
    {
        $this->initialized['userAttribute'] = true;
        $this->userAttribute = $userAttribute;
        return $this;
    }
    /**
     * back office contact email
     *
     * @return string|null
     */
    public function getBackOfficeStaffEmail(): ?string
    {
        return $this->backOfficeStaffEmail;
    }
    /**
     * back office contact email
     *
     * @param string|null $backOfficeStaffEmail
     *
     * @return self
     */
    public function setBackOfficeStaffEmail(?string $backOfficeStaffEmail): self
    {
        $this->initialized['backOfficeStaffEmail'] = true;
        $this->backOfficeStaffEmail = $backOfficeStaffEmail;
        return $this;
    }
    /**
     * 
     *
     * @return string|null
     */
    public function getPlanId(): ?string
    {
        return $this->planId;
    }
    /**
     * 
     *
     * @param string|null $planId
     *
     * @return self
     */
    public function setPlanId(?string $planId): self
    {
        $this->initialized['planId'] = true;
        $this->planId = $planId;
        return $this;
    }
    /**
    * tenant payment status
    ※ Currently, it is returned only when stripe is linked.
    
    *
    * @return bool|null
    */
    public function getIsPaid(): ?bool
    {
        return $this->isPaid;
    }
    /**
    * tenant payment status
    ※ Currently, it is returned only when stripe is linked.
    
    *
    * @param bool|null $isPaid
    *
    * @return self
    */
    public function setIsPaid(?bool $isPaid): self
    {
        $this->initialized['isPaid'] = true;
        $this->isPaid = $isPaid;
        return $this;
    }
}
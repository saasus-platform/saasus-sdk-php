<?php

namespace AntiPatternInc\Saasus\Sdk\Auth\Model;

class IdentityProviderProps extends \ArrayObject
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
    protected $applicationId;
    /**
     * 
     *
     * @var string|null
     */
    protected $applicationSecret;
    /**
     * 
     *
     * @var string|null
     */
    protected $approvalScope;
    /**
     * 
     *
     * @var bool|null
     */
    protected $isButtonHidden;
    /**
     * 
     *
     * @return string|null
     */
    public function getApplicationId(): ?string
    {
        return $this->applicationId;
    }
    /**
     * 
     *
     * @param string|null $applicationId
     *
     * @return self
     */
    public function setApplicationId(?string $applicationId): self
    {
        $this->initialized['applicationId'] = true;
        $this->applicationId = $applicationId;
        return $this;
    }
    /**
     * 
     *
     * @return string|null
     */
    public function getApplicationSecret(): ?string
    {
        return $this->applicationSecret;
    }
    /**
     * 
     *
     * @param string|null $applicationSecret
     *
     * @return self
     */
    public function setApplicationSecret(?string $applicationSecret): self
    {
        $this->initialized['applicationSecret'] = true;
        $this->applicationSecret = $applicationSecret;
        return $this;
    }
    /**
     * 
     *
     * @return string|null
     */
    public function getApprovalScope(): ?string
    {
        return $this->approvalScope;
    }
    /**
     * 
     *
     * @param string|null $approvalScope
     *
     * @return self
     */
    public function setApprovalScope(?string $approvalScope): self
    {
        $this->initialized['approvalScope'] = true;
        $this->approvalScope = $approvalScope;
        return $this;
    }
    /**
     * 
     *
     * @return bool|null
     */
    public function getIsButtonHidden(): ?bool
    {
        return $this->isButtonHidden;
    }
    /**
     * 
     *
     * @param bool|null $isButtonHidden
     *
     * @return self
     */
    public function setIsButtonHidden(?bool $isButtonHidden): self
    {
        $this->initialized['isButtonHidden'] = true;
        $this->isButtonHidden = $isButtonHidden;
        return $this;
    }
}
<?php

namespace AntiPatternInc\Saasus\Sdk\Auth\Model;

class IdentityProviderProps extends \ArrayObject
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
    protected $applicationId;
    /**
     * 
     *
     * @var string
     */
    protected $applicationSecret;
    /**
     * 
     *
     * @var string
     */
    protected $approvalScope;
    /**
     * 
     *
     * @var bool
     */
    protected $isButtonHidden;
    /**
     * 
     *
     * @return string
     */
    public function getApplicationId() : string
    {
        return $this->applicationId;
    }
    /**
     * 
     *
     * @param string $applicationId
     *
     * @return self
     */
    public function setApplicationId(string $applicationId) : self
    {
        $this->initialized['applicationId'] = true;
        $this->applicationId = $applicationId;
        return $this;
    }
    /**
     * 
     *
     * @return string
     */
    public function getApplicationSecret() : string
    {
        return $this->applicationSecret;
    }
    /**
     * 
     *
     * @param string $applicationSecret
     *
     * @return self
     */
    public function setApplicationSecret(string $applicationSecret) : self
    {
        $this->initialized['applicationSecret'] = true;
        $this->applicationSecret = $applicationSecret;
        return $this;
    }
    /**
     * 
     *
     * @return string
     */
    public function getApprovalScope() : string
    {
        return $this->approvalScope;
    }
    /**
     * 
     *
     * @param string $approvalScope
     *
     * @return self
     */
    public function setApprovalScope(string $approvalScope) : self
    {
        $this->initialized['approvalScope'] = true;
        $this->approvalScope = $approvalScope;
        return $this;
    }
    /**
     * 
     *
     * @return bool
     */
    public function getIsButtonHidden() : bool
    {
        return $this->isButtonHidden;
    }
    /**
     * 
     *
     * @param bool $isButtonHidden
     *
     * @return self
     */
    public function setIsButtonHidden(bool $isButtonHidden) : self
    {
        $this->initialized['isButtonHidden'] = true;
        $this->isButtonHidden = $isButtonHidden;
        return $this;
    }
}
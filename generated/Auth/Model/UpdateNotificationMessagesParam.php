<?php

namespace AntiPatternInc\Saasus\Sdk\Auth\Model;

class UpdateNotificationMessagesParam extends \ArrayObject
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
     * @var MessageTemplate|null
     */
    protected $signUp;
    /**
     * 
     *
     * @var MessageTemplate|null
     */
    protected $createUser;
    /**
     * 
     *
     * @var MessageTemplate|null
     */
    protected $resendCode;
    /**
     * 
     *
     * @var MessageTemplate|null
     */
    protected $forgotPassword;
    /**
     * 
     *
     * @var MessageTemplate|null
     */
    protected $updateUserAttribute;
    /**
     * 
     *
     * @var MessageTemplate|null
     */
    protected $verifyUserAttribute;
    /**
     * 
     *
     * @var MessageTemplate|null
     */
    protected $authenticationMfa;
    /**
     * 
     *
     * @var MessageTemplate|null
     */
    protected $inviteTenantUser;
    /**
     * 
     *
     * @var MessageTemplate|null
     */
    protected $verifyExternalUser;
    /**
     * 
     *
     * @return MessageTemplate|null
     */
    public function getSignUp() : ?MessageTemplate
    {
        return $this->signUp;
    }
    /**
     * 
     *
     * @param MessageTemplate|null $signUp
     *
     * @return self
     */
    public function setSignUp(?MessageTemplate $signUp) : self
    {
        $this->initialized['signUp'] = true;
        $this->signUp = $signUp;
        return $this;
    }
    /**
     * 
     *
     * @return MessageTemplate|null
     */
    public function getCreateUser() : ?MessageTemplate
    {
        return $this->createUser;
    }
    /**
     * 
     *
     * @param MessageTemplate|null $createUser
     *
     * @return self
     */
    public function setCreateUser(?MessageTemplate $createUser) : self
    {
        $this->initialized['createUser'] = true;
        $this->createUser = $createUser;
        return $this;
    }
    /**
     * 
     *
     * @return MessageTemplate|null
     */
    public function getResendCode() : ?MessageTemplate
    {
        return $this->resendCode;
    }
    /**
     * 
     *
     * @param MessageTemplate|null $resendCode
     *
     * @return self
     */
    public function setResendCode(?MessageTemplate $resendCode) : self
    {
        $this->initialized['resendCode'] = true;
        $this->resendCode = $resendCode;
        return $this;
    }
    /**
     * 
     *
     * @return MessageTemplate|null
     */
    public function getForgotPassword() : ?MessageTemplate
    {
        return $this->forgotPassword;
    }
    /**
     * 
     *
     * @param MessageTemplate|null $forgotPassword
     *
     * @return self
     */
    public function setForgotPassword(?MessageTemplate $forgotPassword) : self
    {
        $this->initialized['forgotPassword'] = true;
        $this->forgotPassword = $forgotPassword;
        return $this;
    }
    /**
     * 
     *
     * @return MessageTemplate|null
     */
    public function getUpdateUserAttribute() : ?MessageTemplate
    {
        return $this->updateUserAttribute;
    }
    /**
     * 
     *
     * @param MessageTemplate|null $updateUserAttribute
     *
     * @return self
     */
    public function setUpdateUserAttribute(?MessageTemplate $updateUserAttribute) : self
    {
        $this->initialized['updateUserAttribute'] = true;
        $this->updateUserAttribute = $updateUserAttribute;
        return $this;
    }
    /**
     * 
     *
     * @return MessageTemplate|null
     */
    public function getVerifyUserAttribute() : ?MessageTemplate
    {
        return $this->verifyUserAttribute;
    }
    /**
     * 
     *
     * @param MessageTemplate|null $verifyUserAttribute
     *
     * @return self
     */
    public function setVerifyUserAttribute(?MessageTemplate $verifyUserAttribute) : self
    {
        $this->initialized['verifyUserAttribute'] = true;
        $this->verifyUserAttribute = $verifyUserAttribute;
        return $this;
    }
    /**
     * 
     *
     * @return MessageTemplate|null
     */
    public function getAuthenticationMfa() : ?MessageTemplate
    {
        return $this->authenticationMfa;
    }
    /**
     * 
     *
     * @param MessageTemplate|null $authenticationMfa
     *
     * @return self
     */
    public function setAuthenticationMfa(?MessageTemplate $authenticationMfa) : self
    {
        $this->initialized['authenticationMfa'] = true;
        $this->authenticationMfa = $authenticationMfa;
        return $this;
    }
    /**
     * 
     *
     * @return MessageTemplate|null
     */
    public function getInviteTenantUser() : ?MessageTemplate
    {
        return $this->inviteTenantUser;
    }
    /**
     * 
     *
     * @param MessageTemplate|null $inviteTenantUser
     *
     * @return self
     */
    public function setInviteTenantUser(?MessageTemplate $inviteTenantUser) : self
    {
        $this->initialized['inviteTenantUser'] = true;
        $this->inviteTenantUser = $inviteTenantUser;
        return $this;
    }
    /**
     * 
     *
     * @return MessageTemplate|null
     */
    public function getVerifyExternalUser() : ?MessageTemplate
    {
        return $this->verifyExternalUser;
    }
    /**
     * 
     *
     * @param MessageTemplate|null $verifyExternalUser
     *
     * @return self
     */
    public function setVerifyExternalUser(?MessageTemplate $verifyExternalUser) : self
    {
        $this->initialized['verifyExternalUser'] = true;
        $this->verifyExternalUser = $verifyExternalUser;
        return $this;
    }
}
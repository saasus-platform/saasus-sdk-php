<?php

namespace AntiPatternInc\Saasus\Sdk\Auth\Model;

class NotificationMessages extends \ArrayObject
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
     * @var MessageTemplate
     */
    protected $signUp;
    /**
     * 
     *
     * @var MessageTemplate
     */
    protected $createUser;
    /**
     * 
     *
     * @var MessageTemplate
     */
    protected $resendCode;
    /**
     * 
     *
     * @var MessageTemplate
     */
    protected $forgotPassword;
    /**
     * 
     *
     * @var MessageTemplate
     */
    protected $updateUserAttribute;
    /**
     * 
     *
     * @var MessageTemplate
     */
    protected $verifyUserAttribute;
    /**
     * 
     *
     * @var MessageTemplate
     */
    protected $authenticationMfa;
    /**
     * 
     *
     * @return MessageTemplate
     */
    public function getSignUp() : MessageTemplate
    {
        return $this->signUp;
    }
    /**
     * 
     *
     * @param MessageTemplate $signUp
     *
     * @return self
     */
    public function setSignUp(MessageTemplate $signUp) : self
    {
        $this->initialized['signUp'] = true;
        $this->signUp = $signUp;
        return $this;
    }
    /**
     * 
     *
     * @return MessageTemplate
     */
    public function getCreateUser() : MessageTemplate
    {
        return $this->createUser;
    }
    /**
     * 
     *
     * @param MessageTemplate $createUser
     *
     * @return self
     */
    public function setCreateUser(MessageTemplate $createUser) : self
    {
        $this->initialized['createUser'] = true;
        $this->createUser = $createUser;
        return $this;
    }
    /**
     * 
     *
     * @return MessageTemplate
     */
    public function getResendCode() : MessageTemplate
    {
        return $this->resendCode;
    }
    /**
     * 
     *
     * @param MessageTemplate $resendCode
     *
     * @return self
     */
    public function setResendCode(MessageTemplate $resendCode) : self
    {
        $this->initialized['resendCode'] = true;
        $this->resendCode = $resendCode;
        return $this;
    }
    /**
     * 
     *
     * @return MessageTemplate
     */
    public function getForgotPassword() : MessageTemplate
    {
        return $this->forgotPassword;
    }
    /**
     * 
     *
     * @param MessageTemplate $forgotPassword
     *
     * @return self
     */
    public function setForgotPassword(MessageTemplate $forgotPassword) : self
    {
        $this->initialized['forgotPassword'] = true;
        $this->forgotPassword = $forgotPassword;
        return $this;
    }
    /**
     * 
     *
     * @return MessageTemplate
     */
    public function getUpdateUserAttribute() : MessageTemplate
    {
        return $this->updateUserAttribute;
    }
    /**
     * 
     *
     * @param MessageTemplate $updateUserAttribute
     *
     * @return self
     */
    public function setUpdateUserAttribute(MessageTemplate $updateUserAttribute) : self
    {
        $this->initialized['updateUserAttribute'] = true;
        $this->updateUserAttribute = $updateUserAttribute;
        return $this;
    }
    /**
     * 
     *
     * @return MessageTemplate
     */
    public function getVerifyUserAttribute() : MessageTemplate
    {
        return $this->verifyUserAttribute;
    }
    /**
     * 
     *
     * @param MessageTemplate $verifyUserAttribute
     *
     * @return self
     */
    public function setVerifyUserAttribute(MessageTemplate $verifyUserAttribute) : self
    {
        $this->initialized['verifyUserAttribute'] = true;
        $this->verifyUserAttribute = $verifyUserAttribute;
        return $this;
    }
    /**
     * 
     *
     * @return MessageTemplate
     */
    public function getAuthenticationMfa() : MessageTemplate
    {
        return $this->authenticationMfa;
    }
    /**
     * 
     *
     * @param MessageTemplate $authenticationMfa
     *
     * @return self
     */
    public function setAuthenticationMfa(MessageTemplate $authenticationMfa) : self
    {
        $this->initialized['authenticationMfa'] = true;
        $this->authenticationMfa = $authenticationMfa;
        return $this;
    }
}
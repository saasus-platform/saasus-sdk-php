<?php

namespace AntiPatternInc\Saasus\Sdk\Auth\Model;

class CustomizePages extends \ArrayObject
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
     * @var CustomizePageProps
     */
    protected $signUpPage;
    /**
     * 
     *
     * @var CustomizePageProps
     */
    protected $signInPage;
    /**
     * 
     *
     * @var CustomizePageProps
     */
    protected $passwordResetPage;
    /**
     * 
     *
     * @return CustomizePageProps
     */
    public function getSignUpPage() : CustomizePageProps
    {
        return $this->signUpPage;
    }
    /**
     * 
     *
     * @param CustomizePageProps $signUpPage
     *
     * @return self
     */
    public function setSignUpPage(CustomizePageProps $signUpPage) : self
    {
        $this->initialized['signUpPage'] = true;
        $this->signUpPage = $signUpPage;
        return $this;
    }
    /**
     * 
     *
     * @return CustomizePageProps
     */
    public function getSignInPage() : CustomizePageProps
    {
        return $this->signInPage;
    }
    /**
     * 
     *
     * @param CustomizePageProps $signInPage
     *
     * @return self
     */
    public function setSignInPage(CustomizePageProps $signInPage) : self
    {
        $this->initialized['signInPage'] = true;
        $this->signInPage = $signInPage;
        return $this;
    }
    /**
     * 
     *
     * @return CustomizePageProps
     */
    public function getPasswordResetPage() : CustomizePageProps
    {
        return $this->passwordResetPage;
    }
    /**
     * 
     *
     * @param CustomizePageProps $passwordResetPage
     *
     * @return self
     */
    public function setPasswordResetPage(CustomizePageProps $passwordResetPage) : self
    {
        $this->initialized['passwordResetPage'] = true;
        $this->passwordResetPage = $passwordResetPage;
        return $this;
    }
}
<?php

namespace AntiPatternInc\Saasus\Sdk\Auth\Model;

class UpdateSignInSettingsParam extends \ArrayObject
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
     * Password Policy
     *
     * @var PasswordPolicy|null
     */
    protected $passwordPolicy;
    /**
     * Settings for remembering trusted devices
     *
     * @var DeviceConfiguration|null
     */
    protected $deviceConfiguration;
    /**
    * MFA device authentication settings
    ※ This function is not yet provided, so it cannot be changed or saved.
    
    *
    * @var MfaConfiguration|null
    */
    protected $mfaConfiguration;
    /**
    * reCAPTCHA authentication settings
    ※ This function is not yet provided, so it cannot be changed or saved.
    
    *
    * @var RecaptchaProps|null
    */
    protected $recaptchaProps;
    /**
    * Account authentication settings
    ※ This function is not yet provided, so it cannot be changed or saved.
    
    *
    * @var AccountVerification|null
    */
    protected $accountVerification;
    /**
     * self sign-up permission
     *
     * @var SelfRegist|null
     */
    protected $selfRegist;
    /**
     * Password Policy
     *
     * @return PasswordPolicy|null
     */
    public function getPasswordPolicy(): ?PasswordPolicy
    {
        return $this->passwordPolicy;
    }
    /**
     * Password Policy
     *
     * @param PasswordPolicy|null $passwordPolicy
     *
     * @return self
     */
    public function setPasswordPolicy(?PasswordPolicy $passwordPolicy): self
    {
        $this->initialized['passwordPolicy'] = true;
        $this->passwordPolicy = $passwordPolicy;
        return $this;
    }
    /**
     * Settings for remembering trusted devices
     *
     * @return DeviceConfiguration|null
     */
    public function getDeviceConfiguration(): ?DeviceConfiguration
    {
        return $this->deviceConfiguration;
    }
    /**
     * Settings for remembering trusted devices
     *
     * @param DeviceConfiguration|null $deviceConfiguration
     *
     * @return self
     */
    public function setDeviceConfiguration(?DeviceConfiguration $deviceConfiguration): self
    {
        $this->initialized['deviceConfiguration'] = true;
        $this->deviceConfiguration = $deviceConfiguration;
        return $this;
    }
    /**
    * MFA device authentication settings
    ※ This function is not yet provided, so it cannot be changed or saved.
    
    *
    * @return MfaConfiguration|null
    */
    public function getMfaConfiguration(): ?MfaConfiguration
    {
        return $this->mfaConfiguration;
    }
    /**
    * MFA device authentication settings
    ※ This function is not yet provided, so it cannot be changed or saved.
    
    *
    * @param MfaConfiguration|null $mfaConfiguration
    *
    * @return self
    */
    public function setMfaConfiguration(?MfaConfiguration $mfaConfiguration): self
    {
        $this->initialized['mfaConfiguration'] = true;
        $this->mfaConfiguration = $mfaConfiguration;
        return $this;
    }
    /**
    * reCAPTCHA authentication settings
    ※ This function is not yet provided, so it cannot be changed or saved.
    
    *
    * @return RecaptchaProps|null
    */
    public function getRecaptchaProps(): ?RecaptchaProps
    {
        return $this->recaptchaProps;
    }
    /**
    * reCAPTCHA authentication settings
    ※ This function is not yet provided, so it cannot be changed or saved.
    
    *
    * @param RecaptchaProps|null $recaptchaProps
    *
    * @return self
    */
    public function setRecaptchaProps(?RecaptchaProps $recaptchaProps): self
    {
        $this->initialized['recaptchaProps'] = true;
        $this->recaptchaProps = $recaptchaProps;
        return $this;
    }
    /**
    * Account authentication settings
    ※ This function is not yet provided, so it cannot be changed or saved.
    
    *
    * @return AccountVerification|null
    */
    public function getAccountVerification(): ?AccountVerification
    {
        return $this->accountVerification;
    }
    /**
    * Account authentication settings
    ※ This function is not yet provided, so it cannot be changed or saved.
    
    *
    * @param AccountVerification|null $accountVerification
    *
    * @return self
    */
    public function setAccountVerification(?AccountVerification $accountVerification): self
    {
        $this->initialized['accountVerification'] = true;
        $this->accountVerification = $accountVerification;
        return $this;
    }
    /**
     * self sign-up permission
     *
     * @return SelfRegist|null
     */
    public function getSelfRegist(): ?SelfRegist
    {
        return $this->selfRegist;
    }
    /**
     * self sign-up permission
     *
     * @param SelfRegist|null $selfRegist
     *
     * @return self
     */
    public function setSelfRegist(?SelfRegist $selfRegist): self
    {
        $this->initialized['selfRegist'] = true;
        $this->selfRegist = $selfRegist;
        return $this;
    }
}
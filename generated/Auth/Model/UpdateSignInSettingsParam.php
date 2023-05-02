<?php

namespace AntiPatternInc\Saasus\Sdk\Auth\Model;

class UpdateSignInSettingsParam extends \ArrayObject
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
     * パスワードポリシー(password policy)
     *
     * @var PasswordPolicy
     */
    protected $passwordPolicy;
    /**
     * 信頼済みデバイスの記憶の設定(settings for remembering trusted devices)
     *
     * @var DeviceConfiguration
     */
    protected $deviceConfiguration;
    /**
    * MFAデバイス認証設定(MFA device authentication settings)
    ※ 未提供の機能のため、変更・保存はできません(This function is not yet provided, so it cannot be changed or saved.)
    
    *
    * @var MfaConfiguration
    */
    protected $mfaConfiguration;
    /**
    * reCAPTCHA認証設定(reCAPTCHA authentication settings)
    ※ 未提供の機能のため、変更・保存はできません(This function is not yet provided, so it cannot be changed or saved.)
    
    *
    * @var RecaptchaProps
    */
    protected $recaptchaProps;
    /**
    * アカウント認証設定(account authentication settings)
    ※ 未提供の機能のため、変更・保存はできません(This function is not yet provided, so it cannot be changed or saved.)
    
    *
    * @var AccountVerification
    */
    protected $accountVerification;
    /**
     * セルフサインアップを許可設定(self sign-up permission)
     *
     * @var SelfRegist
     */
    protected $selfRegist;
    /**
     * パスワードポリシー(password policy)
     *
     * @return PasswordPolicy
     */
    public function getPasswordPolicy() : PasswordPolicy
    {
        return $this->passwordPolicy;
    }
    /**
     * パスワードポリシー(password policy)
     *
     * @param PasswordPolicy $passwordPolicy
     *
     * @return self
     */
    public function setPasswordPolicy(PasswordPolicy $passwordPolicy) : self
    {
        $this->initialized['passwordPolicy'] = true;
        $this->passwordPolicy = $passwordPolicy;
        return $this;
    }
    /**
     * 信頼済みデバイスの記憶の設定(settings for remembering trusted devices)
     *
     * @return DeviceConfiguration
     */
    public function getDeviceConfiguration() : DeviceConfiguration
    {
        return $this->deviceConfiguration;
    }
    /**
     * 信頼済みデバイスの記憶の設定(settings for remembering trusted devices)
     *
     * @param DeviceConfiguration $deviceConfiguration
     *
     * @return self
     */
    public function setDeviceConfiguration(DeviceConfiguration $deviceConfiguration) : self
    {
        $this->initialized['deviceConfiguration'] = true;
        $this->deviceConfiguration = $deviceConfiguration;
        return $this;
    }
    /**
    * MFAデバイス認証設定(MFA device authentication settings)
    ※ 未提供の機能のため、変更・保存はできません(This function is not yet provided, so it cannot be changed or saved.)
    
    *
    * @return MfaConfiguration
    */
    public function getMfaConfiguration() : MfaConfiguration
    {
        return $this->mfaConfiguration;
    }
    /**
    * MFAデバイス認証設定(MFA device authentication settings)
    ※ 未提供の機能のため、変更・保存はできません(This function is not yet provided, so it cannot be changed or saved.)
    
    *
    * @param MfaConfiguration $mfaConfiguration
    *
    * @return self
    */
    public function setMfaConfiguration(MfaConfiguration $mfaConfiguration) : self
    {
        $this->initialized['mfaConfiguration'] = true;
        $this->mfaConfiguration = $mfaConfiguration;
        return $this;
    }
    /**
    * reCAPTCHA認証設定(reCAPTCHA authentication settings)
    ※ 未提供の機能のため、変更・保存はできません(This function is not yet provided, so it cannot be changed or saved.)
    
    *
    * @return RecaptchaProps
    */
    public function getRecaptchaProps() : RecaptchaProps
    {
        return $this->recaptchaProps;
    }
    /**
    * reCAPTCHA認証設定(reCAPTCHA authentication settings)
    ※ 未提供の機能のため、変更・保存はできません(This function is not yet provided, so it cannot be changed or saved.)
    
    *
    * @param RecaptchaProps $recaptchaProps
    *
    * @return self
    */
    public function setRecaptchaProps(RecaptchaProps $recaptchaProps) : self
    {
        $this->initialized['recaptchaProps'] = true;
        $this->recaptchaProps = $recaptchaProps;
        return $this;
    }
    /**
    * アカウント認証設定(account authentication settings)
    ※ 未提供の機能のため、変更・保存はできません(This function is not yet provided, so it cannot be changed or saved.)
    
    *
    * @return AccountVerification
    */
    public function getAccountVerification() : AccountVerification
    {
        return $this->accountVerification;
    }
    /**
    * アカウント認証設定(account authentication settings)
    ※ 未提供の機能のため、変更・保存はできません(This function is not yet provided, so it cannot be changed or saved.)
    
    *
    * @param AccountVerification $accountVerification
    *
    * @return self
    */
    public function setAccountVerification(AccountVerification $accountVerification) : self
    {
        $this->initialized['accountVerification'] = true;
        $this->accountVerification = $accountVerification;
        return $this;
    }
    /**
     * セルフサインアップを許可設定(self sign-up permission)
     *
     * @return SelfRegist
     */
    public function getSelfRegist() : SelfRegist
    {
        return $this->selfRegist;
    }
    /**
     * セルフサインアップを許可設定(self sign-up permission)
     *
     * @param SelfRegist $selfRegist
     *
     * @return self
     */
    public function setSelfRegist(SelfRegist $selfRegist) : self
    {
        $this->initialized['selfRegist'] = true;
        $this->selfRegist = $selfRegist;
        return $this;
    }
}
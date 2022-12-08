<?php

namespace AntiPatternInc\Saasus\Sdk\Auth\Model;

class SignInSettings extends \ArrayObject
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
     * パスワードポリシー
     *
     * @var PasswordPolicy
     */
    protected $passwordPolicy;
    /**
     * 信頼済みデバイスの記憶の設定
     *
     * @var DeviceConfiguration
     */
    protected $deviceConfiguration;
    /**
    * MFAデバイス認証設定
    未提供の機能のため、変更・保存はできません
    
    *
    * @var MfaConfiguration
    */
    protected $mfaConfiguration;
    /**
    * reCAPTCHA認証設定
    未提供の機能のため、変更・保存はできません
    
    *
    * @var RecaptchaProps
    */
    protected $recaptchaProps;
    /**
    * アカウント認証設定
    未提供の機能のため、変更・保存はできません
    
    *
    * @var AccountVerification
    */
    protected $accountVerification;
    /**
     * セルフサインアップを許可設定
     *
     * @var SelfRegist
     */
    protected $selfRegist;
    /**
     * パスワードポリシー
     *
     * @return PasswordPolicy
     */
    public function getPasswordPolicy() : PasswordPolicy
    {
        return $this->passwordPolicy;
    }
    /**
     * パスワードポリシー
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
     * 信頼済みデバイスの記憶の設定
     *
     * @return DeviceConfiguration
     */
    public function getDeviceConfiguration() : DeviceConfiguration
    {
        return $this->deviceConfiguration;
    }
    /**
     * 信頼済みデバイスの記憶の設定
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
    * MFAデバイス認証設定
    未提供の機能のため、変更・保存はできません
    
    *
    * @return MfaConfiguration
    */
    public function getMfaConfiguration() : MfaConfiguration
    {
        return $this->mfaConfiguration;
    }
    /**
    * MFAデバイス認証設定
    未提供の機能のため、変更・保存はできません
    
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
    * reCAPTCHA認証設定
    未提供の機能のため、変更・保存はできません
    
    *
    * @return RecaptchaProps
    */
    public function getRecaptchaProps() : RecaptchaProps
    {
        return $this->recaptchaProps;
    }
    /**
    * reCAPTCHA認証設定
    未提供の機能のため、変更・保存はできません
    
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
    * アカウント認証設定
    未提供の機能のため、変更・保存はできません
    
    *
    * @return AccountVerification
    */
    public function getAccountVerification() : AccountVerification
    {
        return $this->accountVerification;
    }
    /**
    * アカウント認証設定
    未提供の機能のため、変更・保存はできません
    
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
     * セルフサインアップを許可設定
     *
     * @return SelfRegist
     */
    public function getSelfRegist() : SelfRegist
    {
        return $this->selfRegist;
    }
    /**
     * セルフサインアップを許可設定
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
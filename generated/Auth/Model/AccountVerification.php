<?php

namespace AntiPatternInc\Saasus\Sdk\Auth\Model;

class AccountVerification extends \ArrayObject
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
    * code: 検証コード(verification code)
    link: 検証リンク(verification link)
    ※ 未提供の機能のため、変更・保存はできません(This function is not yet provided, so it cannot be changed or saved.)
    
    *
    * @var string
    */
    protected $verificationMethod;
    /**
    * email: Eメール(e-mail)
    sms: SMS
    smsOrEmail: SMS不可の場合にEメール(email if SMS is not possible)
    
    *
    * @var string
    */
    protected $sendingTo;
    /**
    * code: 検証コード(verification code)
    link: 検証リンク(verification link)
    ※ 未提供の機能のため、変更・保存はできません(This function is not yet provided, so it cannot be changed or saved.)
    
    *
    * @return string
    */
    public function getVerificationMethod() : string
    {
        return $this->verificationMethod;
    }
    /**
    * code: 検証コード(verification code)
    link: 検証リンク(verification link)
    ※ 未提供の機能のため、変更・保存はできません(This function is not yet provided, so it cannot be changed or saved.)
    
    *
    * @param string $verificationMethod
    *
    * @return self
    */
    public function setVerificationMethod(string $verificationMethod) : self
    {
        $this->initialized['verificationMethod'] = true;
        $this->verificationMethod = $verificationMethod;
        return $this;
    }
    /**
    * email: Eメール(e-mail)
    sms: SMS
    smsOrEmail: SMS不可の場合にEメール(email if SMS is not possible)
    
    *
    * @return string
    */
    public function getSendingTo() : string
    {
        return $this->sendingTo;
    }
    /**
    * email: Eメール(e-mail)
    sms: SMS
    smsOrEmail: SMS不可の場合にEメール(email if SMS is not possible)
    
    *
    * @param string $sendingTo
    *
    * @return self
    */
    public function setSendingTo(string $sendingTo) : self
    {
        $this->initialized['sendingTo'] = true;
        $this->sendingTo = $sendingTo;
        return $this;
    }
}
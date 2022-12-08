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
    * code: 検証コード
    link: 検証リンク
    
    *
    * @var string
    */
    protected $verificationMethod;
    /**
    * email: Eメール
    sms: SMS
    smsOrEmail: SMS不可の場合にEメール
    
    *
    * @var string
    */
    protected $sendingTo;
    /**
    * code: 検証コード
    link: 検証リンク
    
    *
    * @return string
    */
    public function getVerificationMethod() : string
    {
        return $this->verificationMethod;
    }
    /**
    * code: 検証コード
    link: 検証リンク
    
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
    * email: Eメール
    sms: SMS
    smsOrEmail: SMS不可の場合にEメール
    
    *
    * @return string
    */
    public function getSendingTo() : string
    {
        return $this->sendingTo;
    }
    /**
    * email: Eメール
    sms: SMS
    smsOrEmail: SMS不可の場合にEメール
    
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
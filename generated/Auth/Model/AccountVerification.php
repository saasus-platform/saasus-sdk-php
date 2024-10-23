<?php

namespace AntiPatternInc\Saasus\Sdk\Auth\Model;

class AccountVerification extends \ArrayObject
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
    * code: verification code
    link: verification link
    ※ This function is not yet provided, so it cannot be changed or saved.
    
    *
    * @var string|null
    */
    protected $verificationMethod;
    /**
    * email: e-mail
    sms: SMS
    smsOrEmail: email if SMS is not possible
    
    *
    * @var string|null
    */
    protected $sendingTo;
    /**
    * code: verification code
    link: verification link
    ※ This function is not yet provided, so it cannot be changed or saved.
    
    *
    * @return string|null
    */
    public function getVerificationMethod(): ?string
    {
        return $this->verificationMethod;
    }
    /**
    * code: verification code
    link: verification link
    ※ This function is not yet provided, so it cannot be changed or saved.
    
    *
    * @param string|null $verificationMethod
    *
    * @return self
    */
    public function setVerificationMethod(?string $verificationMethod): self
    {
        $this->initialized['verificationMethod'] = true;
        $this->verificationMethod = $verificationMethod;
        return $this;
    }
    /**
    * email: e-mail
    sms: SMS
    smsOrEmail: email if SMS is not possible
    
    *
    * @return string|null
    */
    public function getSendingTo(): ?string
    {
        return $this->sendingTo;
    }
    /**
    * email: e-mail
    sms: SMS
    smsOrEmail: email if SMS is not possible
    
    *
    * @param string|null $sendingTo
    *
    * @return self
    */
    public function setSendingTo(?string $sendingTo): self
    {
        $this->initialized['sendingTo'] = true;
        $this->sendingTo = $sendingTo;
        return $this;
    }
}
<?php

namespace AntiPatternInc\Saasus\Sdk\Auth\Model;

class SignUpWithAwsMarketplaceParam extends \ArrayObject
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
     * メールアドレス(Email Address)
     *
     * @var string
     */
    protected $email;
    /**
     * Registration Token
     *
     * @var string
     */
    protected $registrationToken;
    /**
     * メールアドレス(Email Address)
     *
     * @return string
     */
    public function getEmail() : string
    {
        return $this->email;
    }
    /**
     * メールアドレス(Email Address)
     *
     * @param string $email
     *
     * @return self
     */
    public function setEmail(string $email) : self
    {
        $this->initialized['email'] = true;
        $this->email = $email;
        return $this;
    }
    /**
     * Registration Token
     *
     * @return string
     */
    public function getRegistrationToken() : string
    {
        return $this->registrationToken;
    }
    /**
     * Registration Token
     *
     * @param string $registrationToken
     *
     * @return self
     */
    public function setRegistrationToken(string $registrationToken) : self
    {
        $this->initialized['registrationToken'] = true;
        $this->registrationToken = $registrationToken;
        return $this;
    }
}
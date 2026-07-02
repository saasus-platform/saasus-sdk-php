<?php

namespace AntiPatternInc\Saasus\Sdk\Auth\Model;

class CreateSaasUserParam extends \ArrayObject
{
    /**
     * @var array
     */
    protected $initialized = [];
    public function isInitialized($property) : bool
    {
        return array_key_exists($property, $this->initialized);
    }
    /**
     * E-mail
     *
     * @var string|null
     */
    protected $email;
    /**
     * Sign-in ID (alphanumeric and symbols -_ only, max 50 characters)
     *
     * @var string|null
     */
    protected $signInId;
    /**
    * Password.
    For email authentication, if not specified, a temporary password will be sent by email.
    For sign-in ID authentication, if not specified, password will be auto-generated and returned.
    
    *
    * @var string|null
    */
    protected $password;
    /**
     * E-mail
     *
     * @return string|null
     */
    public function getEmail() : ?string
    {
        return $this->email;
    }
    /**
     * E-mail
     *
     * @param string|null $email
     *
     * @return self
     */
    public function setEmail(?string $email) : self
    {
        $this->initialized['email'] = true;
        $this->email = $email;
        return $this;
    }
    /**
     * Sign-in ID (alphanumeric and symbols -_ only, max 50 characters)
     *
     * @return string|null
     */
    public function getSignInId() : ?string
    {
        return $this->signInId;
    }
    /**
     * Sign-in ID (alphanumeric and symbols -_ only, max 50 characters)
     *
     * @param string|null $signInId
     *
     * @return self
     */
    public function setSignInId(?string $signInId) : self
    {
        $this->initialized['signInId'] = true;
        $this->signInId = $signInId;
        return $this;
    }
    /**
    * Password.
    For email authentication, if not specified, a temporary password will be sent by email.
    For sign-in ID authentication, if not specified, password will be auto-generated and returned.
    
    *
    * @return string|null
    */
    public function getPassword() : ?string
    {
        return $this->password;
    }
    /**
    * Password.
    For email authentication, if not specified, a temporary password will be sent by email.
    For sign-in ID authentication, if not specified, password will be auto-generated and returned.
    
    *
    * @param string|null $password
    *
    * @return self
    */
    public function setPassword(?string $password) : self
    {
        $this->initialized['password'] = true;
        $this->password = $password;
        return $this;
    }
}
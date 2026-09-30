<?php

namespace AntiPatternInc\Saasus\Sdk\Auth\Model;

class SignInParam extends \ArrayObject
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
    * The sign-in flow to use for authentication.
    Currently, only USER_SRP_AUTH is supported.
    
    *
    * @var string|null
    */
    protected $signInFlow;
    /**
    * The required parameters vary depending on the sign_in_flow.
    USER_SRP_AUTH:
     USERNAME: email address
     SRP_A: SRP A value
    
    *
    * @var array<string, string>|null
    */
    protected $signInParameters;
    /**
    * The sign-in flow to use for authentication.
    Currently, only USER_SRP_AUTH is supported.
    
    *
    * @return string|null
    */
    public function getSignInFlow() : ?string
    {
        return $this->signInFlow;
    }
    /**
    * The sign-in flow to use for authentication.
    Currently, only USER_SRP_AUTH is supported.
    
    *
    * @param string|null $signInFlow
    *
    * @return self
    */
    public function setSignInFlow(?string $signInFlow) : self
    {
        $this->initialized['signInFlow'] = true;
        $this->signInFlow = $signInFlow;
        return $this;
    }
    /**
    * The required parameters vary depending on the sign_in_flow.
    USER_SRP_AUTH:
     USERNAME: email address
     SRP_A: SRP A value
    
    *
    * @return array<string, string>|null
    */
    public function getSignInParameters() : ?iterable
    {
        return $this->signInParameters;
    }
    /**
    * The required parameters vary depending on the sign_in_flow.
    USER_SRP_AUTH:
     USERNAME: email address
     SRP_A: SRP A value
    
    *
    * @param array<string, string>|null $signInParameters
    *
    * @return self
    */
    public function setSignInParameters(?iterable $signInParameters) : self
    {
        $this->initialized['signInParameters'] = true;
        $this->signInParameters = $signInParameters;
        return $this;
    }
}
<?php

namespace AntiPatternInc\Saasus\Sdk\Auth\Model;

class ExchangeAuthCredentialsParam extends \ArrayObject
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
     * Authentication flow used for the exchange
     *
     * @var string|null
     */
    protected $authFlow;
    /**
     * 
     *
     * @var string|null
     */
    protected $code;
    /**
     * PKCE code verifier associated with the temporary code
     *
     * @var string|null
     */
    protected $codeVerifier;
    /**
     * Authentication flow used for the exchange
     *
     * @return string|null
     */
    public function getAuthFlow() : ?string
    {
        return $this->authFlow;
    }
    /**
     * Authentication flow used for the exchange
     *
     * @param string|null $authFlow
     *
     * @return self
     */
    public function setAuthFlow(?string $authFlow) : self
    {
        $this->initialized['authFlow'] = true;
        $this->authFlow = $authFlow;
        return $this;
    }
    /**
     * 
     *
     * @return string|null
     */
    public function getCode() : ?string
    {
        return $this->code;
    }
    /**
     * 
     *
     * @param string|null $code
     *
     * @return self
     */
    public function setCode(?string $code) : self
    {
        $this->initialized['code'] = true;
        $this->code = $code;
        return $this;
    }
    /**
     * PKCE code verifier associated with the temporary code
     *
     * @return string|null
     */
    public function getCodeVerifier() : ?string
    {
        return $this->codeVerifier;
    }
    /**
     * PKCE code verifier associated with the temporary code
     *
     * @param string|null $codeVerifier
     *
     * @return self
     */
    public function setCodeVerifier(?string $codeVerifier) : self
    {
        $this->initialized['codeVerifier'] = true;
        $this->codeVerifier = $codeVerifier;
        return $this;
    }
}
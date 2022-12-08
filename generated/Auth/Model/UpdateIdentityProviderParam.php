<?php

namespace AntiPatternInc\Saasus\Sdk\Auth\Model;

class UpdateIdentityProviderParam extends \ArrayObject
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
     * 
     *
     * @var string
     */
    protected $provider;
    /**
     * 
     *
     * @var IdentityProviderProps
     */
    protected $identityProviderProps;
    /**
     * 
     *
     * @return string
     */
    public function getProvider() : string
    {
        return $this->provider;
    }
    /**
     * 
     *
     * @param string $provider
     *
     * @return self
     */
    public function setProvider(string $provider) : self
    {
        $this->initialized['provider'] = true;
        $this->provider = $provider;
        return $this;
    }
    /**
     * 
     *
     * @return IdentityProviderProps
     */
    public function getIdentityProviderProps() : IdentityProviderProps
    {
        return $this->identityProviderProps;
    }
    /**
     * 
     *
     * @param IdentityProviderProps $identityProviderProps
     *
     * @return self
     */
    public function setIdentityProviderProps(IdentityProviderProps $identityProviderProps) : self
    {
        $this->initialized['identityProviderProps'] = true;
        $this->identityProviderProps = $identityProviderProps;
        return $this;
    }
}
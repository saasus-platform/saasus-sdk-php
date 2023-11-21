<?php

namespace AntiPatternInc\Saasus\Sdk\Auth\Model;

class UpdateTenantIdentityProviderParam extends \ArrayObject
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
    protected $providerType;
    /**
     * 
     *
     * @var mixed[]
     */
    protected $identityProviderProps;
    /**
     * 
     *
     * @return string
     */
    public function getProviderType() : string
    {
        return $this->providerType;
    }
    /**
     * 
     *
     * @param string $providerType
     *
     * @return self
     */
    public function setProviderType(string $providerType) : self
    {
        $this->initialized['providerType'] = true;
        $this->providerType = $providerType;
        return $this;
    }
    /**
     * 
     *
     * @return mixed[]
     */
    public function getIdentityProviderProps() : iterable
    {
        return $this->identityProviderProps;
    }
    /**
     * 
     *
     * @param mixed[] $identityProviderProps
     *
     * @return self
     */
    public function setIdentityProviderProps(iterable $identityProviderProps) : self
    {
        $this->initialized['identityProviderProps'] = true;
        $this->identityProviderProps = $identityProviderProps;
        return $this;
    }
}
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
     * @var string|null
     */
    protected $providerType;
    /**
     * 
     *
     * @var mixed[]|null
     */
    protected $identityProviderProps;
    /**
     * 
     *
     * @return string|null
     */
    public function getProviderType() : ?string
    {
        return $this->providerType;
    }
    /**
     * 
     *
     * @param string|null $providerType
     *
     * @return self
     */
    public function setProviderType(?string $providerType) : self
    {
        $this->initialized['providerType'] = true;
        $this->providerType = $providerType;
        return $this;
    }
    /**
     * 
     *
     * @return mixed[]|null
     */
    public function getIdentityProviderProps() : ?iterable
    {
        return $this->identityProviderProps;
    }
    /**
     * 
     *
     * @param mixed[]|null $identityProviderProps
     *
     * @return self
     */
    public function setIdentityProviderProps(?iterable $identityProviderProps) : self
    {
        $this->initialized['identityProviderProps'] = true;
        $this->identityProviderProps = $identityProviderProps;
        return $this;
    }
}
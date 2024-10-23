<?php

namespace AntiPatternInc\Saasus\Sdk\Auth\Model;

class UpdateIdentityProviderParam extends \ArrayObject
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
     * 
     *
     * @var string|null
     */
    protected $provider;
    /**
     * 
     *
     * @var IdentityProviderProps|null
     */
    protected $identityProviderProps;
    /**
     * 
     *
     * @return string|null
     */
    public function getProvider(): ?string
    {
        return $this->provider;
    }
    /**
     * 
     *
     * @param string|null $provider
     *
     * @return self
     */
    public function setProvider(?string $provider): self
    {
        $this->initialized['provider'] = true;
        $this->provider = $provider;
        return $this;
    }
    /**
     * 
     *
     * @return IdentityProviderProps|null
     */
    public function getIdentityProviderProps(): ?IdentityProviderProps
    {
        return $this->identityProviderProps;
    }
    /**
     * 
     *
     * @param IdentityProviderProps|null $identityProviderProps
     *
     * @return self
     */
    public function setIdentityProviderProps(?IdentityProviderProps $identityProviderProps): self
    {
        $this->initialized['identityProviderProps'] = true;
        $this->identityProviderProps = $identityProviderProps;
        return $this;
    }
}
<?php

namespace AntiPatternInc\Saasus\Sdk\Auth\Model;

class IdentityProviders extends \ArrayObject
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
     * @var IdentityProviderProps|null
     */
    protected $google;
    /**
     * 
     *
     * @return IdentityProviderProps|null
     */
    public function getGoogle() : ?IdentityProviderProps
    {
        return $this->google;
    }
    /**
     * 
     *
     * @param IdentityProviderProps|null $google
     *
     * @return self
     */
    public function setGoogle(?IdentityProviderProps $google) : self
    {
        $this->initialized['google'] = true;
        $this->google = $google;
        return $this;
    }
}
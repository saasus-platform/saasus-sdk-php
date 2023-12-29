<?php

namespace AntiPatternInc\Saasus\Sdk\Auth\Model;

class TenantIdentityProviders extends \ArrayObject
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
     * @var mixed[]|null
     */
    protected $saml;
    /**
     * 
     *
     * @return mixed[]|null
     */
    public function getSaml() : ?iterable
    {
        return $this->saml;
    }
    /**
     * 
     *
     * @param mixed[]|null $saml
     *
     * @return self
     */
    public function setSaml(?iterable $saml) : self
    {
        $this->initialized['saml'] = true;
        $this->saml = $saml;
        return $this;
    }
}
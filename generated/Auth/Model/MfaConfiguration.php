<?php

namespace AntiPatternInc\Saasus\Sdk\Auth\Model;

class MfaConfiguration extends \ArrayObject
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
    * on: apply when all users log in
    optional: apply to individual users with MFA factor enabled
    ※ The parameter is currently optional and fixed.
    
    *
    * @var string|null
    */
    protected $mfaConfiguration;
    /**
    * on: apply when all users log in
    optional: apply to individual users with MFA factor enabled
    ※ The parameter is currently optional and fixed.
    
    *
    * @return string|null
    */
    public function getMfaConfiguration(): ?string
    {
        return $this->mfaConfiguration;
    }
    /**
    * on: apply when all users log in
    optional: apply to individual users with MFA factor enabled
    ※ The parameter is currently optional and fixed.
    
    *
    * @param string|null $mfaConfiguration
    *
    * @return self
    */
    public function setMfaConfiguration(?string $mfaConfiguration): self
    {
        $this->initialized['mfaConfiguration'] = true;
        $this->mfaConfiguration = $mfaConfiguration;
        return $this;
    }
}
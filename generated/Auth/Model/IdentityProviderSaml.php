<?php

namespace AntiPatternInc\Saasus\Sdk\Auth\Model;

class IdentityProviderSaml extends \ArrayObject
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
    protected $metadataUrl;
    /**
     * 
     *
     * @var string|null
     */
    protected $emailAttribute;
    /**
     * 
     *
     * @return string|null
     */
    public function getMetadataUrl(): ?string
    {
        return $this->metadataUrl;
    }
    /**
     * 
     *
     * @param string|null $metadataUrl
     *
     * @return self
     */
    public function setMetadataUrl(?string $metadataUrl): self
    {
        $this->initialized['metadataUrl'] = true;
        $this->metadataUrl = $metadataUrl;
        return $this;
    }
    /**
     * 
     *
     * @return string|null
     */
    public function getEmailAttribute(): ?string
    {
        return $this->emailAttribute;
    }
    /**
     * 
     *
     * @param string|null $emailAttribute
     *
     * @return self
     */
    public function setEmailAttribute(?string $emailAttribute): self
    {
        $this->initialized['emailAttribute'] = true;
        $this->emailAttribute = $emailAttribute;
        return $this;
    }
}
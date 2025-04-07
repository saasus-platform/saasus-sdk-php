<?php

namespace AntiPatternInc\Saasus\Sdk\AwsMarketplace\Model;

class CatalogEntityVisibility extends \ArrayObject
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
    protected $visibility;
    /**
     * 
     *
     * @return string|null
     */
    public function getVisibility(): ?string
    {
        return $this->visibility;
    }
    /**
     * 
     *
     * @param string|null $visibility
     *
     * @return self
     */
    public function setVisibility(?string $visibility): self
    {
        $this->initialized['visibility'] = true;
        $this->visibility = $visibility;
        return $this;
    }
}
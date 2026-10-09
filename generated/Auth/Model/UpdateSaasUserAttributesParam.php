<?php

namespace AntiPatternInc\Saasus\Sdk\Auth\Model;

class UpdateSaasUserAttributesParam extends \ArrayObject
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
     * Attribute information
     *
     * @var array<string, mixed>|null
     */
    protected $attributes;
    /**
     * Attribute information
     *
     * @return array<string, mixed>|null
     */
    public function getAttributes() : ?iterable
    {
        return $this->attributes;
    }
    /**
     * Attribute information
     *
     * @param array<string, mixed>|null $attributes
     *
     * @return self
     */
    public function setAttributes(?iterable $attributes) : self
    {
        $this->initialized['attributes'] = true;
        $this->attributes = $attributes;
        return $this;
    }
}
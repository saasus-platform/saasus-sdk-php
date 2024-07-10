<?php

namespace AntiPatternInc\Saasus\Sdk\Auth\Model;

class CreateTenantUserParam extends \ArrayObject
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
     * E-mail
     *
     * @var string|null
     */
    protected $email;
    /**
     * Attribute information (Get information set by defining user attributes in the SaaS development console)
     *
     * @var array<string, mixed>|null
     */
    protected $attributes;
    /**
     * E-mail
     *
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }
    /**
     * E-mail
     *
     * @param string|null $email
     *
     * @return self
     */
    public function setEmail(?string $email): self
    {
        $this->initialized['email'] = true;
        $this->email = $email;
        return $this;
    }
    /**
     * Attribute information (Get information set by defining user attributes in the SaaS development console)
     *
     * @return array<string, mixed>|null
     */
    public function getAttributes(): ?iterable
    {
        return $this->attributes;
    }
    /**
     * Attribute information (Get information set by defining user attributes in the SaaS development console)
     *
     * @param array<string, mixed>|null $attributes
     *
     * @return self
     */
    public function setAttributes(?iterable $attributes): self
    {
        $this->initialized['attributes'] = true;
        $this->attributes = $attributes;
        return $this;
    }
}
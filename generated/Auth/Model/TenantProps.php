<?php

namespace AntiPatternInc\Saasus\Sdk\Auth\Model;

class TenantProps extends \ArrayObject
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
     * tenant name
     *
     * @var string|null
     */
    protected $name;
    /**
     * attribute info
     *
     * @var array<string, mixed>|null
     */
    protected $attributes;
    /**
     * administrative staff email address
     *
     * @var string|null
     */
    protected $backOfficeStaffEmail;
    /**
     * tenant name
     *
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }
    /**
     * tenant name
     *
     * @param string|null $name
     *
     * @return self
     */
    public function setName(?string $name): self
    {
        $this->initialized['name'] = true;
        $this->name = $name;
        return $this;
    }
    /**
     * attribute info
     *
     * @return array<string, mixed>|null
     */
    public function getAttributes(): ?iterable
    {
        return $this->attributes;
    }
    /**
     * attribute info
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
    /**
     * administrative staff email address
     *
     * @return string|null
     */
    public function getBackOfficeStaffEmail(): ?string
    {
        return $this->backOfficeStaffEmail;
    }
    /**
     * administrative staff email address
     *
     * @param string|null $backOfficeStaffEmail
     *
     * @return self
     */
    public function setBackOfficeStaffEmail(?string $backOfficeStaffEmail): self
    {
        $this->initialized['backOfficeStaffEmail'] = true;
        $this->backOfficeStaffEmail = $backOfficeStaffEmail;
        return $this;
    }
}
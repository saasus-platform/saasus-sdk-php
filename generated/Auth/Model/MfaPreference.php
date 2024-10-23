<?php

namespace AntiPatternInc\Saasus\Sdk\Auth\Model;

class MfaPreference extends \ArrayObject
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
     * enable MFA
     *
     * @var bool|null
     */
    protected $enabled;
    /**
     * MFA method (required if enabled is true)
     *
     * @var string|null
     */
    protected $method;
    /**
     * enable MFA
     *
     * @return bool|null
     */
    public function getEnabled(): ?bool
    {
        return $this->enabled;
    }
    /**
     * enable MFA
     *
     * @param bool|null $enabled
     *
     * @return self
     */
    public function setEnabled(?bool $enabled): self
    {
        $this->initialized['enabled'] = true;
        $this->enabled = $enabled;
        return $this;
    }
    /**
     * MFA method (required if enabled is true)
     *
     * @return string|null
     */
    public function getMethod(): ?string
    {
        return $this->method;
    }
    /**
     * MFA method (required if enabled is true)
     *
     * @param string|null $method
     *
     * @return self
     */
    public function setMethod(?string $method): self
    {
        $this->initialized['method'] = true;
        $this->method = $method;
        return $this;
    }
}
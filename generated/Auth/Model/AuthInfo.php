<?php

namespace AntiPatternInc\Saasus\Sdk\Auth\Model;

class AuthInfo extends \ArrayObject
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
     * Redirect After Authentication
     *
     * @var string|null
     */
    protected $callbackUrl;
    /**
     * Redirect After Authentication
     *
     * @return string|null
     */
    public function getCallbackUrl(): ?string
    {
        return $this->callbackUrl;
    }
    /**
     * Redirect After Authentication
     *
     * @param string|null $callbackUrl
     *
     * @return self
     */
    public function setCallbackUrl(?string $callbackUrl): self
    {
        $this->initialized['callbackUrl'] = true;
        $this->callbackUrl = $callbackUrl;
        return $this;
    }
}
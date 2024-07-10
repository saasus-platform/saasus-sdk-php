<?php

namespace AntiPatternInc\Saasus\Sdk\Billing\Model;

class StripeInfo extends \ArrayObject
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
     * @var bool|null
     */
    protected $isRegistered;
    /**
     * 
     *
     * @return bool|null
     */
    public function getIsRegistered(): ?bool
    {
        return $this->isRegistered;
    }
    /**
     * 
     *
     * @param bool|null $isRegistered
     *
     * @return self
     */
    public function setIsRegistered(?bool $isRegistered): self
    {
        $this->initialized['isRegistered'] = true;
        $this->isRegistered = $isRegistered;
        return $this;
    }
}
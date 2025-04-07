<?php

namespace AntiPatternInc\Saasus\Sdk\Billing\Model;

class UpdateStripeInfoParam extends \ArrayObject
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
     * secret key
     *
     * @var string|null
     */
    protected $secretKey;
    /**
     * secret key
     *
     * @return string|null
     */
    public function getSecretKey(): ?string
    {
        return $this->secretKey;
    }
    /**
     * secret key
     *
     * @param string|null $secretKey
     *
     * @return self
     */
    public function setSecretKey(?string $secretKey): self
    {
        $this->initialized['secretKey'] = true;
        $this->secretKey = $secretKey;
        return $this;
    }
}
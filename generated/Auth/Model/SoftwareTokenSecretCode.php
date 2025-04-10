<?php

namespace AntiPatternInc\Saasus\Sdk\Auth\Model;

class SoftwareTokenSecretCode extends \ArrayObject
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
     * secret code
     *
     * @var string|null
     */
    protected $secretCode;
    /**
     * secret code
     *
     * @return string|null
     */
    public function getSecretCode(): ?string
    {
        return $this->secretCode;
    }
    /**
     * secret code
     *
     * @param string|null $secretCode
     *
     * @return self
     */
    public function setSecretCode(?string $secretCode): self
    {
        $this->initialized['secretCode'] = true;
        $this->secretCode = $secretCode;
        return $this;
    }
}
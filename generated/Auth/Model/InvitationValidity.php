<?php

namespace AntiPatternInc\Saasus\Sdk\Auth\Model;

class InvitationValidity extends \ArrayObject
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
     * Whether the validation is valid or not
     *
     * @var bool|null
     */
    protected $isValid;
    /**
     * Whether the validation is valid or not
     *
     * @return bool|null
     */
    public function getIsValid(): ?bool
    {
        return $this->isValid;
    }
    /**
     * Whether the validation is valid or not
     *
     * @param bool|null $isValid
     *
     * @return self
     */
    public function setIsValid(?bool $isValid): self
    {
        $this->initialized['isValid'] = true;
        $this->isValid = $isValid;
        return $this;
    }
}
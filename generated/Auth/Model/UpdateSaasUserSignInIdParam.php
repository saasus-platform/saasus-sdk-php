<?php

namespace AntiPatternInc\Saasus\Sdk\Auth\Model;

class UpdateSaasUserSignInIdParam extends \ArrayObject
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
     * Sign-in ID
     *
     * @var string|null
     */
    protected $signInId;
    /**
     * Sign-in ID
     *
     * @return string|null
     */
    public function getSignInId() : ?string
    {
        return $this->signInId;
    }
    /**
     * Sign-in ID
     *
     * @param string|null $signInId
     *
     * @return self
     */
    public function setSignInId(?string $signInId) : self
    {
        $this->initialized['signInId'] = true;
        $this->signInId = $signInId;
        return $this;
    }
}
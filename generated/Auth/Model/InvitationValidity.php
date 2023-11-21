<?php

namespace AntiPatternInc\Saasus\Sdk\Auth\Model;

class InvitationValidity extends \ArrayObject
{
    /**
     * @var array
     */
    protected $initialized = array();
    public function isInitialized($property) : bool
    {
        return array_key_exists($property, $this->initialized);
    }
    /**
     * 招待が有効か否か(Whether the validation is valid or not)
     *
     * @var bool
     */
    protected $isValid;
    /**
     * 招待が有効か否か(Whether the validation is valid or not)
     *
     * @return bool
     */
    public function getIsValid() : bool
    {
        return $this->isValid;
    }
    /**
     * 招待が有効か否か(Whether the validation is valid or not)
     *
     * @param bool $isValid
     *
     * @return self
     */
    public function setIsValid(bool $isValid) : self
    {
        $this->initialized['isValid'] = true;
        $this->isValid = $isValid;
        return $this;
    }
}
<?php

namespace AntiPatternInc\Saasus\Sdk\Auth\Model;

class UserAttributes extends \ArrayObject
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
     * User Attribute Definition
     *
     * @var list<Attribute>|null
     */
    protected $userAttributes;
    /**
     * User Attribute Definition
     *
     * @return list<Attribute>|null
     */
    public function getUserAttributes(): ?array
    {
        return $this->userAttributes;
    }
    /**
     * User Attribute Definition
     *
     * @param list<Attribute>|null $userAttributes
     *
     * @return self
     */
    public function setUserAttributes(?array $userAttributes): self
    {
        $this->initialized['userAttributes'] = true;
        $this->userAttributes = $userAttributes;
        return $this;
    }
}
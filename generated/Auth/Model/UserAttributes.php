<?php

namespace AntiPatternInc\Saasus\Sdk\Auth\Model;

class UserAttributes extends \ArrayObject
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
     * ユーザー属性定義(User attribute definition)
     *
     * @var Attribute[]|null
     */
    protected $userAttributes;
    /**
     * ユーザー属性定義(User attribute definition)
     *
     * @return Attribute[]|null
     */
    public function getUserAttributes() : ?array
    {
        return $this->userAttributes;
    }
    /**
     * ユーザー属性定義(User attribute definition)
     *
     * @param Attribute[]|null $userAttributes
     *
     * @return self
     */
    public function setUserAttributes(?array $userAttributes) : self
    {
        $this->initialized['userAttributes'] = true;
        $this->userAttributes = $userAttributes;
        return $this;
    }
}
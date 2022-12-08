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
     * ユーザー属性定義
     *
     * @var Attribute[]
     */
    protected $userAttributes;
    /**
     * ユーザー属性定義
     *
     * @return Attribute[]
     */
    public function getUserAttributes() : array
    {
        return $this->userAttributes;
    }
    /**
     * ユーザー属性定義
     *
     * @param Attribute[] $userAttributes
     *
     * @return self
     */
    public function setUserAttributes(array $userAttributes) : self
    {
        $this->initialized['userAttributes'] = true;
        $this->userAttributes = $userAttributes;
        return $this;
    }
}
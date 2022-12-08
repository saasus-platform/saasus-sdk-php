<?php

namespace AntiPatternInc\Saasus\Sdk\Auth\Model;

class Attribute extends \ArrayObject
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
     * 属性名
     *
     * @var string
     */
    protected $attributeName;
    /**
     * 表示名
     *
     * @var string
     */
    protected $displayName;
    /**
     * 型（dateはYYYY-MM-DDの形式で使用する事ができます。）
     *
     * @var string
     */
    protected $attributeType;
    /**
     * 属性名
     *
     * @return string
     */
    public function getAttributeName() : string
    {
        return $this->attributeName;
    }
    /**
     * 属性名
     *
     * @param string $attributeName
     *
     * @return self
     */
    public function setAttributeName(string $attributeName) : self
    {
        $this->initialized['attributeName'] = true;
        $this->attributeName = $attributeName;
        return $this;
    }
    /**
     * 表示名
     *
     * @return string
     */
    public function getDisplayName() : string
    {
        return $this->displayName;
    }
    /**
     * 表示名
     *
     * @param string $displayName
     *
     * @return self
     */
    public function setDisplayName(string $displayName) : self
    {
        $this->initialized['displayName'] = true;
        $this->displayName = $displayName;
        return $this;
    }
    /**
     * 型（dateはYYYY-MM-DDの形式で使用する事ができます。）
     *
     * @return string
     */
    public function getAttributeType() : string
    {
        return $this->attributeType;
    }
    /**
     * 型（dateはYYYY-MM-DDの形式で使用する事ができます。）
     *
     * @param string $attributeType
     *
     * @return self
     */
    public function setAttributeType(string $attributeType) : self
    {
        $this->initialized['attributeType'] = true;
        $this->attributeType = $attributeType;
        return $this;
    }
}
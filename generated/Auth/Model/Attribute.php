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
     * 属性名(attribute name)
     *
     * @var string|null
     */
    protected $attributeName;
    /**
     * 表示名(display name)
     *
     * @var string|null
     */
    protected $displayName;
    /**
    * 型（dateはYYYY-MM-DDの形式で使用する事ができます。）
    (Type (date can be set to YYYY-MM-DD format.))
    
    *
    * @var string|null
    */
    protected $attributeType;
    /**
     * 属性名(attribute name)
     *
     * @return string|null
     */
    public function getAttributeName() : ?string
    {
        return $this->attributeName;
    }
    /**
     * 属性名(attribute name)
     *
     * @param string|null $attributeName
     *
     * @return self
     */
    public function setAttributeName(?string $attributeName) : self
    {
        $this->initialized['attributeName'] = true;
        $this->attributeName = $attributeName;
        return $this;
    }
    /**
     * 表示名(display name)
     *
     * @return string|null
     */
    public function getDisplayName() : ?string
    {
        return $this->displayName;
    }
    /**
     * 表示名(display name)
     *
     * @param string|null $displayName
     *
     * @return self
     */
    public function setDisplayName(?string $displayName) : self
    {
        $this->initialized['displayName'] = true;
        $this->displayName = $displayName;
        return $this;
    }
    /**
    * 型（dateはYYYY-MM-DDの形式で使用する事ができます。）
    (Type (date can be set to YYYY-MM-DD format.))
    
    *
    * @return string|null
    */
    public function getAttributeType() : ?string
    {
        return $this->attributeType;
    }
    /**
    * 型（dateはYYYY-MM-DDの形式で使用する事ができます。）
    (Type (date can be set to YYYY-MM-DD format.))
    
    *
    * @param string|null $attributeType
    *
    * @return self
    */
    public function setAttributeType(?string $attributeType) : self
    {
        $this->initialized['attributeType'] = true;
        $this->attributeType = $attributeType;
        return $this;
    }
}
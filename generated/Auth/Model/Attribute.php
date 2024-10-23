<?php

namespace AntiPatternInc\Saasus\Sdk\Auth\Model;

class Attribute extends \ArrayObject
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
     * Attribute Name
     *
     * @var string|null
     */
    protected $attributeName;
    /**
     * Display Name
     *
     * @var string|null
     */
    protected $displayName;
    /**
     * Type (date can be set to YYYY-MM-DD format.)
     *
     * @var string|null
     */
    protected $attributeType;
    /**
     * Attribute Name
     *
     * @return string|null
     */
    public function getAttributeName(): ?string
    {
        return $this->attributeName;
    }
    /**
     * Attribute Name
     *
     * @param string|null $attributeName
     *
     * @return self
     */
    public function setAttributeName(?string $attributeName): self
    {
        $this->initialized['attributeName'] = true;
        $this->attributeName = $attributeName;
        return $this;
    }
    /**
     * Display Name
     *
     * @return string|null
     */
    public function getDisplayName(): ?string
    {
        return $this->displayName;
    }
    /**
     * Display Name
     *
     * @param string|null $displayName
     *
     * @return self
     */
    public function setDisplayName(?string $displayName): self
    {
        $this->initialized['displayName'] = true;
        $this->displayName = $displayName;
        return $this;
    }
    /**
     * Type (date can be set to YYYY-MM-DD format.)
     *
     * @return string|null
     */
    public function getAttributeType(): ?string
    {
        return $this->attributeType;
    }
    /**
     * Type (date can be set to YYYY-MM-DD format.)
     *
     * @param string|null $attributeType
     *
     * @return self
     */
    public function setAttributeType(?string $attributeType): self
    {
        $this->initialized['attributeType'] = true;
        $this->attributeType = $attributeType;
        return $this;
    }
}
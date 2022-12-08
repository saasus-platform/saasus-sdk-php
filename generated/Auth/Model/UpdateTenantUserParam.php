<?php

namespace AntiPatternInc\Saasus\Sdk\Auth\Model;

class UpdateTenantUserParam extends \ArrayObject
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
     * 属性情報（SaaSus コンソールでテナント属性定義を行い設定した情報）
     *
     * @var mixed[]
     */
    protected $attributes;
    /**
     * 属性情報（SaaSus コンソールでテナント属性定義を行い設定した情報）
     *
     * @return mixed[]
     */
    public function getAttributes() : iterable
    {
        return $this->attributes;
    }
    /**
     * 属性情報（SaaSus コンソールでテナント属性定義を行い設定した情報）
     *
     * @param mixed[] $attributes
     *
     * @return self
     */
    public function setAttributes(iterable $attributes) : self
    {
        $this->initialized['attributes'] = true;
        $this->attributes = $attributes;
        return $this;
    }
}
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
    * 属性情報（SaaS 開発コンソールでユーザー属性定義を行い設定された情報を取得します）
    
    Attribute information (Get information set by defining user attributes in the SaaS development console)
    
    *
    * @var mixed[]|null
    */
    protected $attributes;
    /**
    * 属性情報（SaaS 開発コンソールでユーザー属性定義を行い設定された情報を取得します）
    
    Attribute information (Get information set by defining user attributes in the SaaS development console)
    
    *
    * @return mixed[]|null
    */
    public function getAttributes() : ?iterable
    {
        return $this->attributes;
    }
    /**
    * 属性情報（SaaS 開発コンソールでユーザー属性定義を行い設定された情報を取得します）
    
    Attribute information (Get information set by defining user attributes in the SaaS development console)
    
    *
    * @param mixed[]|null $attributes
    *
    * @return self
    */
    public function setAttributes(?iterable $attributes) : self
    {
        $this->initialized['attributes'] = true;
        $this->attributes = $attributes;
        return $this;
    }
}
<?php

namespace AntiPatternInc\Saasus\Sdk\Auth\Model;

class User extends \ArrayObject
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
     * ユーザーID(User ID)
     *
     * @var string|null
     */
    protected $id;
    /**
     * 
     *
     * @var string|null
     */
    protected $tenantId;
    /**
     * テナント名(Tenant Name)
     *
     * @var string|null
     */
    protected $tenantName;
    /**
     * メールアドレス(E-mail)
     *
     * @var string|null
     */
    protected $email;
    /**
    * 属性情報（SaaS 開発コンソールでユーザー属性定義を行い設定された情報を取得します）
    
    Attribute information (Get information set by defining user attributes in the SaaS development console)
    
    *
    * @var array<string, mixed>|null
    */
    protected $attributes;
    /**
     * 
     *
     * @var object[]|null
     */
    protected $envs;
    /**
     * ユーザーID(User ID)
     *
     * @return string|null
     */
    public function getId() : ?string
    {
        return $this->id;
    }
    /**
     * ユーザーID(User ID)
     *
     * @param string|null $id
     *
     * @return self
     */
    public function setId(?string $id) : self
    {
        $this->initialized['id'] = true;
        $this->id = $id;
        return $this;
    }
    /**
     * 
     *
     * @return string|null
     */
    public function getTenantId() : ?string
    {
        return $this->tenantId;
    }
    /**
     * 
     *
     * @param string|null $tenantId
     *
     * @return self
     */
    public function setTenantId(?string $tenantId) : self
    {
        $this->initialized['tenantId'] = true;
        $this->tenantId = $tenantId;
        return $this;
    }
    /**
     * テナント名(Tenant Name)
     *
     * @return string|null
     */
    public function getTenantName() : ?string
    {
        return $this->tenantName;
    }
    /**
     * テナント名(Tenant Name)
     *
     * @param string|null $tenantName
     *
     * @return self
     */
    public function setTenantName(?string $tenantName) : self
    {
        $this->initialized['tenantName'] = true;
        $this->tenantName = $tenantName;
        return $this;
    }
    /**
     * メールアドレス(E-mail)
     *
     * @return string|null
     */
    public function getEmail() : ?string
    {
        return $this->email;
    }
    /**
     * メールアドレス(E-mail)
     *
     * @param string|null $email
     *
     * @return self
     */
    public function setEmail(?string $email) : self
    {
        $this->initialized['email'] = true;
        $this->email = $email;
        return $this;
    }
    /**
    * 属性情報（SaaS 開発コンソールでユーザー属性定義を行い設定された情報を取得します）
    
    Attribute information (Get information set by defining user attributes in the SaaS development console)
    
    *
    * @return array<string, mixed>|null
    */
    public function getAttributes() : ?iterable
    {
        return $this->attributes;
    }
    /**
    * 属性情報（SaaS 開発コンソールでユーザー属性定義を行い設定された情報を取得します）
    
    Attribute information (Get information set by defining user attributes in the SaaS development console)
    
    *
    * @param array<string, mixed>|null $attributes
    *
    * @return self
    */
    public function setAttributes(?iterable $attributes) : self
    {
        $this->initialized['attributes'] = true;
        $this->attributes = $attributes;
        return $this;
    }
    /**
     * 
     *
     * @return object[]|null
     */
    public function getEnvs() : ?array
    {
        return $this->envs;
    }
    /**
     * 
     *
     * @param object[]|null $envs
     *
     * @return self
     */
    public function setEnvs(?array $envs) : self
    {
        $this->initialized['envs'] = true;
        $this->envs = $envs;
        return $this;
    }
}
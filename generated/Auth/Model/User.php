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
     * ユーザーID
     *
     * @var string
     */
    protected $id;
    /**
     * 
     *
     * @var string
     */
    protected $tenantId;
    /**
     * テナント名
     *
     * @var string
     */
    protected $tenantName;
    /**
     * メールアドレス
     *
     * @var string
     */
    protected $email;
    /**
     * 属性情報（SaaSus コンソールでテナント属性定義を行い設定された情報を取得します）
     *
     * @var mixed[]
     */
    protected $attributes;
    /**
     * 
     *
     * @var object[]
     */
    protected $envs;
    /**
     * ユーザーID
     *
     * @return string
     */
    public function getId() : string
    {
        return $this->id;
    }
    /**
     * ユーザーID
     *
     * @param string $id
     *
     * @return self
     */
    public function setId(string $id) : self
    {
        $this->initialized['id'] = true;
        $this->id = $id;
        return $this;
    }
    /**
     * 
     *
     * @return string
     */
    public function getTenantId() : string
    {
        return $this->tenantId;
    }
    /**
     * 
     *
     * @param string $tenantId
     *
     * @return self
     */
    public function setTenantId(string $tenantId) : self
    {
        $this->initialized['tenantId'] = true;
        $this->tenantId = $tenantId;
        return $this;
    }
    /**
     * テナント名
     *
     * @return string
     */
    public function getTenantName() : string
    {
        return $this->tenantName;
    }
    /**
     * テナント名
     *
     * @param string $tenantName
     *
     * @return self
     */
    public function setTenantName(string $tenantName) : self
    {
        $this->initialized['tenantName'] = true;
        $this->tenantName = $tenantName;
        return $this;
    }
    /**
     * メールアドレス
     *
     * @return string
     */
    public function getEmail() : string
    {
        return $this->email;
    }
    /**
     * メールアドレス
     *
     * @param string $email
     *
     * @return self
     */
    public function setEmail(string $email) : self
    {
        $this->initialized['email'] = true;
        $this->email = $email;
        return $this;
    }
    /**
     * 属性情報（SaaSus コンソールでテナント属性定義を行い設定された情報を取得します）
     *
     * @return mixed[]
     */
    public function getAttributes() : iterable
    {
        return $this->attributes;
    }
    /**
     * 属性情報（SaaSus コンソールでテナント属性定義を行い設定された情報を取得します）
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
    /**
     * 
     *
     * @return object[]
     */
    public function getEnvs() : array
    {
        return $this->envs;
    }
    /**
     * 
     *
     * @param object[] $envs
     *
     * @return self
     */
    public function setEnvs(array $envs) : self
    {
        $this->initialized['envs'] = true;
        $this->envs = $envs;
        return $this;
    }
}
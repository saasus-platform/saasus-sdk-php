<?php

namespace AntiPatternInc\Saasus\Sdk\Auth\Model;

class TenantProps extends \ArrayObject
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
     * テナント名(tenant name)
     *
     * @var string
     */
    protected $name;
    /**
     * 属性情報(attribute info)
     *
     * @var mixed[]
     */
    protected $attributes;
    /**
     * 事務管理部門スタッフメールアドレス(administrative staff email address)
     *
     * @var string
     */
    protected $backOfficeStaffEmail;
    /**
     * テナント名(tenant name)
     *
     * @return string
     */
    public function getName() : string
    {
        return $this->name;
    }
    /**
     * テナント名(tenant name)
     *
     * @param string $name
     *
     * @return self
     */
    public function setName(string $name) : self
    {
        $this->initialized['name'] = true;
        $this->name = $name;
        return $this;
    }
    /**
     * 属性情報(attribute info)
     *
     * @return mixed[]
     */
    public function getAttributes() : iterable
    {
        return $this->attributes;
    }
    /**
     * 属性情報(attribute info)
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
     * 事務管理部門スタッフメールアドレス(administrative staff email address)
     *
     * @return string
     */
    public function getBackOfficeStaffEmail() : string
    {
        return $this->backOfficeStaffEmail;
    }
    /**
     * 事務管理部門スタッフメールアドレス(administrative staff email address)
     *
     * @param string $backOfficeStaffEmail
     *
     * @return self
     */
    public function setBackOfficeStaffEmail(string $backOfficeStaffEmail) : self
    {
        $this->initialized['backOfficeStaffEmail'] = true;
        $this->backOfficeStaffEmail = $backOfficeStaffEmail;
        return $this;
    }
}
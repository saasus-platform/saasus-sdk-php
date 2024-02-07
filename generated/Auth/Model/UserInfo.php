<?php

namespace AntiPatternInc\Saasus\Sdk\Auth\Model;

class UserInfo extends \ArrayObject
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
     * 
     *
     * @var string|null
     */
    protected $id;
    /**
     * メールアドレス(E-mail)
     *
     * @var string|null
     */
    protected $email;
    /**
     * テナント情報(Tenant Info)
     *
     * @var UserAvailableTenant[]|null
     */
    protected $tenants;
    /**
     * 
     *
     * @return string|null
     */
    public function getId() : ?string
    {
        return $this->id;
    }
    /**
     * 
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
     * テナント情報(Tenant Info)
     *
     * @return UserAvailableTenant[]|null
     */
    public function getTenants() : ?array
    {
        return $this->tenants;
    }
    /**
     * テナント情報(Tenant Info)
     *
     * @param UserAvailableTenant[]|null $tenants
     *
     * @return self
     */
    public function setTenants(?array $tenants) : self
    {
        $this->initialized['tenants'] = true;
        $this->tenants = $tenants;
        return $this;
    }
}
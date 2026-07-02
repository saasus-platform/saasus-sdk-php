<?php

namespace AntiPatternInc\Saasus\Sdk\Auth\Model;

class UserInfo extends \ArrayObject
{
    /**
     * @var array
     */
    protected $initialized = [];
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
    * E-mail.
    For sign-in ID authentication users, this field is an empty string.
    
    *
    * @var string|null
    */
    protected $email;
    /**
    * Sign-in ID.
    For email authentication users, this field is an empty string.
    
    *
    * @var string|null
    */
    protected $signInId;
    /**
     * user additional attributes
     *
     * @var array<string, mixed>|null
     */
    protected $userAttribute;
    /**
     * Tenant Info
     *
     * @var list<UserAvailableTenant>|null
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
    * E-mail.
    For sign-in ID authentication users, this field is an empty string.
    
    *
    * @return string|null
    */
    public function getEmail() : ?string
    {
        return $this->email;
    }
    /**
    * E-mail.
    For sign-in ID authentication users, this field is an empty string.
    
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
    * Sign-in ID.
    For email authentication users, this field is an empty string.
    
    *
    * @return string|null
    */
    public function getSignInId() : ?string
    {
        return $this->signInId;
    }
    /**
    * Sign-in ID.
    For email authentication users, this field is an empty string.
    
    *
    * @param string|null $signInId
    *
    * @return self
    */
    public function setSignInId(?string $signInId) : self
    {
        $this->initialized['signInId'] = true;
        $this->signInId = $signInId;
        return $this;
    }
    /**
     * user additional attributes
     *
     * @return array<string, mixed>|null
     */
    public function getUserAttribute() : ?iterable
    {
        return $this->userAttribute;
    }
    /**
     * user additional attributes
     *
     * @param array<string, mixed>|null $userAttribute
     *
     * @return self
     */
    public function setUserAttribute(?iterable $userAttribute) : self
    {
        $this->initialized['userAttribute'] = true;
        $this->userAttribute = $userAttribute;
        return $this;
    }
    /**
     * Tenant Info
     *
     * @return list<UserAvailableTenant>|null
     */
    public function getTenants() : ?array
    {
        return $this->tenants;
    }
    /**
     * Tenant Info
     *
     * @param list<UserAvailableTenant>|null $tenants
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
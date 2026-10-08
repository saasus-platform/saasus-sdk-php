<?php

namespace AntiPatternInc\Saasus\Sdk\Auth\Model;

class SaasUser extends \ArrayObject
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
     * Attribute information
     *
     * @var array<string, mixed>|null
     */
    protected $attributes;
    /**
    * Last login date and time (unix timestamp).
    Null if the user has never logged in.
    
    *
    * @var int|null
    */
    protected $lastLoginAt;
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
     * Attribute information
     *
     * @return array<string, mixed>|null
     */
    public function getAttributes() : ?iterable
    {
        return $this->attributes;
    }
    /**
     * Attribute information
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
    * Last login date and time (unix timestamp).
    Null if the user has never logged in.
    
    *
    * @return int|null
    */
    public function getLastLoginAt() : ?int
    {
        return $this->lastLoginAt;
    }
    /**
    * Last login date and time (unix timestamp).
    Null if the user has never logged in.
    
    *
    * @param int|null $lastLoginAt
    *
    * @return self
    */
    public function setLastLoginAt(?int $lastLoginAt) : self
    {
        $this->initialized['lastLoginAt'] = true;
        $this->lastLoginAt = $lastLoginAt;
        return $this;
    }
}
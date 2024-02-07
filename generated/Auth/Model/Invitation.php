<?php

namespace AntiPatternInc\Saasus\Sdk\Auth\Model;

class Invitation extends \ArrayObject
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
     * 招待されたユーザーのメールアドレス(email address of the invited user)
     *
     * @var string|null
     */
    protected $email;
    /**
     * 招待URL(invitation URL)
     *
     * @var string|null
     */
    protected $invitationUrl;
    /**
     * 
     *
     * @var object[]|null
     */
    protected $envs;
    /**
     * 招待の有効期限(expiration date of the invitation)
     *
     * @var int|null
     */
    protected $expiredAt;
    /**
     * 
     *
     * @var string|null
     */
    protected $status;
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
     * 招待されたユーザーのメールアドレス(email address of the invited user)
     *
     * @return string|null
     */
    public function getEmail() : ?string
    {
        return $this->email;
    }
    /**
     * 招待されたユーザーのメールアドレス(email address of the invited user)
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
     * 招待URL(invitation URL)
     *
     * @return string|null
     */
    public function getInvitationUrl() : ?string
    {
        return $this->invitationUrl;
    }
    /**
     * 招待URL(invitation URL)
     *
     * @param string|null $invitationUrl
     *
     * @return self
     */
    public function setInvitationUrl(?string $invitationUrl) : self
    {
        $this->initialized['invitationUrl'] = true;
        $this->invitationUrl = $invitationUrl;
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
    /**
     * 招待の有効期限(expiration date of the invitation)
     *
     * @return int|null
     */
    public function getExpiredAt() : ?int
    {
        return $this->expiredAt;
    }
    /**
     * 招待の有効期限(expiration date of the invitation)
     *
     * @param int|null $expiredAt
     *
     * @return self
     */
    public function setExpiredAt(?int $expiredAt) : self
    {
        $this->initialized['expiredAt'] = true;
        $this->expiredAt = $expiredAt;
        return $this;
    }
    /**
     * 
     *
     * @return string|null
     */
    public function getStatus() : ?string
    {
        return $this->status;
    }
    /**
     * 
     *
     * @param string|null $status
     *
     * @return self
     */
    public function setStatus(?string $status) : self
    {
        $this->initialized['status'] = true;
        $this->status = $status;
        return $this;
    }
}
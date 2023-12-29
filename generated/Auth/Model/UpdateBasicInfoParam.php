<?php

namespace AntiPatternInc\Saasus\Sdk\Auth\Model;

class UpdateBasicInfoParam extends \ArrayObject
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
     * ドメイン名(Domain Name)
     *
     * @var string|null
     */
    protected $domainName;
    /**
     * 認証メールの送信元メールアドレス(Sender email of authentication email)
     *
     * @var string|null
     */
    protected $fromEmailAddress;
    /**
     * 認証メールの返信元メールアドレス(Reply-from email address of authentication email)
     *
     * @var string|null
     */
    protected $replyEmailAddress;
    /**
     * ドメイン名(Domain Name)
     *
     * @return string|null
     */
    public function getDomainName() : ?string
    {
        return $this->domainName;
    }
    /**
     * ドメイン名(Domain Name)
     *
     * @param string|null $domainName
     *
     * @return self
     */
    public function setDomainName(?string $domainName) : self
    {
        $this->initialized['domainName'] = true;
        $this->domainName = $domainName;
        return $this;
    }
    /**
     * 認証メールの送信元メールアドレス(Sender email of authentication email)
     *
     * @return string|null
     */
    public function getFromEmailAddress() : ?string
    {
        return $this->fromEmailAddress;
    }
    /**
     * 認証メールの送信元メールアドレス(Sender email of authentication email)
     *
     * @param string|null $fromEmailAddress
     *
     * @return self
     */
    public function setFromEmailAddress(?string $fromEmailAddress) : self
    {
        $this->initialized['fromEmailAddress'] = true;
        $this->fromEmailAddress = $fromEmailAddress;
        return $this;
    }
    /**
     * 認証メールの返信元メールアドレス(Reply-from email address of authentication email)
     *
     * @return string|null
     */
    public function getReplyEmailAddress() : ?string
    {
        return $this->replyEmailAddress;
    }
    /**
     * 認証メールの返信元メールアドレス(Reply-from email address of authentication email)
     *
     * @param string|null $replyEmailAddress
     *
     * @return self
     */
    public function setReplyEmailAddress(?string $replyEmailAddress) : self
    {
        $this->initialized['replyEmailAddress'] = true;
        $this->replyEmailAddress = $replyEmailAddress;
        return $this;
    }
}
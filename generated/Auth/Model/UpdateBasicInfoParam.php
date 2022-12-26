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
     * ドメイン名(Domain name)
     *
     * @var string
     */
    protected $domainName;
    /**
     * 認証メールの送信元メールアドレス(Sender email address of authentication email)
     *
     * @var string
     */
    protected $fromEmailAddress;
    /**
     * ドメイン名(Domain name)
     *
     * @return string
     */
    public function getDomainName() : string
    {
        return $this->domainName;
    }
    /**
     * ドメイン名(Domain name)
     *
     * @param string $domainName
     *
     * @return self
     */
    public function setDomainName(string $domainName) : self
    {
        $this->initialized['domainName'] = true;
        $this->domainName = $domainName;
        return $this;
    }
    /**
     * 認証メールの送信元メールアドレス(Sender email address of authentication email)
     *
     * @return string
     */
    public function getFromEmailAddress() : string
    {
        return $this->fromEmailAddress;
    }
    /**
     * 認証メールの送信元メールアドレス(Sender email address of authentication email)
     *
     * @param string $fromEmailAddress
     *
     * @return self
     */
    public function setFromEmailAddress(string $fromEmailAddress) : self
    {
        $this->initialized['fromEmailAddress'] = true;
        $this->fromEmailAddress = $fromEmailAddress;
        return $this;
    }
}
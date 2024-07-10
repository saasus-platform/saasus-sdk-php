<?php

namespace AntiPatternInc\Saasus\Sdk\Auth\Model;

class UpdateBasicInfoParam extends \ArrayObject
{
    /**
     * @var array
     */
    protected $initialized = [];
    public function isInitialized($property): bool
    {
        return array_key_exists($property, $this->initialized);
    }
    /**
     * Domain Name
     *
     * @var string|null
     */
    protected $domainName;
    /**
     * Sender email of authentication email
     *
     * @var string|null
     */
    protected $fromEmailAddress;
    /**
     * Reply-from email address of authentication email
     *
     * @var string|null
     */
    protected $replyEmailAddress;
    /**
     * Domain Name
     *
     * @return string|null
     */
    public function getDomainName(): ?string
    {
        return $this->domainName;
    }
    /**
     * Domain Name
     *
     * @param string|null $domainName
     *
     * @return self
     */
    public function setDomainName(?string $domainName): self
    {
        $this->initialized['domainName'] = true;
        $this->domainName = $domainName;
        return $this;
    }
    /**
     * Sender email of authentication email
     *
     * @return string|null
     */
    public function getFromEmailAddress(): ?string
    {
        return $this->fromEmailAddress;
    }
    /**
     * Sender email of authentication email
     *
     * @param string|null $fromEmailAddress
     *
     * @return self
     */
    public function setFromEmailAddress(?string $fromEmailAddress): self
    {
        $this->initialized['fromEmailAddress'] = true;
        $this->fromEmailAddress = $fromEmailAddress;
        return $this;
    }
    /**
     * Reply-from email address of authentication email
     *
     * @return string|null
     */
    public function getReplyEmailAddress(): ?string
    {
        return $this->replyEmailAddress;
    }
    /**
     * Reply-from email address of authentication email
     *
     * @param string|null $replyEmailAddress
     *
     * @return self
     */
    public function setReplyEmailAddress(?string $replyEmailAddress): self
    {
        $this->initialized['replyEmailAddress'] = true;
        $this->replyEmailAddress = $replyEmailAddress;
        return $this;
    }
}
<?php

namespace AntiPatternInc\Saasus\Sdk\Auth\Model;

class IdentityProviderConfiguration extends \ArrayObject
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
     * ドメイン(domain)
     *
     * @var string|null
     */
    protected $domain;
    /**
     * リダイレクトURL(redirect URL)
     *
     * @var string|null
     */
    protected $redirectUrl;
    /**
     * 識別子(entity ID)
     *
     * @var string|null
     */
    protected $entityId;
    /**
     * 応答URL(reply URL)
     *
     * @var string|null
     */
    protected $replyUrl;
    /**
     * ドメイン(domain)
     *
     * @return string|null
     */
    public function getDomain() : ?string
    {
        return $this->domain;
    }
    /**
     * ドメイン(domain)
     *
     * @param string|null $domain
     *
     * @return self
     */
    public function setDomain(?string $domain) : self
    {
        $this->initialized['domain'] = true;
        $this->domain = $domain;
        return $this;
    }
    /**
     * リダイレクトURL(redirect URL)
     *
     * @return string|null
     */
    public function getRedirectUrl() : ?string
    {
        return $this->redirectUrl;
    }
    /**
     * リダイレクトURL(redirect URL)
     *
     * @param string|null $redirectUrl
     *
     * @return self
     */
    public function setRedirectUrl(?string $redirectUrl) : self
    {
        $this->initialized['redirectUrl'] = true;
        $this->redirectUrl = $redirectUrl;
        return $this;
    }
    /**
     * 識別子(entity ID)
     *
     * @return string|null
     */
    public function getEntityId() : ?string
    {
        return $this->entityId;
    }
    /**
     * 識別子(entity ID)
     *
     * @param string|null $entityId
     *
     * @return self
     */
    public function setEntityId(?string $entityId) : self
    {
        $this->initialized['entityId'] = true;
        $this->entityId = $entityId;
        return $this;
    }
    /**
     * 応答URL(reply URL)
     *
     * @return string|null
     */
    public function getReplyUrl() : ?string
    {
        return $this->replyUrl;
    }
    /**
     * 応答URL(reply URL)
     *
     * @param string|null $replyUrl
     *
     * @return self
     */
    public function setReplyUrl(?string $replyUrl) : self
    {
        $this->initialized['replyUrl'] = true;
        $this->replyUrl = $replyUrl;
        return $this;
    }
}
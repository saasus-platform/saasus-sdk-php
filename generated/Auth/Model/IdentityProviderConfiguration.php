<?php

namespace AntiPatternInc\Saasus\Sdk\Auth\Model;

class IdentityProviderConfiguration extends \ArrayObject
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
     * domain
     *
     * @var string|null
     */
    protected $domain;
    /**
     * redirect URL
     *
     * @var string|null
     */
    protected $redirectUrl;
    /**
     * entity ID
     *
     * @var string|null
     */
    protected $entityId;
    /**
     * reply URL
     *
     * @var string|null
     */
    protected $replyUrl;
    /**
     * domain
     *
     * @return string|null
     */
    public function getDomain(): ?string
    {
        return $this->domain;
    }
    /**
     * domain
     *
     * @param string|null $domain
     *
     * @return self
     */
    public function setDomain(?string $domain): self
    {
        $this->initialized['domain'] = true;
        $this->domain = $domain;
        return $this;
    }
    /**
     * redirect URL
     *
     * @return string|null
     */
    public function getRedirectUrl(): ?string
    {
        return $this->redirectUrl;
    }
    /**
     * redirect URL
     *
     * @param string|null $redirectUrl
     *
     * @return self
     */
    public function setRedirectUrl(?string $redirectUrl): self
    {
        $this->initialized['redirectUrl'] = true;
        $this->redirectUrl = $redirectUrl;
        return $this;
    }
    /**
     * entity ID
     *
     * @return string|null
     */
    public function getEntityId(): ?string
    {
        return $this->entityId;
    }
    /**
     * entity ID
     *
     * @param string|null $entityId
     *
     * @return self
     */
    public function setEntityId(?string $entityId): self
    {
        $this->initialized['entityId'] = true;
        $this->entityId = $entityId;
        return $this;
    }
    /**
     * reply URL
     *
     * @return string|null
     */
    public function getReplyUrl(): ?string
    {
        return $this->replyUrl;
    }
    /**
     * reply URL
     *
     * @param string|null $replyUrl
     *
     * @return self
     */
    public function setReplyUrl(?string $replyUrl): self
    {
        $this->initialized['replyUrl'] = true;
        $this->replyUrl = $replyUrl;
        return $this;
    }
}
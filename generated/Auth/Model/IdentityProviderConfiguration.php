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
     * @var string
     */
    protected $domain;
    /**
     * リダイレクトURL(redirect URL)
     *
     * @var string
     */
    protected $redirectUrl;
    /**
     * ドメイン(domain)
     *
     * @return string
     */
    public function getDomain() : string
    {
        return $this->domain;
    }
    /**
     * ドメイン(domain)
     *
     * @param string $domain
     *
     * @return self
     */
    public function setDomain(string $domain) : self
    {
        $this->initialized['domain'] = true;
        $this->domain = $domain;
        return $this;
    }
    /**
     * リダイレクトURL(redirect URL)
     *
     * @return string
     */
    public function getRedirectUrl() : string
    {
        return $this->redirectUrl;
    }
    /**
     * リダイレクトURL(redirect URL)
     *
     * @param string $redirectUrl
     *
     * @return self
     */
    public function setRedirectUrl(string $redirectUrl) : self
    {
        $this->initialized['redirectUrl'] = true;
        $this->redirectUrl = $redirectUrl;
        return $this;
    }
}
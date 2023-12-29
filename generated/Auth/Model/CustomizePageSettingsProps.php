<?php

namespace AntiPatternInc\Saasus\Sdk\Auth\Model;

class CustomizePageSettingsProps extends \ArrayObject
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
     * サービス名(service name)
     *
     * @var string|null
     */
    protected $title;
    /**
     * 利用規約URL(terms of service URL)
     *
     * @var string|null
     */
    protected $termsOfServiceUrl;
    /**
     * プライバシーポリシーURL(privacy policy URL)
     *
     * @var string|null
     */
    protected $privacyPolicyUrl;
    /**
     * Google Tag Manager コンテナ ID(Google Tag Manager container ID)
     *
     * @var string|null
     */
    protected $googleTagManagerContainerId;
    /**
     * サービス名(service name)
     *
     * @return string|null
     */
    public function getTitle() : ?string
    {
        return $this->title;
    }
    /**
     * サービス名(service name)
     *
     * @param string|null $title
     *
     * @return self
     */
    public function setTitle(?string $title) : self
    {
        $this->initialized['title'] = true;
        $this->title = $title;
        return $this;
    }
    /**
     * 利用規約URL(terms of service URL)
     *
     * @return string|null
     */
    public function getTermsOfServiceUrl() : ?string
    {
        return $this->termsOfServiceUrl;
    }
    /**
     * 利用規約URL(terms of service URL)
     *
     * @param string|null $termsOfServiceUrl
     *
     * @return self
     */
    public function setTermsOfServiceUrl(?string $termsOfServiceUrl) : self
    {
        $this->initialized['termsOfServiceUrl'] = true;
        $this->termsOfServiceUrl = $termsOfServiceUrl;
        return $this;
    }
    /**
     * プライバシーポリシーURL(privacy policy URL)
     *
     * @return string|null
     */
    public function getPrivacyPolicyUrl() : ?string
    {
        return $this->privacyPolicyUrl;
    }
    /**
     * プライバシーポリシーURL(privacy policy URL)
     *
     * @param string|null $privacyPolicyUrl
     *
     * @return self
     */
    public function setPrivacyPolicyUrl(?string $privacyPolicyUrl) : self
    {
        $this->initialized['privacyPolicyUrl'] = true;
        $this->privacyPolicyUrl = $privacyPolicyUrl;
        return $this;
    }
    /**
     * Google Tag Manager コンテナ ID(Google Tag Manager container ID)
     *
     * @return string|null
     */
    public function getGoogleTagManagerContainerId() : ?string
    {
        return $this->googleTagManagerContainerId;
    }
    /**
     * Google Tag Manager コンテナ ID(Google Tag Manager container ID)
     *
     * @param string|null $googleTagManagerContainerId
     *
     * @return self
     */
    public function setGoogleTagManagerContainerId(?string $googleTagManagerContainerId) : self
    {
        $this->initialized['googleTagManagerContainerId'] = true;
        $this->googleTagManagerContainerId = $googleTagManagerContainerId;
        return $this;
    }
}
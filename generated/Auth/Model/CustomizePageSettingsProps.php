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
     * サービス名
     *
     * @var string
     */
    protected $title;
    /**
     * 利用規約URL
     *
     * @var string
     */
    protected $termsOfServiceUrl;
    /**
     * プライバシーポリシーURL
     *
     * @var string
     */
    protected $privacyPolicyUrl;
    /**
     * Google Tag Manager コンテナ ID
     *
     * @var string
     */
    protected $googleTagManagerContainerId;
    /**
     * サービス名
     *
     * @return string
     */
    public function getTitle() : string
    {
        return $this->title;
    }
    /**
     * サービス名
     *
     * @param string $title
     *
     * @return self
     */
    public function setTitle(string $title) : self
    {
        $this->initialized['title'] = true;
        $this->title = $title;
        return $this;
    }
    /**
     * 利用規約URL
     *
     * @return string
     */
    public function getTermsOfServiceUrl() : string
    {
        return $this->termsOfServiceUrl;
    }
    /**
     * 利用規約URL
     *
     * @param string $termsOfServiceUrl
     *
     * @return self
     */
    public function setTermsOfServiceUrl(string $termsOfServiceUrl) : self
    {
        $this->initialized['termsOfServiceUrl'] = true;
        $this->termsOfServiceUrl = $termsOfServiceUrl;
        return $this;
    }
    /**
     * プライバシーポリシーURL
     *
     * @return string
     */
    public function getPrivacyPolicyUrl() : string
    {
        return $this->privacyPolicyUrl;
    }
    /**
     * プライバシーポリシーURL
     *
     * @param string $privacyPolicyUrl
     *
     * @return self
     */
    public function setPrivacyPolicyUrl(string $privacyPolicyUrl) : self
    {
        $this->initialized['privacyPolicyUrl'] = true;
        $this->privacyPolicyUrl = $privacyPolicyUrl;
        return $this;
    }
    /**
     * Google Tag Manager コンテナ ID
     *
     * @return string
     */
    public function getGoogleTagManagerContainerId() : string
    {
        return $this->googleTagManagerContainerId;
    }
    /**
     * Google Tag Manager コンテナ ID
     *
     * @param string $googleTagManagerContainerId
     *
     * @return self
     */
    public function setGoogleTagManagerContainerId(string $googleTagManagerContainerId) : self
    {
        $this->initialized['googleTagManagerContainerId'] = true;
        $this->googleTagManagerContainerId = $googleTagManagerContainerId;
        return $this;
    }
}
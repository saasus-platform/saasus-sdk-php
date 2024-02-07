<?php

namespace AntiPatternInc\Saasus\Sdk\Auth\Model;

class CustomizePageProps extends \ArrayObject
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
    * 画面のHTMLを編集できます
    ※ 未提供の機能のため、変更・保存はできません
    
    Edit page HTML
    ※ This function is not yet provided, so it cannot be changed or saved.
    
    *
    * @var string|null
    */
    protected $htmlContents;
    /**
     * 利用規約の同意チェックボックスを表示するが設定されているか(display the terms of use agreement check box)
     *
     * @var bool|null
     */
    protected $isTermsOfService;
    /**
     * プライバシーポリシーチェックボックスを表示するが設定されているか(show the privacy policy checkbox)
     *
     * @var bool|null
     */
    protected $isPrivacyPolicy;
    /**
    * 画面のHTMLを編集できます
    ※ 未提供の機能のため、変更・保存はできません
    
    Edit page HTML
    ※ This function is not yet provided, so it cannot be changed or saved.
    
    *
    * @return string|null
    */
    public function getHtmlContents() : ?string
    {
        return $this->htmlContents;
    }
    /**
    * 画面のHTMLを編集できます
    ※ 未提供の機能のため、変更・保存はできません
    
    Edit page HTML
    ※ This function is not yet provided, so it cannot be changed or saved.
    
    *
    * @param string|null $htmlContents
    *
    * @return self
    */
    public function setHtmlContents(?string $htmlContents) : self
    {
        $this->initialized['htmlContents'] = true;
        $this->htmlContents = $htmlContents;
        return $this;
    }
    /**
     * 利用規約の同意チェックボックスを表示するが設定されているか(display the terms of use agreement check box)
     *
     * @return bool|null
     */
    public function getIsTermsOfService() : ?bool
    {
        return $this->isTermsOfService;
    }
    /**
     * 利用規約の同意チェックボックスを表示するが設定されているか(display the terms of use agreement check box)
     *
     * @param bool|null $isTermsOfService
     *
     * @return self
     */
    public function setIsTermsOfService(?bool $isTermsOfService) : self
    {
        $this->initialized['isTermsOfService'] = true;
        $this->isTermsOfService = $isTermsOfService;
        return $this;
    }
    /**
     * プライバシーポリシーチェックボックスを表示するが設定されているか(show the privacy policy checkbox)
     *
     * @return bool|null
     */
    public function getIsPrivacyPolicy() : ?bool
    {
        return $this->isPrivacyPolicy;
    }
    /**
     * プライバシーポリシーチェックボックスを表示するが設定されているか(show the privacy policy checkbox)
     *
     * @param bool|null $isPrivacyPolicy
     *
     * @return self
     */
    public function setIsPrivacyPolicy(?bool $isPrivacyPolicy) : self
    {
        $this->initialized['isPrivacyPolicy'] = true;
        $this->isPrivacyPolicy = $isPrivacyPolicy;
        return $this;
    }
}
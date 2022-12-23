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
    
    You can edit the HTML of the screen
    ※ Unable to change/save due to unprovided function
    
    *
    * @var string
    */
    protected $htmlContents;
    /**
     * 利用規約の同意チェックボックスを表示するが設定されているか(Whether or not to display the agreement check box for the terms of use)
     *
     * @var bool
     */
    protected $isTermsOfService;
    /**
     * プライバシーポリシーチェックボックスを表示するが設定されているか(Whether to show the privacy policy checkbox)
     *
     * @var bool
     */
    protected $isPrivacyPolicy;
    /**
    * 画面のHTMLを編集できます
    ※ 未提供の機能のため、変更・保存はできません
    
    You can edit the HTML of the screen
    ※ Unable to change/save due to unprovided function
    
    *
    * @return string
    */
    public function getHtmlContents() : string
    {
        return $this->htmlContents;
    }
    /**
    * 画面のHTMLを編集できます
    ※ 未提供の機能のため、変更・保存はできません
    
    You can edit the HTML of the screen
    ※ Unable to change/save due to unprovided function
    
    *
    * @param string $htmlContents
    *
    * @return self
    */
    public function setHtmlContents(string $htmlContents) : self
    {
        $this->initialized['htmlContents'] = true;
        $this->htmlContents = $htmlContents;
        return $this;
    }
    /**
     * 利用規約の同意チェックボックスを表示するが設定されているか(Whether or not to display the agreement check box for the terms of use)
     *
     * @return bool
     */
    public function getIsTermsOfService() : bool
    {
        return $this->isTermsOfService;
    }
    /**
     * 利用規約の同意チェックボックスを表示するが設定されているか(Whether or not to display the agreement check box for the terms of use)
     *
     * @param bool $isTermsOfService
     *
     * @return self
     */
    public function setIsTermsOfService(bool $isTermsOfService) : self
    {
        $this->initialized['isTermsOfService'] = true;
        $this->isTermsOfService = $isTermsOfService;
        return $this;
    }
    /**
     * プライバシーポリシーチェックボックスを表示するが設定されているか(Whether to show the privacy policy checkbox)
     *
     * @return bool
     */
    public function getIsPrivacyPolicy() : bool
    {
        return $this->isPrivacyPolicy;
    }
    /**
     * プライバシーポリシーチェックボックスを表示するが設定されているか(Whether to show the privacy policy checkbox)
     *
     * @param bool $isPrivacyPolicy
     *
     * @return self
     */
    public function setIsPrivacyPolicy(bool $isPrivacyPolicy) : self
    {
        $this->initialized['isPrivacyPolicy'] = true;
        $this->isPrivacyPolicy = $isPrivacyPolicy;
        return $this;
    }
}
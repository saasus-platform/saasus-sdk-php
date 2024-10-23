<?php

namespace AntiPatternInc\Saasus\Sdk\Auth\Model;

class CustomizePageProps extends \ArrayObject
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
    * Edit page HTML
    ※ This function is not yet provided, so it cannot be changed or saved.
    
    *
    * @var string|null
    */
    protected $htmlContents;
    /**
     * display the terms of use agreement check box
     *
     * @var bool|null
     */
    protected $isTermsOfService;
    /**
     * show the privacy policy checkbox
     *
     * @var bool|null
     */
    protected $isPrivacyPolicy;
    /**
    * Edit page HTML
    ※ This function is not yet provided, so it cannot be changed or saved.
    
    *
    * @return string|null
    */
    public function getHtmlContents(): ?string
    {
        return $this->htmlContents;
    }
    /**
    * Edit page HTML
    ※ This function is not yet provided, so it cannot be changed or saved.
    
    *
    * @param string|null $htmlContents
    *
    * @return self
    */
    public function setHtmlContents(?string $htmlContents): self
    {
        $this->initialized['htmlContents'] = true;
        $this->htmlContents = $htmlContents;
        return $this;
    }
    /**
     * display the terms of use agreement check box
     *
     * @return bool|null
     */
    public function getIsTermsOfService(): ?bool
    {
        return $this->isTermsOfService;
    }
    /**
     * display the terms of use agreement check box
     *
     * @param bool|null $isTermsOfService
     *
     * @return self
     */
    public function setIsTermsOfService(?bool $isTermsOfService): self
    {
        $this->initialized['isTermsOfService'] = true;
        $this->isTermsOfService = $isTermsOfService;
        return $this;
    }
    /**
     * show the privacy policy checkbox
     *
     * @return bool|null
     */
    public function getIsPrivacyPolicy(): ?bool
    {
        return $this->isPrivacyPolicy;
    }
    /**
     * show the privacy policy checkbox
     *
     * @param bool|null $isPrivacyPolicy
     *
     * @return self
     */
    public function setIsPrivacyPolicy(?bool $isPrivacyPolicy): self
    {
        $this->initialized['isPrivacyPolicy'] = true;
        $this->isPrivacyPolicy = $isPrivacyPolicy;
        return $this;
    }
}
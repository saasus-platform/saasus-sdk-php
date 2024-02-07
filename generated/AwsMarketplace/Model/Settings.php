<?php

namespace AntiPatternInc\Saasus\Sdk\AwsMarketplace\Model;

class Settings extends \ArrayObject
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
     * 
     *
     * @var string|null
     */
    protected $productCode;
    /**
     * 
     *
     * @var string|null
     */
    protected $roleArn;
    /**
     * 
     *
     * @var string|null
     */
    protected $roleExternalId;
    /**
     * 
     *
     * @var string|null
     */
    protected $snsTopicArn;
    /**
     * 
     *
     * @var string|null
     */
    protected $casBucketName;
    /**
     * 
     *
     * @var string|null
     */
    protected $casSnsTopicArn;
    /**
     * 
     *
     * @var string|null
     */
    protected $sellerSnsTopicArn;
    /**
     * 
     *
     * @var string|null
     */
    protected $redirectSignUpPageFunctionUrl;
    /**
     * 
     *
     * @var string|null
     */
    protected $sqsArn;
    /**
     * 
     *
     * @return string|null
     */
    public function getProductCode() : ?string
    {
        return $this->productCode;
    }
    /**
     * 
     *
     * @param string|null $productCode
     *
     * @return self
     */
    public function setProductCode(?string $productCode) : self
    {
        $this->initialized['productCode'] = true;
        $this->productCode = $productCode;
        return $this;
    }
    /**
     * 
     *
     * @return string|null
     */
    public function getRoleArn() : ?string
    {
        return $this->roleArn;
    }
    /**
     * 
     *
     * @param string|null $roleArn
     *
     * @return self
     */
    public function setRoleArn(?string $roleArn) : self
    {
        $this->initialized['roleArn'] = true;
        $this->roleArn = $roleArn;
        return $this;
    }
    /**
     * 
     *
     * @return string|null
     */
    public function getRoleExternalId() : ?string
    {
        return $this->roleExternalId;
    }
    /**
     * 
     *
     * @param string|null $roleExternalId
     *
     * @return self
     */
    public function setRoleExternalId(?string $roleExternalId) : self
    {
        $this->initialized['roleExternalId'] = true;
        $this->roleExternalId = $roleExternalId;
        return $this;
    }
    /**
     * 
     *
     * @return string|null
     */
    public function getSnsTopicArn() : ?string
    {
        return $this->snsTopicArn;
    }
    /**
     * 
     *
     * @param string|null $snsTopicArn
     *
     * @return self
     */
    public function setSnsTopicArn(?string $snsTopicArn) : self
    {
        $this->initialized['snsTopicArn'] = true;
        $this->snsTopicArn = $snsTopicArn;
        return $this;
    }
    /**
     * 
     *
     * @return string|null
     */
    public function getCasBucketName() : ?string
    {
        return $this->casBucketName;
    }
    /**
     * 
     *
     * @param string|null $casBucketName
     *
     * @return self
     */
    public function setCasBucketName(?string $casBucketName) : self
    {
        $this->initialized['casBucketName'] = true;
        $this->casBucketName = $casBucketName;
        return $this;
    }
    /**
     * 
     *
     * @return string|null
     */
    public function getCasSnsTopicArn() : ?string
    {
        return $this->casSnsTopicArn;
    }
    /**
     * 
     *
     * @param string|null $casSnsTopicArn
     *
     * @return self
     */
    public function setCasSnsTopicArn(?string $casSnsTopicArn) : self
    {
        $this->initialized['casSnsTopicArn'] = true;
        $this->casSnsTopicArn = $casSnsTopicArn;
        return $this;
    }
    /**
     * 
     *
     * @return string|null
     */
    public function getSellerSnsTopicArn() : ?string
    {
        return $this->sellerSnsTopicArn;
    }
    /**
     * 
     *
     * @param string|null $sellerSnsTopicArn
     *
     * @return self
     */
    public function setSellerSnsTopicArn(?string $sellerSnsTopicArn) : self
    {
        $this->initialized['sellerSnsTopicArn'] = true;
        $this->sellerSnsTopicArn = $sellerSnsTopicArn;
        return $this;
    }
    /**
     * 
     *
     * @return string|null
     */
    public function getRedirectSignUpPageFunctionUrl() : ?string
    {
        return $this->redirectSignUpPageFunctionUrl;
    }
    /**
     * 
     *
     * @param string|null $redirectSignUpPageFunctionUrl
     *
     * @return self
     */
    public function setRedirectSignUpPageFunctionUrl(?string $redirectSignUpPageFunctionUrl) : self
    {
        $this->initialized['redirectSignUpPageFunctionUrl'] = true;
        $this->redirectSignUpPageFunctionUrl = $redirectSignUpPageFunctionUrl;
        return $this;
    }
    /**
     * 
     *
     * @return string|null
     */
    public function getSqsArn() : ?string
    {
        return $this->sqsArn;
    }
    /**
     * 
     *
     * @param string|null $sqsArn
     *
     * @return self
     */
    public function setSqsArn(?string $sqsArn) : self
    {
        $this->initialized['sqsArn'] = true;
        $this->sqsArn = $sqsArn;
        return $this;
    }
}
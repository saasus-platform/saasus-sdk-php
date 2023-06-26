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
     * @var string
     */
    protected $productCode;
    /**
     * 
     *
     * @var string
     */
    protected $roleArn;
    /**
     * 
     *
     * @var string
     */
    protected $roleExternalId;
    /**
     * 
     *
     * @var string
     */
    protected $snsTopicArn;
    /**
     * 
     *
     * @var string
     */
    protected $casBucketName;
    /**
     * 
     *
     * @var string
     */
    protected $casSnsTopicArn;
    /**
     * 
     *
     * @var string
     */
    protected $sellerSnsTopicArn;
    /**
     * 
     *
     * @var string
     */
    protected $redirectSignUpPageFunctionUrl;
    /**
     * 
     *
     * @var string
     */
    protected $sqsArn;
    /**
     * 
     *
     * @return string
     */
    public function getProductCode() : string
    {
        return $this->productCode;
    }
    /**
     * 
     *
     * @param string $productCode
     *
     * @return self
     */
    public function setProductCode(string $productCode) : self
    {
        $this->initialized['productCode'] = true;
        $this->productCode = $productCode;
        return $this;
    }
    /**
     * 
     *
     * @return string
     */
    public function getRoleArn() : string
    {
        return $this->roleArn;
    }
    /**
     * 
     *
     * @param string $roleArn
     *
     * @return self
     */
    public function setRoleArn(string $roleArn) : self
    {
        $this->initialized['roleArn'] = true;
        $this->roleArn = $roleArn;
        return $this;
    }
    /**
     * 
     *
     * @return string
     */
    public function getRoleExternalId() : string
    {
        return $this->roleExternalId;
    }
    /**
     * 
     *
     * @param string $roleExternalId
     *
     * @return self
     */
    public function setRoleExternalId(string $roleExternalId) : self
    {
        $this->initialized['roleExternalId'] = true;
        $this->roleExternalId = $roleExternalId;
        return $this;
    }
    /**
     * 
     *
     * @return string
     */
    public function getSnsTopicArn() : string
    {
        return $this->snsTopicArn;
    }
    /**
     * 
     *
     * @param string $snsTopicArn
     *
     * @return self
     */
    public function setSnsTopicArn(string $snsTopicArn) : self
    {
        $this->initialized['snsTopicArn'] = true;
        $this->snsTopicArn = $snsTopicArn;
        return $this;
    }
    /**
     * 
     *
     * @return string
     */
    public function getCasBucketName() : string
    {
        return $this->casBucketName;
    }
    /**
     * 
     *
     * @param string $casBucketName
     *
     * @return self
     */
    public function setCasBucketName(string $casBucketName) : self
    {
        $this->initialized['casBucketName'] = true;
        $this->casBucketName = $casBucketName;
        return $this;
    }
    /**
     * 
     *
     * @return string
     */
    public function getCasSnsTopicArn() : string
    {
        return $this->casSnsTopicArn;
    }
    /**
     * 
     *
     * @param string $casSnsTopicArn
     *
     * @return self
     */
    public function setCasSnsTopicArn(string $casSnsTopicArn) : self
    {
        $this->initialized['casSnsTopicArn'] = true;
        $this->casSnsTopicArn = $casSnsTopicArn;
        return $this;
    }
    /**
     * 
     *
     * @return string
     */
    public function getSellerSnsTopicArn() : string
    {
        return $this->sellerSnsTopicArn;
    }
    /**
     * 
     *
     * @param string $sellerSnsTopicArn
     *
     * @return self
     */
    public function setSellerSnsTopicArn(string $sellerSnsTopicArn) : self
    {
        $this->initialized['sellerSnsTopicArn'] = true;
        $this->sellerSnsTopicArn = $sellerSnsTopicArn;
        return $this;
    }
    /**
     * 
     *
     * @return string
     */
    public function getRedirectSignUpPageFunctionUrl() : string
    {
        return $this->redirectSignUpPageFunctionUrl;
    }
    /**
     * 
     *
     * @param string $redirectSignUpPageFunctionUrl
     *
     * @return self
     */
    public function setRedirectSignUpPageFunctionUrl(string $redirectSignUpPageFunctionUrl) : self
    {
        $this->initialized['redirectSignUpPageFunctionUrl'] = true;
        $this->redirectSignUpPageFunctionUrl = $redirectSignUpPageFunctionUrl;
        return $this;
    }
    /**
     * 
     *
     * @return string
     */
    public function getSqsArn() : string
    {
        return $this->sqsArn;
    }
    /**
     * 
     *
     * @param string $sqsArn
     *
     * @return self
     */
    public function setSqsArn(string $sqsArn) : self
    {
        $this->initialized['sqsArn'] = true;
        $this->sqsArn = $sqsArn;
        return $this;
    }
}
<?php

namespace AntiPatternInc\Saasus\Sdk\Integration\Model;

class EventBridgeSettings extends \ArrayObject
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
     * AWSアカウントID(AWS Account ID)
     *
     * @var string|null
     */
    protected $awsAccountId;
    /**
    * 中国の寧夏、北京を除く全てのAWSリージョンが選択可能です。
    
    All AWS regions except Ningxia and Beijing in China can be selected.
    
    *
    * @var string|null
    */
    protected $awsRegion;
    /**
     * AWSアカウントID(AWS Account ID)
     *
     * @return string|null
     */
    public function getAwsAccountId() : ?string
    {
        return $this->awsAccountId;
    }
    /**
     * AWSアカウントID(AWS Account ID)
     *
     * @param string|null $awsAccountId
     *
     * @return self
     */
    public function setAwsAccountId(?string $awsAccountId) : self
    {
        $this->initialized['awsAccountId'] = true;
        $this->awsAccountId = $awsAccountId;
        return $this;
    }
    /**
    * 中国の寧夏、北京を除く全てのAWSリージョンが選択可能です。
    
    All AWS regions except Ningxia and Beijing in China can be selected.
    
    *
    * @return string|null
    */
    public function getAwsRegion() : ?string
    {
        return $this->awsRegion;
    }
    /**
    * 中国の寧夏、北京を除く全てのAWSリージョンが選択可能です。
    
    All AWS regions except Ningxia and Beijing in China can be selected.
    
    *
    * @param string|null $awsRegion
    *
    * @return self
    */
    public function setAwsRegion(?string $awsRegion) : self
    {
        $this->initialized['awsRegion'] = true;
        $this->awsRegion = $awsRegion;
        return $this;
    }
}
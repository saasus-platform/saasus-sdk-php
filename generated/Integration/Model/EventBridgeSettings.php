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
     * AWSアカウントID
     *
     * @var string
     */
    protected $awsAccountId;
    /**
     * 中国の寧夏、北京を除く全てのAWSリージョンが選択可能です。
     *
     * @var string
     */
    protected $awsRegion;
    /**
     * AWSアカウントID
     *
     * @return string
     */
    public function getAwsAccountId() : string
    {
        return $this->awsAccountId;
    }
    /**
     * AWSアカウントID
     *
     * @param string $awsAccountId
     *
     * @return self
     */
    public function setAwsAccountId(string $awsAccountId) : self
    {
        $this->initialized['awsAccountId'] = true;
        $this->awsAccountId = $awsAccountId;
        return $this;
    }
    /**
     * 中国の寧夏、北京を除く全てのAWSリージョンが選択可能です。
     *
     * @return string
     */
    public function getAwsRegion() : string
    {
        return $this->awsRegion;
    }
    /**
     * 中国の寧夏、北京を除く全てのAWSリージョンが選択可能です。
     *
     * @param string $awsRegion
     *
     * @return self
     */
    public function setAwsRegion(string $awsRegion) : self
    {
        $this->initialized['awsRegion'] = true;
        $this->awsRegion = $awsRegion;
        return $this;
    }
}
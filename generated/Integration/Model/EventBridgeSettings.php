<?php

namespace AntiPatternInc\Saasus\Sdk\Integration\Model;

class EventBridgeSettings extends \ArrayObject
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
     * AWS Account ID
     *
     * @var string
     */
    protected $awsAccountId;
    /**
     * All AWS regions except Ningxia and Beijing in China can be selected.
     *
     * @var string
     */
    protected $awsRegion;
    /**
     * AWS Account ID
     *
     * @return string
     */
    public function getAwsAccountId(): string
    {
        return $this->awsAccountId;
    }
    /**
     * AWS Account ID
     *
     * @param string $awsAccountId
     *
     * @return self
     */
    public function setAwsAccountId(string $awsAccountId): self
    {
        $this->initialized['awsAccountId'] = true;
        $this->awsAccountId = $awsAccountId;
        return $this;
    }
    /**
     * All AWS regions except Ningxia and Beijing in China can be selected.
     *
     * @return string
     */
    public function getAwsRegion(): string
    {
        return $this->awsRegion;
    }
    /**
     * All AWS regions except Ningxia and Beijing in China can be selected.
     *
     * @param string $awsRegion
     *
     * @return self
     */
    public function setAwsRegion(string $awsRegion): self
    {
        $this->initialized['awsRegion'] = true;
        $this->awsRegion = $awsRegion;
        return $this;
    }
}
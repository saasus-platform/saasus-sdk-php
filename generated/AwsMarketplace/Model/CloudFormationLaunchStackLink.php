<?php

namespace AntiPatternInc\Saasus\Sdk\AwsMarketplace\Model;

class CloudFormationLaunchStackLink extends \ArrayObject
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
    protected $link;
    /**
     * 
     *
     * @return string|null
     */
    public function getLink() : ?string
    {
        return $this->link;
    }
    /**
     * 
     *
     * @param string|null $link
     *
     * @return self
     */
    public function setLink(?string $link) : self
    {
        $this->initialized['link'] = true;
        $this->link = $link;
        return $this;
    }
}
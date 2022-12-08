<?php

namespace AntiPatternInc\Saasus\Sdk\Auth\Model;

class UpdateBasicInfoParam extends \ArrayObject
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
    protected $domainName;
    /**
     * 
     *
     * @return string
     */
    public function getDomainName() : string
    {
        return $this->domainName;
    }
    /**
     * 
     *
     * @param string $domainName
     *
     * @return self
     */
    public function setDomainName(string $domainName) : self
    {
        $this->initialized['domainName'] = true;
        $this->domainName = $domainName;
        return $this;
    }
}
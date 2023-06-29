<?php

namespace AntiPatternInc\Saasus\Sdk\AwsMarketplace\Model;

class GetListingStatusResult extends \ArrayObject
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
    protected $listingStatus;
    /**
     * 
     *
     * @return string
     */
    public function getListingStatus() : string
    {
        return $this->listingStatus;
    }
    /**
     * 
     *
     * @param string $listingStatus
     *
     * @return self
     */
    public function setListingStatus(string $listingStatus) : self
    {
        $this->initialized['listingStatus'] = true;
        $this->listingStatus = $listingStatus;
        return $this;
    }
}
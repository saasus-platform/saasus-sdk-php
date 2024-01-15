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
     * @var string|null
     */
    protected $listingStatus;
    /**
     * 
     *
     * @return string|null
     */
    public function getListingStatus() : ?string
    {
        return $this->listingStatus;
    }
    /**
     * 
     *
     * @param string|null $listingStatus
     *
     * @return self
     */
    public function setListingStatus(?string $listingStatus) : self
    {
        $this->initialized['listingStatus'] = true;
        $this->listingStatus = $listingStatus;
        return $this;
    }
}
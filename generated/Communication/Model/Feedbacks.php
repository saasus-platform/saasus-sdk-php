<?php

namespace AntiPatternInc\Saasus\Sdk\Communication\Model;

class Feedbacks extends \ArrayObject
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
     * @var array<string, mixed>[]|null
     */
    protected $feedbacks;
    /**
     * 
     *
     * @return array<string, mixed>[]|null
     */
    public function getFeedbacks() : ?array
    {
        return $this->feedbacks;
    }
    /**
     * 
     *
     * @param array<string, mixed>[]|null $feedbacks
     *
     * @return self
     */
    public function setFeedbacks(?array $feedbacks) : self
    {
        $this->initialized['feedbacks'] = true;
        $this->feedbacks = $feedbacks;
        return $this;
    }
}
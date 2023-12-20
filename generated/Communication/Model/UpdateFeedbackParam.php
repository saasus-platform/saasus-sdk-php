<?php

namespace AntiPatternInc\Saasus\Sdk\Communication\Model;

class UpdateFeedbackParam extends \ArrayObject
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
    protected $feedbackTitle;
    /**
     * 
     *
     * @var string
     */
    protected $feedbackDescription;
    /**
     * 
     *
     * @return string
     */
    public function getFeedbackTitle() : string
    {
        return $this->feedbackTitle;
    }
    /**
     * 
     *
     * @param string $feedbackTitle
     *
     * @return self
     */
    public function setFeedbackTitle(string $feedbackTitle) : self
    {
        $this->initialized['feedbackTitle'] = true;
        $this->feedbackTitle = $feedbackTitle;
        return $this;
    }
    /**
     * 
     *
     * @return string
     */
    public function getFeedbackDescription() : string
    {
        return $this->feedbackDescription;
    }
    /**
     * 
     *
     * @param string $feedbackDescription
     *
     * @return self
     */
    public function setFeedbackDescription(string $feedbackDescription) : self
    {
        $this->initialized['feedbackDescription'] = true;
        $this->feedbackDescription = $feedbackDescription;
        return $this;
    }
}
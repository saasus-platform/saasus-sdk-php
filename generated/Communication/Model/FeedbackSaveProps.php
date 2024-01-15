<?php

namespace AntiPatternInc\Saasus\Sdk\Communication\Model;

class FeedbackSaveProps extends \ArrayObject
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
    protected $feedbackTitle;
    /**
     * 
     *
     * @var string|null
     */
    protected $feedbackDescription;
    /**
     * 
     *
     * @return string|null
     */
    public function getFeedbackTitle() : ?string
    {
        return $this->feedbackTitle;
    }
    /**
     * 
     *
     * @param string|null $feedbackTitle
     *
     * @return self
     */
    public function setFeedbackTitle(?string $feedbackTitle) : self
    {
        $this->initialized['feedbackTitle'] = true;
        $this->feedbackTitle = $feedbackTitle;
        return $this;
    }
    /**
     * 
     *
     * @return string|null
     */
    public function getFeedbackDescription() : ?string
    {
        return $this->feedbackDescription;
    }
    /**
     * 
     *
     * @param string|null $feedbackDescription
     *
     * @return self
     */
    public function setFeedbackDescription(?string $feedbackDescription) : self
    {
        $this->initialized['feedbackDescription'] = true;
        $this->feedbackDescription = $feedbackDescription;
        return $this;
    }
}
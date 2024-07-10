<?php

namespace AntiPatternInc\Saasus\Sdk\Communication\Model;

class Feedbacks extends \ArrayObject
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
     * 
     *
     * @var list<array<string, mixed>>|null
     */
    protected $feedbacks;
    /**
     * 
     *
     * @return list<array<string, mixed>>|null
     */
    public function getFeedbacks(): ?array
    {
        return $this->feedbacks;
    }
    /**
     * 
     *
     * @param list<array<string, mixed>>|null $feedbacks
     *
     * @return self
     */
    public function setFeedbacks(?array $feedbacks): self
    {
        $this->initialized['feedbacks'] = true;
        $this->feedbacks = $feedbacks;
        return $this;
    }
}
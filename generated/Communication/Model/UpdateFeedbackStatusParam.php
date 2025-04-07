<?php

namespace AntiPatternInc\Saasus\Sdk\Communication\Model;

class UpdateFeedbackStatusParam extends \ArrayObject
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
     * @var int|null
     */
    protected $status;
    /**
     * 
     *
     * @return int|null
     */
    public function getStatus(): ?int
    {
        return $this->status;
    }
    /**
     * 
     *
     * @param int|null $status
     *
     * @return self
     */
    public function setStatus(?int $status): self
    {
        $this->initialized['status'] = true;
        $this->status = $status;
        return $this;
    }
}
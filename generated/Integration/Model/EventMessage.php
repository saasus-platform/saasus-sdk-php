<?php

namespace AntiPatternInc\Saasus\Sdk\Integration\Model;

class EventMessage extends \ArrayObject
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
     * event type
     *
     * @var string
     */
    protected $eventType;
    /**
     * detailed event type
     *
     * @var string
     */
    protected $eventDetailType;
    /**
     * event message
     *
     * @var string
     */
    protected $message;
    /**
     * event type
     *
     * @return string
     */
    public function getEventType(): string
    {
        return $this->eventType;
    }
    /**
     * event type
     *
     * @param string $eventType
     *
     * @return self
     */
    public function setEventType(string $eventType): self
    {
        $this->initialized['eventType'] = true;
        $this->eventType = $eventType;
        return $this;
    }
    /**
     * detailed event type
     *
     * @return string
     */
    public function getEventDetailType(): string
    {
        return $this->eventDetailType;
    }
    /**
     * detailed event type
     *
     * @param string $eventDetailType
     *
     * @return self
     */
    public function setEventDetailType(string $eventDetailType): self
    {
        $this->initialized['eventDetailType'] = true;
        $this->eventDetailType = $eventDetailType;
        return $this;
    }
    /**
     * event message
     *
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }
    /**
     * event message
     *
     * @param string $message
     *
     * @return self
     */
    public function setMessage(string $message): self
    {
        $this->initialized['message'] = true;
        $this->message = $message;
        return $this;
    }
}
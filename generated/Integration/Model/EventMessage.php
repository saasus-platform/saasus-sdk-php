<?php

namespace AntiPatternInc\Saasus\Sdk\Integration\Model;

class EventMessage extends \ArrayObject
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
     * イベントタイプ(event type)
     *
     * @var string|null
     */
    protected $eventType;
    /**
     * 詳細イベントタイプ(detailed event type)
     *
     * @var string|null
     */
    protected $eventDetailType;
    /**
     * イベントメッセージ(event message)
     *
     * @var string|null
     */
    protected $message;
    /**
     * イベントタイプ(event type)
     *
     * @return string|null
     */
    public function getEventType() : ?string
    {
        return $this->eventType;
    }
    /**
     * イベントタイプ(event type)
     *
     * @param string|null $eventType
     *
     * @return self
     */
    public function setEventType(?string $eventType) : self
    {
        $this->initialized['eventType'] = true;
        $this->eventType = $eventType;
        return $this;
    }
    /**
     * 詳細イベントタイプ(detailed event type)
     *
     * @return string|null
     */
    public function getEventDetailType() : ?string
    {
        return $this->eventDetailType;
    }
    /**
     * 詳細イベントタイプ(detailed event type)
     *
     * @param string|null $eventDetailType
     *
     * @return self
     */
    public function setEventDetailType(?string $eventDetailType) : self
    {
        $this->initialized['eventDetailType'] = true;
        $this->eventDetailType = $eventDetailType;
        return $this;
    }
    /**
     * イベントメッセージ(event message)
     *
     * @return string|null
     */
    public function getMessage() : ?string
    {
        return $this->message;
    }
    /**
     * イベントメッセージ(event message)
     *
     * @param string|null $message
     *
     * @return self
     */
    public function setMessage(?string $message) : self
    {
        $this->initialized['message'] = true;
        $this->message = $message;
        return $this;
    }
}
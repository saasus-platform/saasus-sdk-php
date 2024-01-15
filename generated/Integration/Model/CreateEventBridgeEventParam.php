<?php

namespace AntiPatternInc\Saasus\Sdk\Integration\Model;

class CreateEventBridgeEventParam extends \ArrayObject
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
     * イベントメッセージ(event message)
     *
     * @var EventMessage[]|null
     */
    protected $eventMessages;
    /**
     * イベントメッセージ(event message)
     *
     * @return EventMessage[]|null
     */
    public function getEventMessages() : ?array
    {
        return $this->eventMessages;
    }
    /**
     * イベントメッセージ(event message)
     *
     * @param EventMessage[]|null $eventMessages
     *
     * @return self
     */
    public function setEventMessages(?array $eventMessages) : self
    {
        $this->initialized['eventMessages'] = true;
        $this->eventMessages = $eventMessages;
        return $this;
    }
}
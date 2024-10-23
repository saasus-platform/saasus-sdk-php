<?php

namespace AntiPatternInc\Saasus\Sdk\Integration\Model;

class CreateEventBridgeEventParam extends \ArrayObject
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
     * event message
     *
     * @var list<EventMessage>
     */
    protected $eventMessages;
    /**
     * event message
     *
     * @return list<EventMessage>
     */
    public function getEventMessages(): array
    {
        return $this->eventMessages;
    }
    /**
     * event message
     *
     * @param list<EventMessage> $eventMessages
     *
     * @return self
     */
    public function setEventMessages(array $eventMessages): self
    {
        $this->initialized['eventMessages'] = true;
        $this->eventMessages = $eventMessages;
        return $this;
    }
}
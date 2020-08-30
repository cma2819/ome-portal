<?php

namespace Ome\Event\Interfaces\UseCases\SaveOengusEvent;

use Ome\Event\Entities\Event;

/**
 * Response object for SaveOengusEvent.
 */
class SaveOengusEventResponse
{
    private Event $event;

    public function __construct(
        Event $event
    ) {
        $this->event = $event;
    }

    /**
     * Get the value of event
     */
    public function getEvent()
    {
        return $this->event;
    }
}

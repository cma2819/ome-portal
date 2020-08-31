<?php

namespace Ome\Event\Interfaces\UseCases\ExtractOengusEvent;

use Ome\Event\Entities\Event;
use Ome\Event\Interfaces\Dto\OmeEventDto;

/**
 * Response object for ExtractOengusEvent.
 */
class ExtractOengusEventResponse
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

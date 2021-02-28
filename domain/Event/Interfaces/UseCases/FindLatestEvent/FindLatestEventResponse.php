<?php

namespace Ome\Event\Interfaces\UseCases\FindLatestEvent;

use Ome\Event\Entities\Event;

/**
 * Response object for FindLatestEvent.
 */
class FindLatestEventResponse
{
    private ?Event $event;

    public function __construct(
        ?Event $event
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

<?php

namespace Ome\Event\Interfaces\UseCases\ListActiveOengusEvent;

use Ome\Event\Entities\Event;

/**
 * Response object for ListActiveOengusEvent.
 */
class ListActiveOengusEventResponse
{
    /** @var Event[] */
    private array $events = [];

    public function __construct(
        array $events
    ) {
        foreach ($events as $event) {
            if ($event instanceof Event) {
                $this->events[] = $event;
            }
        }
    }

    /**
     * Get the value of events
     */
    public function getEvents()
    {
        return $this->events;
    }
}

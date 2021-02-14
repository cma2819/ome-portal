<?php

namespace Ome\Event\Commands;

use Ome\Event\Entities\Event;
use Ome\Event\Interfaces\Commands\DeleteEventCommand;

class InmemoryDeleteEvent implements DeleteEventCommand
{
    /** @var Event[] */
    private array $events;
    /**
     * @param Event[] $events
     */
    public function __construct(
        array $events
    ) {
        $this->events = $events;
    }

    public function execute(string $id): bool
    {
        foreach ($this->events as $index => $event) {
            if ($event->getId() === $id) {
                unset($this->events[$index]);
                return true;
            }
        }

        return false;
    }

    /**
     * Get the value of events
     */
    public function getEvents()
    {
        return $this->events;
    }
}

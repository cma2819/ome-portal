<?php

namespace Ome\Event\Commands;

use Ome\Event\Entities\Event;
use Ome\Event\Interfaces\Commands\PersistEventCommand;

class InmemoryPersistEvent implements PersistEventCommand
{
    /** @var Event[] */
    private array $events = [];

    public function execute(Event $event): Event
    {
        $this->events[$event->getId()] = $event;
        return $event;
    }

    public function find(string $id): ?Event
    {
        foreach ($this->events as $event) {
            if ($event->getId() === $id) {
                return $event;
            }
        }

        return null;
    }
}

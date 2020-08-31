<?php

namespace Ome\Event\Queries;

use Ome\Event\Interfaces\Dto\OmeEventDto;
use Ome\Event\Interfaces\Queries\FindEventQuery;

class InmemoryFindEvent implements FindEventQuery
{
    /** @var OmeEventDto[] */
    private array $events;

    public function __construct(
        array $events
    ) {
        $this->events = $events;
    }

    public function fetch(string $id): ?OmeEventDto
    {
        foreach ($this->events as $event) {
            if ($event->getId() === $id) {
                return $event;
            }
        }

        return null;
    }
}

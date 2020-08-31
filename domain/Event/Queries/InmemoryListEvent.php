<?php

namespace Ome\Event\Queries;

use Ome\Event\Interfaces\Queries\ListEventQuery;

class InmemoryListEvent implements ListEventQuery
{
    /** @var OmeEventDto[] */
    private array $omeEvents;

    public function __construct(
        array $omeEvents
    ) {
        $this->omeEvents = $omeEvents;
    }

    public function fetch(): array
    {
        return $this->omeEvents;
    }
}

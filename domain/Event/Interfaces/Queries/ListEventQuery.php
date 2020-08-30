<?php

namespace Ome\Event\Interfaces\Queries;

use Ome\Event\Interfaces\Dto\OmeEventDto;

interface ListEventQuery
{
    /**
     * List events.
     *
     * @return OmeEventDto[]
     */
    public function fetch(): array;
}

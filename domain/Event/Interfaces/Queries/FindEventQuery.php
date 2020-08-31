<?php

namespace Ome\Event\Interfaces\Queries;

use Ome\Event\Interfaces\Dto\OmeEventDto;

interface FindEventQuery
{
    public function fetch(string $id): ?OmeEventDto;
}

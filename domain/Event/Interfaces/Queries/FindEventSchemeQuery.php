<?php

namespace Ome\Event\Interfaces\Queries;

use Ome\Event\Entities\EventScheme;

interface FindEventSchemeQuery
{
    public function fetch(int $id): ?EventScheme;
}

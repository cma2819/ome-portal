<?php

namespace Ome\Event\Interfaces\Queries;

use Ome\Event\Entities\OengusMarathon;

interface OengusMarathonQuery
{
    public function fetch(string $id): OengusMarathon;
}

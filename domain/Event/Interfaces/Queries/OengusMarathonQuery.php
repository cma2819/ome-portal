<?php

namespace Ome\Event\Interfaces\Queries;

use DateTimeInterface;
use Ome\Event\Entities\OengusMarathon;

interface OengusMarathonQuery
{
    public function fetch(string $id, DateTimeInterface $now): OengusMarathon;
}

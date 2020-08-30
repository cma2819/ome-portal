<?php

namespace Ome\Event\Entities;

use DateTimeInterface;

class PartialOengusMarathon extends OengusMarathon
{
    public static function createPartial(
        string $id,
        string $name,
        DateTimeInterface $startAt,
        DateTimeInterface $endAt
    ) {
        return new parent($id, $name, $startAt, $endAt);
    }
}

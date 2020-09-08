<?php

namespace Ome\Event\Entities;

use DateTimeInterface;
use Ome\Event\Values\MarathonStatus;

class PartialOengusMarathon extends OengusMarathon
{
    public static function createPartial(
        string $id,
        string $name,
        DateTimeInterface $startAt,
        DateTimeInterface $endAt,
        bool $submitsOpen,
        MarathonStatus $status
    ) {
        return new parent($id, $name, $startAt, $endAt, $submitsOpen, $status);
    }
}

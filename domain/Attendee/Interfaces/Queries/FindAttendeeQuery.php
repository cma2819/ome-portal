<?php

namespace Ome\Attendee\Interfaces\Queries;

use Ome\Attendee\Entities\Attendee;

interface FindAttendeeQuery
{
    public function fetch(string $eventId, int $userId): ?Attendee;
}

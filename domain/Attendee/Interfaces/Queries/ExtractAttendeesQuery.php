<?php

namespace Ome\Attendee\Interfaces\Queries;

use Ome\Attendee\Entities\Attendee;
use Ome\Attendee\Values\TaskScope;

interface ExtractAttendeesQuery
{
    /**
     * @param string $eventId
     * @param TaskScope[]|null $scopes
     * @return Attendee[]
     */
    public function fetch(string $eventId, ?array $scopes): array;
}

<?php

namespace Ome\Attendee\Interfaces\Queries;

interface ExtractAttendeesQuery
{
    /**
     * @param string $eventId
     * @param TaskScope[]|null $scopes
     * @return Attendee[]
     */
    public function fetch(string $eventId, ?array $scopes): array;
}

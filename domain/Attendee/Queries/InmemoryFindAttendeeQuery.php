<?php

namespace Ome\Attendee\Queries;

use Ome\Attendee\Entities\Attendee;
use Ome\Attendee\Interfaces\Queries\FindAttendeeQuery;

class InmemoryFindAttendeeQuery implements FindAttendeeQuery
{
    /** @var Attendee[] */
    private array $attendees;

    public function __construct(
        array $attendees
    ) {
        $this->attendees = $attendees;
    }

    public function fetch(string $eventId, int $userId): ?Attendee
    {
        foreach ($this->attendees as $attendee) {
            if ($attendee->getEventId() === $eventId && $attendee->getUserId() === $userId) {
                return $attendee;
            }
        }

        return null;
    }
}

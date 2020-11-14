<?php

namespace Ome\Attendee\Queries;

use Ome\Attendee\Entities\Attendee;
use Ome\Attendee\Interfaces\Queries\ExtractAttendeesQuery;

class InmemoryExtractAttendeesQuery implements ExtractAttendeesQuery
{
    /** @var Attendee[] */
    private array $attendees;

    public function __construct(
        array $attendees
    ) {
        $this->attendees = $attendees;
    }

    public function fetch(string $eventId, ?array $scopes): array
    {
        $result = [];

        foreach ($this->attendees as $attendee) {
            if ($attendee->getEventId() !== $eventId) {
                continue;
            }

            if (is_array($scopes)) {
                foreach ($attendee->getScopes() as $attendeeScope) {
                    foreach ($scopes as $scope) {
                        if ($attendeeScope->equalsTo($scope)) {
                            $result[] = $attendee;
                        }
                    }
                }
                continue;
            }

            $result[] = $attendee;
        }

        return $result;
    }
}

<?php

namespace Ome\Attendee\Interfaces\UseCases\ListAttendeesInEvent;

use Ome\Attendee\Entities\Attendee;

/**
 * Response object for ListAttendeesInEvent.
 */
class ListAttendeesInEventResponse
{
    /** @var Attendee[] */
    private array $attendees;

    public function __construct(
        array $attendees
    ) {
        $this->attendees = $attendees;
    }

    /**
     * Get the value of attendees
     */
    public function getAttendees()
    {
        return $this->attendees;
    }
}

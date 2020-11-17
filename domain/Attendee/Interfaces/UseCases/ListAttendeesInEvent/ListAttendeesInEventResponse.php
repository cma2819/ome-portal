<?php

namespace Ome\Attendee\Interfaces\UseCases\ListAttendeesInEvent;

use Ome\Attendee\Interfaces\Dto\AttendeeDto;

/**
 * Response object for ListAttendeesInEvent.
 */
class ListAttendeesInEventResponse
{
    /** @var AttendeeDto[] */
    private array $attendees;

    /**
     * @param AttendeeDto[] $attendees
     */
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

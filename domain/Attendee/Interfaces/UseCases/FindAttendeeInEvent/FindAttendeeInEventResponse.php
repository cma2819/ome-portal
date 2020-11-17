<?php

namespace Ome\Attendee\Interfaces\UseCases\FindAttendeeInEvent;

use Ome\Attendee\Interfaces\Dto\AttendeeDto;

/**
 * Response object for FindAttendeeInEvent.
 */
class FindAttendeeInEventResponse
{
    private ?AttendeeDto $attendee;

    public function __construct(
        ?AttendeeDto $attendee
    ) {
        $this->attendee = $attendee;
    }

    /**
     * Get the value of attendee
     */
    public function getAttendee()
    {
        return $this->attendee;
    }
}

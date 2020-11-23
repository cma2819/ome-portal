<?php

namespace Ome\Attendee\Interfaces\UseCases\RegisterAttendeeForEvent;

use Ome\Attendee\Interfaces\Dto\AttendeeDto;

/**
 * Response object for RegisterAttendeeForEvent.
 */
class RegisterAttendeeForEventResponse
{
    private AttendeeDto $attendee;

    public function __construct(
        AttendeeDto $attendee
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

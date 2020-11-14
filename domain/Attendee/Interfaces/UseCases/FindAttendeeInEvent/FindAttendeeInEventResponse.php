<?php

namespace Ome\Attendee\Interfaces\UseCases\FindAttendeeInEvent;

use Ome\Attendee\Entities\Attendee;

/**
 * Response object for FindAttendeeInEvent.
 */
class FindAttendeeInEventResponse
{
    private ?Attendee $attendee;

    public function __construct(
        ?Attendee $attendee
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

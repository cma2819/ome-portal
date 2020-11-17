<?php

namespace Ome\Attendee\Interfaces\Dto;

use Ome\Attendee\Entities\Attendee;
use Ome\Attendee\Entities\User;

class AttendeeDto
{
    private Attendee $attendee;

    private User $user;

    public function __construct(
        Attendee $attendee,
        User $user
    ) {
        $this->attendee = $attendee;
        $this->user = $user;
    }

    /**
     * Get the value of attendee
     */
    public function getAttendee()
    {
        return $this->attendee;
    }

    /**
     * Get the value of user
     */
    public function getUser()
    {
        return $this->user;
    }
}

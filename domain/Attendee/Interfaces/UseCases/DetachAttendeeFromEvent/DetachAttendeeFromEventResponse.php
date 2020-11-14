<?php

namespace Ome\Attendee\Interfaces\UseCases\DetachAttendeeFromEvent;

/**
 * Response object for DetachAttendeeFromEvent.
 */
class DetachAttendeeFromEventResponse
{
    private bool $result;

    public function __construct(
        bool $result
    ) {
        $this->result = $result;
    }

    /**
     * Get the value of result
     */
    public function getResult()
    {
        return $this->result;
    }
}

<?php

namespace Ome\Attendee\Interfaces\UseCases\DetachAttendeeFromEvent;

/**
 * Request object for DetachAttendeeFromEvent.
 */
class DetachAttendeeFromEventRequest
{
    private int $userId;

    private string $eventId;

    public function __construct(
        int $userId,
        string $eventId
    ) {
        $this->userId = $userId;
        $this->eventId = $eventId;
    }

    /**
     * Get the value of userId
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Get the value of eventId
     */
    public function getEventId()
    {
        return $this->eventId;
    }
}

<?php

namespace Ome\Attendee\Interfaces\UseCases\FindAttendeeInEvent;

/**
 * Request object for FindAttendeeInEvent.
 */
class FindAttendeeInEventRequest
{
    private string $eventId;

    private int $userId;

    public function __construct(
        string $eventId,
        int $userId
    ) {
        $this->eventId = $eventId;
        $this->userId = $userId;
    }

    /**
     * Get the value of eventId
     */
    public function getEventId()
    {
        return $this->eventId;
    }

    /**
     * Get the value of userId
     */
    public function getUserId()
    {
        return $this->userId;
    }
}

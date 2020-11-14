<?php

namespace Ome\Attendee\Commands;

use Ome\Attendee\Entities\Attendee;
use Ome\Attendee\Interfaces\Commands\DeleteAttendeeCommand;

class InmemoryDeleteAttendeeCommand implements DeleteAttendeeCommand
{

    /** @var Attendee[] */
    private array $attendees = [];

    public function __construct(
        array $attendees = []
    ) {
        $this->attendees = $attendees;
    }

    public function execute(int $userId, string $eventId): bool
    {
        foreach ($this->attendees as $index => $attendee) {
            if ($attendee->getUserId() === $userId && $attendee->getEventId() === $eventId) {
                unset($this->attendees[$index]);
                return true;
            }
        }

        return false;
    }

    /**
     * Get the value of attendees
     */
    public function getAttendees()
    {
        return $this->attendees;
    }
}

<?php

namespace Ome\Attendee\Commands;

use Ome\Attendee\Entities\Attendee;
use Ome\Attendee\Interfaces\Commands\PersistAttendeeCommand;

class InmemoryPersistAttendeeCommand implements PersistAttendeeCommand
{
    /** @var Attendee[] */
    private array $attendees = [];

    public function __construct(
        array $attendees = []
    ) {
        $this->attendees = $attendees;
    }

    public function execute(Attendee $attendee): Attendee
    {
        foreach ($this->attendees as $index => $exists) {
            if ($exists->getUserId() === $attendee->getUserId()
                && $exists->getEventId() === $attendee->getEventId()) {

                    $this->attendees[$index] = $attendee;
                    break;
            }
        }

        $this->attendees[] = $attendee;

        return $attendee;
    }

    /**
     * Get the value of attendees
     */
    public function getAttendees()
    {
        return $this->attendees;
    }
}

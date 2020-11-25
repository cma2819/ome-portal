<?php

namespace App\Infrastructure\Commands\Attendee;

use App\Infrastructure\Eloquents\EventAttendee;
use Ome\Attendee\Interfaces\Commands\DeleteAttendeeCommand;

class DbDeleteAttendeeCommand implements DeleteAttendeeCommand
{
    public function execute(int $userId, string $eventId): bool
    {
        return EventAttendee::query()
            ->where('user_id', '=', $userId)
            ->where('event_id', '=', $eventId)
            ->delete();
    }
}

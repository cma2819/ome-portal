<?php

namespace Ome\Attendee\Interfaces\Commands;

interface DeleteAttendeeCommand
{
    public function execute(int $userId, string $eventId): bool;
}

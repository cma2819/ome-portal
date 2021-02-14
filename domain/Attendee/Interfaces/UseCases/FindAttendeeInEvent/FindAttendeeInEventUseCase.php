<?php

namespace Ome\Attendee\Interfaces\UseCases\FindAttendeeInEvent;

/**
 * Find Attendee In Event.
 */
interface FindAttendeeInEventUseCase
{
    /**
     * Find Attendee In Event.
     */
    public function interact(FindAttendeeInEventRequest $request): FindAttendeeInEventResponse;
}

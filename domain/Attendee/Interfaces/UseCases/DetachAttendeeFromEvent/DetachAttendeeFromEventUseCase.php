<?php

namespace Ome\Attendee\Interfaces\UseCases\DetachAttendeeFromEvent;

/**
 * Detach Attendee From Event.
 */
interface DetachAttendeeFromEventUseCase
{
	/**
	 * Detach Attendee From Event.
	 */
	public function interact(DetachAttendeeFromEventRequest $request): DetachAttendeeFromEventResponse;
}

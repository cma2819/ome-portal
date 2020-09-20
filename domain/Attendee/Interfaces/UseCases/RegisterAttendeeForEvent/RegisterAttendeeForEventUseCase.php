<?php

namespace Ome\Attendee\Interfaces\UseCases\RegisterAttendeeForEvent;

/**
 * Register Attendee For Event.
 */
interface RegisterAttendeeForEventUseCase
{
	/**
	 * Register Attendee For Event.
	 */
	public function interact(RegisterAttendeeForEventRequest $request): RegisterAttendeeForEventResponse;
}

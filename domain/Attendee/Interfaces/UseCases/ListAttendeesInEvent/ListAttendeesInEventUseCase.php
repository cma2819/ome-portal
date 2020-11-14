<?php

namespace Ome\Attendee\Interfaces\UseCases\ListAttendeesInEvent;

/**
 * List Attendees In Event.
 */
interface ListAttendeesInEventUseCase
{
	/**
	 * List Attendees In Event.
	 */
	public function interact(ListAttendeesInEventRequest $request): ListAttendeesInEventResponse;
}

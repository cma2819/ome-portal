<?php

namespace Ome\Attendee\Interfaces\UseCases\CreateAttendeeTask;

/**
 * Create Attendee Task.
 */
interface CreateAttendeeTaskUseCase
{
	/**
	 * Create Attendee Task.
	 */
	public function interact(CreateAttendeeTaskRequest $request): CreateAttendeeTaskResponse;
}

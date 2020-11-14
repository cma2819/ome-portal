<?php

namespace Ome\Attendee\Interfaces\UseCases\ApplyAttendeeTask;

/**
 * Apply Attendee Task.
 */
interface ApplyAttendeeTaskUseCase
{
	/**
	 * Apply Attendee Task.
	 */
	public function interact(ApplyAttendeeTaskRequest $request): ApplyAttendeeTaskResponse;
}

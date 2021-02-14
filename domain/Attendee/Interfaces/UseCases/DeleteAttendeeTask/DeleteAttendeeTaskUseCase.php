<?php

namespace Ome\Attendee\Interfaces\UseCases\DeleteAttendeeTask;

/**
 * Delete Attendee Task.
 */
interface DeleteAttendeeTaskUseCase
{
    /**
     * Delete Attendee Task.
     */
    public function interact(DeleteAttendeeTaskRequest $request): DeleteAttendeeTaskResponse;
}

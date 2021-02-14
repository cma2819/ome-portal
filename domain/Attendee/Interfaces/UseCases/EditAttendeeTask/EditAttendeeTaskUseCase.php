<?php

namespace Ome\Attendee\Interfaces\UseCases\EditAttendeeTask;

/**
 * Edit Attendee Task.
 */
interface EditAttendeeTaskUseCase
{
    /**
     * Edit Attendee Task.
     */
    public function interact(EditAttendeeTaskRequest $request): EditAttendeeTaskResponse;
}

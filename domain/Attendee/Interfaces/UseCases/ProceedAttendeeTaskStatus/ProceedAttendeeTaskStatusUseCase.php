<?php

namespace Ome\Attendee\Interfaces\UseCases\ProceedAttendeeTaskStatus;

/**
 * Proceed Attendee Task Status.
 */
interface ProceedAttendeeTaskStatusUseCase
{
    /**
     * Proceed Attendee Task Status.
     */
    public function interact(ProceedAttendeeTaskStatusRequest $request): ProceedAttendeeTaskStatusResponse;
}

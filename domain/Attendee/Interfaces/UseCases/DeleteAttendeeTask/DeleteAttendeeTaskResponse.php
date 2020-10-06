<?php

namespace Ome\Attendee\Interfaces\UseCases\DeleteAttendeeTask;

/**
 * Response object for DeleteAttendeeTask.
 */
class DeleteAttendeeTaskResponse
{
    private bool $result;

    public function __construct(
        bool $result
    ) {
        $this->result = $result;
    }

    /**
     * Get the value of result
     */
    public function getResult()
    {
        return $this->result;
    }
}

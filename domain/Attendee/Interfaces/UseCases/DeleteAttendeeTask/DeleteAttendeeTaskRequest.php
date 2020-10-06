<?php

namespace Ome\Attendee\Interfaces\UseCases\DeleteAttendeeTask;

/**
 * Request object for DeleteAttendeeTask.
 */
class DeleteAttendeeTaskRequest
{
    private int $id;

    public function __construct(
        int $id
    ) {
        $this->id = $id;
    }

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }
}

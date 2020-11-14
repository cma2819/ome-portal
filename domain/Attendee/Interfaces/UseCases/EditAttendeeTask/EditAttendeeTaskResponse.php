<?php

namespace Ome\Attendee\Interfaces\UseCases\EditAttendeeTask;

use Ome\Attendee\Entities\Task;

/**
 * Response object for EditAttendeeTask.
 */
class EditAttendeeTaskResponse
{
    private Task $task;

    public function __construct(
        Task $task
    ) {
        $this->task = $task;
    }

    /**
     * Get the value of task
     */
    public function getTask()
    {
        return $this->task;
    }
}

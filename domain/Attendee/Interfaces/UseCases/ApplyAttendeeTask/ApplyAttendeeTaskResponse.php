<?php

namespace Ome\Attendee\Interfaces\UseCases\ApplyAttendeeTask;

use Ome\Attendee\Entities\TaskProgress;

/**
 * Response object for ApplyAttendeeTask.
 */
class ApplyAttendeeTaskResponse
{
    private TaskProgress $taskProgress;

    public function __construct(
        TaskProgress $taskProgress
    ) {
        $this->taskProgress = $taskProgress;
    }

    /**
     * Get the value of taskProgress
     */
    public function getTaskProgress()
    {
        return $this->taskProgress;
    }
}

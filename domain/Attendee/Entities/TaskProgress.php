<?php

namespace Ome\Attendee\Entities;

use Ome\Attendee\Values\ProgressStatus;

class TaskProgress
{

    protected ProgressStatus $scope;

    private int $taskId;

    private ProgressStatus $status;

    private string $note;

    protected function __construct(
        int $taskId,
        ProgressStatus $status,
        string $note
    ) {
        $this->taskId = $taskId;
        $this->status = $status;
        $this->note = $note;
    }

    public function createFromTask(
        Task $task,
        string $status,
        string $note = ''
    ) {
        return new self(
            $task->getId(),
            ProgressStatus::createFromValue($status),
            $note
        );
    }

    /**
     * Get the value of taskId
     */
    public function getTaskId()
    {
        return $this->taskId;
    }

    /**
     * Get the value of status
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Get the value of note
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * Get the value of scope
     */
    public function getScope()
    {
        return $this->scope;
    }
}

<?php

namespace Ome\Attendee\Entities;

use Ome\Attendee\Values\ProgressStatus;

abstract class TaskProgress
{
    protected string $scope;

    private int $userId;

    private int $taskId;

    private ProgressStatus $status;

    private string $note;

    protected function __construct(
        int $userId,
        int $taskId,
        ProgressStatus $status,
        string $note
    ) {
        $this->userId = $userId;
        $this->taskId = $taskId;
        $this->status = $status;
        $this->note = $note;
    }

    abstract public static function createFromTask(Task $task, int $userId, ProgressStatus $status, string $note = ''): self;

    public function hasSameIdentityWith(TaskProgress $opponent): bool
    {
        return (
            $this->scope === $opponent->getScope()
            && $this->taskId === $opponent->getTaskId()
            && $this->userId === $opponent->getUserId()
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

    /**
     * Get the value of userId
     */
    public function getUserId()
    {
        return $this->userId;
    }
}

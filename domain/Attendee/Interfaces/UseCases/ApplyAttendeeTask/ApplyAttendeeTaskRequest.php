<?php

namespace Ome\Attendee\Interfaces\UseCases\ApplyAttendeeTask;

/**
 * Request object for ApplyAttendeeTask.
 */
class ApplyAttendeeTaskRequest
{
    private string $scope;

    private int $taskId;

    private int $userId;

    private string $note;

    public function __construct(
        string $scope,
        int $taskId,
        int $userId,
        string $note
    ) {
        $this->scope = $scope;
        $this->taskId = $taskId;
        $this->userId = $userId;
        $this->note = $note;
    }

    /**
     * Get the value of scope
     */
    public function getScope()
    {
        return $this->scope;
    }

    /**
     * Get the value of note
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * Get the value of taskId
     */
    public function getTaskId()
    {
        return $this->taskId;
    }

    /**
     * Get the value of userId
     */
    public function getUserId()
    {
        return $this->userId;
    }
}

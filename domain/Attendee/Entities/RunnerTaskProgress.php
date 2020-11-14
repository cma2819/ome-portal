<?php

namespace Ome\Attendee\Entities;

use Ome\Attendee\Values\ProgressStatus;

class RunnerTaskProgress extends TaskProgress
{
    protected string $scope = 'runner';

    public static function createFromTask(
        Task $task,
        int $userId,
        ProgressStatus $status,
        string $note = ''
    ): self {
        return new self(
            $task->getId(),
            $userId,
            $status,
            $note
        );
    }

}

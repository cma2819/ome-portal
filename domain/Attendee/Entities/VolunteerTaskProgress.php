<?php

namespace Ome\Attendee\Entities;

use Ome\Attendee\Values\ProgressStatus;

class VolunteerTaskProgress extends TaskProgress
{
    protected string $scope = 'volunteer';

    public static function createFromTask(
        Task $task,
        int $userId,
        ProgressStatus $status,
        string $note = ''
    ): self {
        return new self(
            $userId,
            $task->getId(),
            $status,
            $note
        );
    }
}

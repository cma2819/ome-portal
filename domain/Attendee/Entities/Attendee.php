<?php

namespace Ome\Attendee\Entities;

use Ome\Attendee\Values\TaskScope;
use Ome\Exceptions\UnmatchedContextException;

class Attendee
{
    private int $userId;

    private string $eventId;

    /** @var TaskScope[] */
    private array $scopes;

    /** @var RunnerTaskProgress[] */
    private array $runnerTaskProgresses;

    /** @var CommentatorTaskProgress[] */
    private array $commentatorTaskProgresses;

    /** @var VolunteerTaskProgress[] */
    private array $volunteerTaskProgresses;

    protected function __construct(
        int $userId,
        string $eventId,
        array $scopes,
        array $runnerTaskProgresses = [],
        array $commentatorTaskProgresses = [],
        array $volunteerTaskProgresses = []
    ) {
        $this->userId = $userId;
        $this->eventId = $eventId;
        foreach ($scopes as $scope) {
            if (!($scope instanceof TaskScope)) {
                throw new UnmatchedContextException(self::class, "Attendee's scope must be instance of TaskScope.");
            }
        }
        $this->scopes = $scopes;
        $this->runnerTaskProgresses = $runnerTaskProgresses;
        $this->commentatorTaskProgresses = $commentatorTaskProgresses;
        $this->volunteerTaskProgresses = $volunteerTaskProgresses;
    }

    public static function create(
        int $userId,
        string $eventId,
        array $scopes,
        array $taskProgresses
    ): self {
        $runnerProgresses = [];
        $commentatorProgresses = [];
        $volunteerProgresses = [];

        foreach ($taskProgresses as $progress) {
            if ($progress instanceof RunnerTaskProgress) {
                $runnerProgresses[] = $progress;
                continue;
            }
            if ($progress instanceof CommentatorTaskProgress) {
                $commentatorProgresses[] = $progress;
                continue;
            }
            if ($progress instanceof VolunteerTaskProgress) {
                $volunteerProgresses[] = $progress;
            }
        }

        return new self(
            $userId,
            $eventId,
            $scopes,
            $runnerProgresses,
            $commentatorProgresses,
            $volunteerProgresses
        );
    }

    /**
     * Get the value of userId
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Get the value of eventId
     */
    public function getEventId()
    {
        return $this->eventId;
    }

    /**
     * Get the value of runnerTaskProgresses
     */
    public function getRunnerTaskProgresses()
    {
        return $this->runnerTaskProgresses;
    }

    /**
     * Get the value of commentatorTaskProgresses
     */
    public function getCommentatorTaskProgresses()
    {
        return $this->commentatorTaskProgresses;
    }

    /**
     * Get the value of volunteerTaskProgresses
     */
    public function getVolunteerTaskProgresses()
    {
        return $this->volunteerTaskProgresses;
    }


    /**
     * Get the value of scopes
     */
    public function getScopes()
    {
        return $this->scopes;
    }

    /**
     * Check if attendee is in scope.
     *
     * @param TaskScope $scope
     * @return boolean
     */
    public function isInScope(TaskScope $scope): bool {
        foreach ($this->scopes as $attendeeScope) {
            if ($attendeeScope->equalsTo($scope)) {
                return true;
            }
        }

        return false;
    }
}

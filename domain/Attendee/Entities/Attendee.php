<?php

namespace Ome\Attendee\Entities;

class Attendee
{
    private int $userId;

    private string $eventId;

    /** @var RunnerTaskProgress[] */
    private array $runnerTaskProgresses;

    /** @var CommentatorTaskProgress[] */
    private array $commentatorTaskProgresses;

    /** @var VolunteerTaskProgress[] */
    private array $volunteerTaskProgresses;

    protected function __construct(
        int $userId,
        string $eventId,
        array $runnerTaskProgresses = [],
        array $commentatorTaskProgresses = [],
        array $volunteerTaskProgresses = []
    ) {
        $this->userId = $userId;
        $this->eventId = $eventId;
        $this->runnerTaskProgresses = $runnerTaskProgresses;
        $this->commentatorTaskProgresses = $commentatorTaskProgresses;
        $this->volunteerTaskProgresses = $volunteerTaskProgresses;
    }

    public static function create(
        int $userId,
        string $eventId,
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

}

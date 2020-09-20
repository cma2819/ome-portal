<?php

namespace Ome\Attendee\Entities;

use Ome\Auth\Entities\User;
use Ome\Event\Entities\Event;

class Attendee
{
    private int $id;

    private string $eventId;

    /** @var RunnerTaskProgress[] */
    private array $runnerTaskProgresses;

    /** @var CommentatorTaskProgress[] */
    private array $commentatorTaskProgresses;

    /** @var VolunteerTaskProgress[] */
    private array $volunteerTaskProgresses;

    protected function __construct(
        int $id,
        string $eventId,
        array $runnerTaskProgresses = [],
        array $commentatorTaskProgresses = [],
        array $volunteerTaskProgresses = []
    ) {
        $this->id = $id;
        $this->eventId = $eventId;
        $this->runnerTaskProgresses = $runnerTaskProgresses;
        $this->commentatorTaskProgresses = $commentatorTaskProgresses;
        $this->volunteerTaskProgresses = $volunteerTaskProgresses;
    }

    public static function create(
        User $user,
        Event $event,
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
            $user->getId(),
            $event->getId(),
            $runnerProgresses,
            $commentatorProgresses,
            $volunteerProgresses
        );
    }

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
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

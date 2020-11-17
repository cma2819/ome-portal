<?php

namespace App\Http\Responses\Api\Events;

use JsonSerializable;
use Ome\Attendee\Interfaces\Dto\AttendeeDto;
use Ome\Attendee\Values\TaskScope;

class AttendeeResponse implements JsonSerializable
{
    private array $json;

    public function __construct(AttendeeDto $attendeeDto)
    {
        $jsonScopes = [];
        foreach ($attendeeDto->getAttendee()->getScopes() as $scope) {
            $jsonScopes[] = $scope->value();
        }

        $jsonTaskProgresses = [];

        if ($attendeeDto->getAttendee()->isInScope(TaskScope::runner())) {
            $jsonRunnerProgresses = [];
            foreach ($attendeeDto->getAttendee()->getRunnerTaskProgresses() as $progress) {
                $jsonRunnerProgresses[] = [
                    'taskId' => $progress->getTaskId(),
                    'status' => $progress->getStatus()->value(),
                    'note' => $progress->getNote(),
                ];
            }
            $jsonTaskProgresses['runner'] = $jsonRunnerProgresses;
        }

        if ($attendeeDto->getAttendee()->isInScope(TaskScope::commentator())) {
            $jsonCommentatorProgresses = [];
            foreach ($attendeeDto->getAttendee()->getCommentatorTaskProgresses() as $progress) {
                $jsonCommentatorProgresses[] = [
                    'taskId' => $progress->getTaskId(),
                    'status' => $progress->getStatus()->value(),
                    'note' => $progress->getNote(),
                ];
            }
            $jsonTaskProgresses['commentator'] = $jsonCommentatorProgresses;
        }

        if ($attendeeDto->getAttendee()->isInScope(TaskScope::volunteer())) {
            $jsonVolunteerProgresses = [];
            foreach ($attendeeDto->getAttendee()->getVolunteerTaskProgresses() as $progress) {
                $jsonVolunteerProgresses[] = [
                    'taskId' => $progress->getTaskId(),
                    'status' => $progress->getStatus()->value(),
                    'note' => $progress->getNote(),
                ];
            }
            $jsonTaskProgresses['volunteer'] = $jsonVolunteerProgresses;
        }

        $this->json = [
            'id' => $attendeeDto->getUser()->getId(),
            'username' => $attendeeDto->getUser()->getUsername(),
            'scopes' => $jsonScopes,
            'taskProgresses' => $jsonTaskProgresses,
        ];
    }

    public function jsonSerialize()
    {
        return $this->json;
    }
}

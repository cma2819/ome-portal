<?php

namespace App\Infrastructure\Queries\Attendee;

use App\Infrastructure\Eloquents\AssociateEvent;
use App\Infrastructure\Eloquents\AttendeeTask;
use App\Infrastructure\Eloquents\AttendeeTaskProgress;
use App\Infrastructure\Eloquents\EventAttendee;
use Illuminate\Support\Collection;
use Ome\Attendee\Entities\Attendee;
use Ome\Attendee\Entities\CommentatorTask;
use Ome\Attendee\Entities\CommentatorTaskProgress;
use Ome\Attendee\Entities\RunnerTask;
use Ome\Attendee\Entities\RunnerTaskProgress;
use Ome\Attendee\Entities\TaskProgress;
use Ome\Attendee\Entities\VolunteerTask;
use Ome\Attendee\Entities\VolunteerTaskProgress;
use Ome\Attendee\Interfaces\Queries\ExtractAttendeesQuery;
use Ome\Attendee\Values\ProgressStatus;
use Ome\Attendee\Values\TaskScope;

class DbExtractAttendeesQuery implements ExtractAttendeesQuery
{
    public function fetch(string $eventId, ?array $scopes): array
    {
        $eventEloquent = AssociateEvent::findOrFail($eventId, ['id']);

        $query = EventAttendee::query()->where('event_id', '=', $eventEloquent->id);

        if (is_array($scopes)) {
            $scopeValues = [];
            foreach ($scopes as $scope) {
                $scopeValues[] = $scope->value();
            }
            $query = $query->whereIn('attend_scope', $scopeValues);
        }

        $attendeeEloquents = $query->select(['id', 'user_id', 'event_id', 'attend_scope'])->get();
        $taskProgressEloquents = AttendeeTaskProgress::query()
            ->whereIn('event_attendee_id', $attendeeEloquents->pluck('id'))
            ->select(['event_attendee_id', 'task_id', 'note', 'progress_status'])
            ->get();
        $attendeeTaskEloquents = AttendeeTask::query()
            ->whereIn('id', $taskProgressEloquents->pluck('task_id'))
            ->select(['id', 'attendee_scope', 'content'])
            ->get();

        $attendeeEloquentsById = $attendeeEloquents->groupBy('user_id');
        return $attendeeEloquentsById->map(function (Collection $attendees) use ($attendeeTaskEloquents, $taskProgressEloquents) {
            $scopes = $attendees->pluck('attend_scope')->map(function (string $scope) {
                return TaskScope::createFromValue($scope);
            })->all();
            /** @var EventAttendee */
            $eloquent = $attendees->first();
            $progress = $taskProgressEloquents
                ->whereIn('event_attendee_id', $attendees->pluck('id'))
                ->map(function (AttendeeTaskProgress $taskProgress) use ($eloquent, $attendeeTaskEloquents) {
                    /** @var AttendeeTask */
                    $taskEloquent = $attendeeTaskEloquents->firstWhere('id', '=', $taskProgress->task_id);
                    switch ($taskEloquent->attendee_scope) {
                        case TaskScope::runner()->value():
                            $task = RunnerTask::createRegistered($taskEloquent->id, $taskEloquent->content);
                            return RunnerTaskProgress::createFromTask(
                                $task,
                                $eloquent->user_id,
                                ProgressStatus::createFromValue($taskProgress->progress_status),
                                $taskProgress->note
                            );
                        case TaskScope::commentator()->value():
                            $task = CommentatorTask::createRegistered($taskEloquent->id, $taskEloquent->content);
                            return CommentatorTaskProgress::createFromTask(
                                $task,
                                $eloquent->user_id,
                                ProgressStatus::createFromValue($taskProgress->progress_status),
                                $taskProgress->note
                            );
                        case TaskScope::volunteer()->value():
                            $task = VolunteerTask::createRegistered($taskEloquent->id, $taskEloquent->content);
                            return VolunteerTaskProgress::createFromTask(
                                $task,
                                $eloquent->user_id,
                                ProgressStatus::createFromValue($taskProgress->progress_status),
                                $taskProgress->note
                            );
                        default:
                            return null;
                    }
                })
                ->filter(function (?TaskProgress $taskProgress) {
                    return !is_null($taskProgress);
                })
                ->all();

            return Attendee::create($eloquent->user_id, $eloquent->event_id, $scopes, $progress);
        })->all();
    }
}

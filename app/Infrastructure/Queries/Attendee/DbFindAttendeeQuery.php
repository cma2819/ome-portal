<?php

namespace App\Infrastructure\Queries\Attendee;

use App\Infrastructure\Eloquents\AssociateEvent;
use App\Infrastructure\Eloquents\AttendeeTask;
use App\Infrastructure\Eloquents\AttendeeTaskProgress;
use App\Infrastructure\Eloquents\EventAttendee;
use Ome\Attendee\Entities\Attendee;
use Ome\Attendee\Entities\CommentatorTask;
use Ome\Attendee\Entities\CommentatorTaskProgress;
use Ome\Attendee\Entities\RunnerTask;
use Ome\Attendee\Entities\RunnerTaskProgress;
use Ome\Attendee\Entities\TaskProgress;
use Ome\Attendee\Entities\VolunteerTask;
use Ome\Attendee\Entities\VolunteerTaskProgress;
use Ome\Attendee\Interfaces\Queries\FindAttendeeQuery;
use Ome\Attendee\Values\ProgressStatus;
use Ome\Attendee\Values\TaskScope;

class DbFindAttendeeQuery implements FindAttendeeQuery
{
    public function fetch(string $eventId, int $userId): ?Attendee
    {
        $eventEloquent = AssociateEvent::findOrFail($eventId, ['id']);

        $attendeeEloquents = EventAttendee::query()
            ->where('user_id', '=', $userId)
            ->where('event_id', '=', $eventEloquent->id)
            ->select(['id', 'user_id', 'event_id', 'attend_scope'])
            ->get();

        $taskProgressEloquents = AttendeeTaskProgress::query()
            ->whereIn('event_attendee_id', $attendeeEloquents->pluck('id'))
            ->select(['event_attendee_id', 'task_id', 'note', 'progress_status'])
            ->get();
        $attendeeTaskEloquents = AttendeeTask::query()
            ->whereIn('id', $taskProgressEloquents->pluck('task_id'))
            ->select(['id', 'attendee_scope', 'content'])
            ->get();

        $scopes = $attendeeEloquents->pluck('attend_scope')->map(function (string $attendeeScope) {
            return TaskScope::createFromValue($attendeeScope);
        })->all();

        /** @var EventAttendee */
        $eloquent = $attendeeEloquents->first();
        $progress = $taskProgressEloquents
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
    }
}

<?php

namespace Ome\Attendee\UseCases;

use LogicException;
use Ome\Attendee\Entities\CommentatorTaskProgress;
use Ome\Attendee\Entities\RunnerTaskProgress;
use Ome\Attendee\Entities\VolunteerTaskProgress;
use Ome\Attendee\Interfaces\Commands\PersistTaskProgressCommand;
use Ome\Attendee\Interfaces\Queries\FindAttendeeTaskQuery;
use Ome\Attendee\Interfaces\UseCases\ApplyAttendeeTask\ApplyAttendeeTaskRequest;
use Ome\Attendee\Interfaces\UseCases\ApplyAttendeeTask\ApplyAttendeeTaskResponse;
use Ome\Attendee\Interfaces\UseCases\ApplyAttendeeTask\ApplyAttendeeTaskUseCase;
use Ome\Attendee\Values\ProgressStatus;
use Ome\Attendee\Values\TaskScope;

class ApplyAttendeeTaskInteractor implements ApplyAttendeeTaskUseCase
{
    protected FindAttendeeTaskQuery $findAttendeeTaskQuery;

    protected PersistTaskProgressCommand $persistTaskProgressCommand;

    public function __construct(
        FindAttendeeTaskQuery $findAttendeeTaskQuery,
        PersistTaskProgressCommand $persistTaskProgressCommand
    ) {
        $this->findAttendeeTaskQuery = $findAttendeeTaskQuery;
        $this->persistTaskProgressCommand = $persistTaskProgressCommand;
    }

    public function interact(ApplyAttendeeTaskRequest $request): ApplyAttendeeTaskResponse
    {
        $scope = TaskScope::createFromValue($request->getScope());
        $task = $this->findAttendeeTaskQuery->fetch($scope, $request->getTaskId());
        $taskProgress = null;

        if ($scope->equalsTo(TaskScope::runner())) {
            $taskProgress = RunnerTaskProgress::createFromTask(
                $task,
                $request->getUserId(),
                ProgressStatus::apply(),
                $request->getNote()
            );
        }

        if ($scope->equalsTo(TaskScope::commentator())) {
            $taskProgress = CommentatorTaskProgress::createFromTask(
                $task,
                $request->getUserId(),
                ProgressStatus::apply(),
                $request->getNote()
            );
        }

        if ($scope->equalsTo(TaskScope::volunteer())) {
            $taskProgress = VolunteerTaskProgress::createFromTask(
                $task,
                $request->getUserId(),
                ProgressStatus::apply(),
                $request->getNote()
            );
        }

        if (is_null($taskProgress)) {
            throw new LogicException('Received TaskScope ' . $scope->value() . ' is unknown in ApplyAttendeeTaskInteractor.');
        }

        return new ApplyAttendeeTaskResponse(
            $this->persistTaskProgressCommand->execute($taskProgress)
        );
    }
}

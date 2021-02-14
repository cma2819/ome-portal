<?php

namespace Ome\Attendee\UseCases;

use LogicException;
use Ome\Attendee\Entities\CommentatorTaskProgress;
use Ome\Attendee\Entities\RunnerTaskProgress;
use Ome\Attendee\Entities\VolunteerTaskProgress;
use Ome\Attendee\Interfaces\Commands\PersistTaskProgressCommand;
use Ome\Attendee\Interfaces\Queries\FindAttendeeTaskQuery;
use Ome\Attendee\Interfaces\UseCases\ProceedAttendeeTaskStatus\ProceedAttendeeTaskStatusRequest;
use Ome\Attendee\Interfaces\UseCases\ProceedAttendeeTaskStatus\ProceedAttendeeTaskStatusResponse;
use Ome\Attendee\Interfaces\UseCases\ProceedAttendeeTaskStatus\ProceedAttendeeTaskStatusUseCase;
use Ome\Attendee\Values\TaskScope;

class ProceedAttendeeTaskStatusInteractor implements ProceedAttendeeTaskStatusUseCase
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

    public function interact(ProceedAttendeeTaskStatusRequest $request): ProceedAttendeeTaskStatusResponse
    {
        $scope = TaskScope::createFromValue($request->getScope());
        $task = $this->findAttendeeTaskQuery->fetch($scope, $request->getTaskId());
        $taskProgress = null;
        $status = $request->getStatus();

        if ($scope->equalsTo(TaskScope::runner())) {
            $taskProgress = RunnerTaskProgress::createFromTask(
                $task,
                $request->getUserId(),
                $status,
                $request->getNote()
            );
        }

        if ($scope->equalsTo(TaskScope::commentator())) {
            $taskProgress = CommentatorTaskProgress::createFromTask(
                $task,
                $request->getUserId(),
                $status,
                $request->getNote()
            );
        }

        if ($scope->equalsTo(TaskScope::volunteer())) {
            $taskProgress = VolunteerTaskProgress::createFromTask(
                $task,
                $request->getUserId(),
                $status,
                $request->getNote()
            );
        }

        if (is_null($taskProgress)) {
            throw new LogicException('Received TaskScope ' . $scope->value() . ' is unknown in ProceedAttendeeTaskStatusInteractor.');
        }

        return new ProceedAttendeeTaskStatusResponse(
            $this->persistTaskProgressCommand->execute($taskProgress)
        );
    }
}

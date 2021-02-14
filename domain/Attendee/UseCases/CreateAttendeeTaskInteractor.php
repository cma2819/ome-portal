<?php

namespace Ome\Attendee\UseCases;

use Ome\Attendee\Entities\CommentatorTask;
use Ome\Attendee\Entities\RunnerTask;
use Ome\Attendee\Entities\VolunteerTask;
use Ome\Attendee\Interfaces\Commands\PersistTaskCommand;
use Ome\Attendee\Interfaces\UseCases\CreateAttendeeTask\CreateAttendeeTaskRequest;
use Ome\Attendee\Interfaces\UseCases\CreateAttendeeTask\CreateAttendeeTaskResponse;
use Ome\Attendee\Interfaces\UseCases\CreateAttendeeTask\CreateAttendeeTaskUseCase;
use Ome\Attendee\Values\TaskScope;

class CreateAttendeeTaskInteractor implements CreateAttendeeTaskUseCase
{
    protected PersistTaskCommand $persistTaskCommand;

    public function __construct(
        PersistTaskCommand $persistTaskCommand
    ) {
        $this->persistTaskCommand = $persistTaskCommand;
    }

    public function interact(CreateAttendeeTaskRequest $request): CreateAttendeeTaskResponse
    {
        if ($request->getScope()->equalsTo(TaskScope::runner())) {
            $task = RunnerTask::createNewTask($request->getContent());
        }
        if ($request->getScope()->equalsTo(TaskScope::commentator())) {
            $task = CommentatorTask::createNewTask($request->getContent());
        }
        if ($request->getScope()->equalsTo(TaskScope::volunteer())) {
            $task = VolunteerTask::createNewTask($request->getContent());
        }

        return new CreateAttendeeTaskResponse(
            $this->persistTaskCommand->execute($task)
        );
    }
}

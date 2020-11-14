<?php

namespace Ome\Attendee\UseCases;

use Ome\Attendee\Interfaces\Commands\PersistTaskCommand;
use Ome\Attendee\Interfaces\Queries\FindAttendeeTaskQuery;
use Ome\Attendee\Interfaces\UseCases\EditAttendeeTask\EditAttendeeTaskRequest;
use Ome\Attendee\Interfaces\UseCases\EditAttendeeTask\EditAttendeeTaskResponse;
use Ome\Attendee\Interfaces\UseCases\EditAttendeeTask\EditAttendeeTaskUseCase;

class EditAttendeeTaskInteractor implements EditAttendeeTaskUseCase
{
    protected FindAttendeeTaskQuery $findAttendeeTaskQuery;

    protected PersistTaskCommand $persistTaskCommand;

    public function __construct(
        FindAttendeeTaskQuery $findAttendeeTaskQuery,
        PersistTaskCommand $persistTaskCommand
    ) {
        $this->findAttendeeTaskQuery = $findAttendeeTaskQuery;
        $this->persistTaskCommand = $persistTaskCommand;
    }

    public function interact(EditAttendeeTaskRequest $request): EditAttendeeTaskResponse
    {
        $task = $this->findAttendeeTaskQuery->fetch(
            $request->getScope(),
            $request->getId()
        );

        $task->edit($request->getContent());
        return new EditAttendeeTaskResponse($this->persistTaskCommand->execute($task));
    }
}

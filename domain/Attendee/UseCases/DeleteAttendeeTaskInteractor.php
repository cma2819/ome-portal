<?php

namespace Ome\Attendee\UseCases;

use Ome\Attendee\Interfaces\Commands\DeleteTaskCommand;
use Ome\Attendee\Interfaces\UseCases\DeleteAttendeeTask\DeleteAttendeeTaskRequest;
use Ome\Attendee\Interfaces\UseCases\DeleteAttendeeTask\DeleteAttendeeTaskResponse;
use Ome\Attendee\Interfaces\UseCases\DeleteAttendeeTask\DeleteAttendeeTaskUseCase;

class DeleteAttendeeTaskInteractor implements DeleteAttendeeTaskUseCase
{
    protected DeleteTaskCommand $deleteTaskCommand;

    public function __construct(
        DeleteTaskCommand $deleteTaskCommand
    ) {
        $this->deleteTaskCommand = $deleteTaskCommand;
    }

    public function interact(DeleteAttendeeTaskRequest $request): DeleteAttendeeTaskResponse
    {
        return new DeleteAttendeeTaskResponse(
            $this->deleteTaskCommand->execute($request->getId())
        );
    }
}

<?php

namespace Ome\Attendee\UseCases;

use Ome\Attendee\Interfaces\Commands\DeleteAttendeeCommand;
use Ome\Attendee\Interfaces\UseCases\DetachAttendeeFromEvent\DetachAttendeeFromEventRequest;
use Ome\Attendee\Interfaces\UseCases\DetachAttendeeFromEvent\DetachAttendeeFromEventResponse;
use Ome\Attendee\Interfaces\UseCases\DetachAttendeeFromEvent\DetachAttendeeFromEventUseCase;

class DetachAttendeeFromEventInteractor implements DetachAttendeeFromEventUseCase
{

    protected DeleteAttendeeCommand $deleteAttendeeCommand;

    public function __construct(
        DeleteAttendeeCommand $deleteAttendeeCommand
    ) {
        $this->deleteAttendeeCommand = $deleteAttendeeCommand;
    }

    public function interact(DetachAttendeeFromEventRequest $request): DetachAttendeeFromEventResponse
    {
        $result = $this->deleteAttendeeCommand->execute(
            $request->getUserId(),
            $request->getEventId()
        );

        return new DetachAttendeeFromEventResponse($result);
    }
}

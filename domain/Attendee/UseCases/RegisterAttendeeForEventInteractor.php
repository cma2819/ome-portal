<?php

namespace Ome\Attendee\UseCases;

use Ome\Attendee\Entities\Attendee;
use Ome\Attendee\Interfaces\Commands\PersistAttendeeCommand;
use Ome\Attendee\Interfaces\UseCases\RegisterAttendeeForEvent\RegisterAttendeeForEventRequest;
use Ome\Attendee\Interfaces\UseCases\RegisterAttendeeForEvent\RegisterAttendeeForEventResponse;
use Ome\Attendee\Interfaces\UseCases\RegisterAttendeeForEvent\RegisterAttendeeForEventUseCase;

class RegisterAttendeeForEventInteractor implements RegisterAttendeeForEventUseCase
{

    protected PersistAttendeeCommand $persistAttendee;

    public function __construct(
        PersistAttendeeCommand $persistAttendee
    ) {
        $this->persistAttendee = $persistAttendee;
    }

    public function interact(RegisterAttendeeForEventRequest $request): RegisterAttendeeForEventResponse
    {
        $attendee = Attendee::create(
            $request->getUserId(),
            $request->getEventId(),
            []
        );

        $result = $this->persistAttendee->execute($attendee);

        return new RegisterAttendeeForEventResponse($result);
    }
}

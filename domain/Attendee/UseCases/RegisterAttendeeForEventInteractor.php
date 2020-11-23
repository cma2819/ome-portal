<?php

namespace Ome\Attendee\UseCases;

use Ome\Attendee\Entities\Attendee;
use Ome\Attendee\Interfaces\Commands\PersistAttendeeCommand;
use Ome\Attendee\Interfaces\Dto\AttendeeDto;
use Ome\Attendee\Interfaces\Queries\FindUserByIdQuery;
use Ome\Attendee\Interfaces\UseCases\RegisterAttendeeForEvent\RegisterAttendeeForEventRequest;
use Ome\Attendee\Interfaces\UseCases\RegisterAttendeeForEvent\RegisterAttendeeForEventResponse;
use Ome\Attendee\Interfaces\UseCases\RegisterAttendeeForEvent\RegisterAttendeeForEventUseCase;
use Ome\Exceptions\EntityNotFoundException;

class RegisterAttendeeForEventInteractor implements RegisterAttendeeForEventUseCase
{

    protected PersistAttendeeCommand $persistAttendee;

    protected FindUserByIdQuery $findUserById;

    public function __construct(
        PersistAttendeeCommand $persistAttendee,
        FindUserByIdQuery $findUserById
    ) {
        $this->persistAttendee = $persistAttendee;
        $this->findUserById = $findUserById;
    }

    public function interact(RegisterAttendeeForEventRequest $request): RegisterAttendeeForEventResponse
    {
        $user = $this->findUserById->fetch($request->getUserId());
        if (is_null($user)) {
            throw new EntityNotFoundException(self::class, [
                'userId' => $request->getUserId(),
            ]);
        }

        $attendee = Attendee::create(
            $request->getUserId(),
            $request->getEventId(),
            $request->getScopes(),
            []
        );

        $result = $this->persistAttendee->execute($attendee);

        return new RegisterAttendeeForEventResponse(
            new AttendeeDto($result, $user)
        );
    }
}

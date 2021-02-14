<?php

namespace Ome\Attendee\UseCases;

use Ome\Attendee\Interfaces\Dto\AttendeeDto;
use Ome\Attendee\Interfaces\Queries\FindAttendeeQuery;
use Ome\Attendee\Interfaces\Queries\FindUserByIdQuery;
use Ome\Attendee\Interfaces\UseCases\FindAttendeeInEvent\FindAttendeeInEventRequest;
use Ome\Attendee\Interfaces\UseCases\FindAttendeeInEvent\FindAttendeeInEventResponse;
use Ome\Attendee\Interfaces\UseCases\FindAttendeeInEvent\FindAttendeeInEventUseCase;

class FindAttendeeInEventInteractor implements FindAttendeeInEventUseCase
{
    protected FindAttendeeQuery $findAttendeeQuery;

    protected FindUserByIdQuery $findUserByIdQuery;

    public function __construct(
        FindAttendeeQuery $findAttendeeQuery,
        FindUserByIdQuery $findUserByIdQuery
    ) {
        $this->findAttendeeQuery = $findAttendeeQuery;
        $this->findUserByIdQuery = $findUserByIdQuery;
    }

    public function interact(FindAttendeeInEventRequest $request): FindAttendeeInEventResponse
    {
        $user = $this->findUserByIdQuery->fetch($request->getUserId());
        if (is_null($user)) {
            return new FindAttendeeInEventResponse(null);
        }

        $attendee = $this->findAttendeeQuery->fetch(
            $request->getEventId(),
            $request->getUserId()
        );

        if (is_null($attendee)) {
            return new FindAttendeeInEventResponse(null);
        }

        return new FindAttendeeInEventResponse(
            new AttendeeDto($attendee, $user)
        );
    }
}

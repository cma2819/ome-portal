<?php

namespace Ome\Attendee\UseCases;

use Ome\Attendee\Interfaces\Queries\FindAttendeeQuery;
use Ome\Attendee\Interfaces\UseCases\FindAttendeeInEvent\FindAttendeeInEventRequest;
use Ome\Attendee\Interfaces\UseCases\FindAttendeeInEvent\FindAttendeeInEventResponse;
use Ome\Attendee\Interfaces\UseCases\FindAttendeeInEvent\FindAttendeeInEventUseCase;

class FindAttendeeInEventInteractor implements FindAttendeeInEventUseCase
{
    protected FindAttendeeQuery $findAttendeeQuery;

    public function __construct(
        FindAttendeeQuery $findAttendeeQuery
    ) {
        $this->findAttendeeQuery = $findAttendeeQuery;
    }

    public function interact(FindAttendeeInEventRequest $request): FindAttendeeInEventResponse
    {
        return new FindAttendeeInEventResponse(
            $this->findAttendeeQuery->fetch(
                $request->getEventId(),
                $request->getUserId()
            )
        );
    }
}

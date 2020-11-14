<?php

namespace Ome\Attendee\UseCases;

use Ome\Attendee\Interfaces\Queries\ExtractAttendeesQuery;
use Ome\Attendee\Interfaces\UseCases\ListAttendeesInEvent\ListAttendeesInEventRequest;
use Ome\Attendee\Interfaces\UseCases\ListAttendeesInEvent\ListAttendeesInEventResponse;
use Ome\Attendee\Interfaces\UseCases\ListAttendeesInEvent\ListAttendeesInEventUseCase;

class ListAttendeesInEventInteractor implements ListAttendeesInEventUseCase
{
    protected ExtractAttendeesQuery $extractAttendeesQuery;

    public function __construct(
        ExtractAttendeesQuery $extractAttendeesQuery
    ) {
        $this->extractAttendeesQuery = $extractAttendeesQuery;
    }

    public function interact(ListAttendeesInEventRequest $request): ListAttendeesInEventResponse
    {
        return new ListAttendeesInEventResponse($this->extractAttendeesQuery->fetch(
            $request->getEventId(),
            $request->getScopes()
        ));
    }
}

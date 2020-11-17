<?php

namespace Ome\Attendee\UseCases;

use Ome\Attendee\Interfaces\Dto\AttendeeDto;
use Ome\Attendee\Interfaces\Queries\ExtractAttendeesQuery;
use Ome\Attendee\Interfaces\Queries\ExtractUsersByIdQuery;
use Ome\Attendee\Interfaces\UseCases\ListAttendeesInEvent\ListAttendeesInEventRequest;
use Ome\Attendee\Interfaces\UseCases\ListAttendeesInEvent\ListAttendeesInEventResponse;
use Ome\Attendee\Interfaces\UseCases\ListAttendeesInEvent\ListAttendeesInEventUseCase;

class ListAttendeesInEventInteractor implements ListAttendeesInEventUseCase
{
    protected ExtractAttendeesQuery $extractAttendeesQuery;

    protected ExtractUsersByIdQuery $extractUsersQuery;

    public function __construct(
        ExtractAttendeesQuery $extractAttendeesQuery,
        ExtractUsersByIdQuery $extractUsersQuery
    ) {
        $this->extractAttendeesQuery = $extractAttendeesQuery;
        $this->extractUsersQuery = $extractUsersQuery;
    }

    public function interact(ListAttendeesInEventRequest $request): ListAttendeesInEventResponse
    {
        $attendees = $this->extractAttendeesQuery->fetch(
            $request->getEventId(),
            $request->getScopes()
        );

        $userIdList = [];
        foreach ($attendees as $attendee) {
            $userIdList[] = $attendee->getUserId();
        }

        $users = $this->extractUsersQuery->fetch($userIdList);

        $attendeeDto = [];
        foreach ($attendees as $attendee) {
            foreach ($users as $user) {
                if ($attendee->getUserId() === $user->getId()) {
                    $attendeeDto[] = new AttendeeDto(
                        $attendee,
                        $user
                    );
                    break;
                }
            }
        }

        return new ListAttendeesInEventResponse($attendeeDto);
    }
}

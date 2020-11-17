<?php

namespace Tests\Unit\Domain\Attendee;

use Ome\Attendee\Entities\Attendee;
use Ome\Attendee\Entities\User;
use Ome\Attendee\Interfaces\Dto\AttendeeDto;
use Ome\Attendee\Interfaces\UseCases\ListAttendeesInEvent\ListAttendeesInEventRequest;
use Ome\Attendee\Queries\InmemoryExtractAttendeesQuery;
use Ome\Attendee\Queries\InmemoryExtractUsersByIdQuery;
use Ome\Attendee\UseCases\ListAttendeesInEventInteractor;
use Ome\Attendee\Values\TaskScope;
use PHPUnit\Framework\TestCase;

class ListAttendeesInEventInteractorTest extends TestCase
{
    /** @test */
    public function testListAttendeesInEvent()
    {
        $attendees = [
            Attendee::create(1, 'rtamarathon', [TaskScope::runner()], []),
            Attendee::create(2, 'rtamarathon', [TaskScope::commentator()], []),
        ];
        $users = [
            User::create(1, 'superman'),
            User::create(2, 'ultraman'),
        ];

        $inmemoryExtractAttendeeQuery = new InmemoryExtractAttendeesQuery($attendees);
        $inmemoryExtractUsersQuery = new InmemoryExtractUsersByIdQuery($users);

        $interactor = new ListAttendeesInEventInteractor(
            $inmemoryExtractAttendeeQuery,
            $inmemoryExtractUsersQuery
        );

        $response = $interactor->interact(
            new ListAttendeesInEventRequest('rtamarathon', ['runner'])
        );

        $this->assertContainsEquals(
            new AttendeeDto($attendees[0], $users[0]),
            $response->getAttendees()
        );
        $this->assertNotContainsEquals(
            new AttendeeDto($attendees[1], $users[1]),
            $response->getAttendees()
        );
    }

}

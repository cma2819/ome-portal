<?php

namespace Tests\Unit\Domain\Attendee;

use Ome\Attendee\Entities\Attendee;
use Ome\Attendee\Entities\User;
use Ome\Attendee\Interfaces\Dto\AttendeeDto;
use Ome\Attendee\Interfaces\UseCases\FindAttendeeInEvent\FindAttendeeInEventRequest;
use Ome\Attendee\Queries\InmemoryFindAttendeeQuery;
use Ome\Attendee\Queries\InmemoryFindUserByIdQuery;
use Ome\Attendee\UseCases\FindAttendeeInEventInteractor;
use Ome\Attendee\Values\TaskScope;
use PHPUnit\Framework\TestCase;

class FindAttendeeInEventInteractorTest extends TestCase
{
    /** @test */
    public function testFindAttendeeInEvent()
    {
        $attendees = [
            Attendee::create(1, 'rtamarathon', [TaskScope::runner()], []),
            Attendee::create(2, 'rtamarathon', [TaskScope::runner()], []),
        ];

        $users = [
            User::create(1, 'superman')
        ];

        $inmemoryFindAttendeeQuery = new InmemoryFindAttendeeQuery($attendees);
        $inmemoryFindUserByIdQuery = new InmemoryFindUserByIdQuery($users);

        $interactor = new FindAttendeeInEventInteractor(
            $inmemoryFindAttendeeQuery,
            $inmemoryFindUserByIdQuery
        );

        $response = $interactor->interact(
            new FindAttendeeInEventRequest('rtamarathon', 1)
        );

        $this->assertEquals(
            new AttendeeDto(
                Attendee::create(1, 'rtamarathon', [TaskScope::runner()], []),
                User::create(1, 'superman')
            ),
            $response->getAttendee()
        );
    }
}

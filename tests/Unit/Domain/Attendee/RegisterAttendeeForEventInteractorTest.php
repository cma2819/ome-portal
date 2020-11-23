<?php

namespace Tests\Unit\Domain\Attendee;

use Ome\Attendee\Commands\InmemoryPersistAttendeeCommand;
use Ome\Attendee\Entities\Attendee;
use Ome\Attendee\Entities\User;
use Ome\Attendee\Interfaces\Dto\AttendeeDto;
use Ome\Attendee\Interfaces\UseCases\RegisterAttendeeForEvent\RegisterAttendeeForEventRequest;
use Ome\Attendee\Queries\InmemoryFindUserByIdQuery;
use Ome\Attendee\UseCases\RegisterAttendeeForEventInteractor;
use Ome\Attendee\Values\TaskScope;
use PHPUnit\Framework\TestCase;

class RegisterAttendeeForEventInteractorTest extends TestCase
{

    /** @test */
    public function testRegisterAttendeeForEvent()
    {
        $inmemoryPersistAttendee = new InmemoryPersistAttendeeCommand();
        $inmemoryFindUser = new InmemoryFindUserByIdQuery([
            User::create(1, 'username')
        ]);
        $registerAttendeeInteractor = new RegisterAttendeeForEventInteractor(
            $inmemoryPersistAttendee,
            $inmemoryFindUser
        );

        $response = $registerAttendeeInteractor->interact(
            new RegisterAttendeeForEventRequest(1, 1, ['runner'])
        );

        $expectAttendee = Attendee::create(1, '1', [TaskScope::runner()], []);
        $expectAttendeeDto = new AttendeeDto(
            $expectAttendee,
            User::create(1, 'username')
        );

        $this->assertEquals($expectAttendeeDto, $response->getAttendee());
        $this->assertContainsEquals($expectAttendee, $inmemoryPersistAttendee->getAttendees());
    }

}

<?php

namespace Tests\Unit\Domain\Attendee;

use Ome\Attendee\Commands\InmemoryPersistAttendeeCommand;
use Ome\Attendee\Entities\Attendee;
use Ome\Attendee\Interfaces\UseCases\RegisterAttendeeForEvent\RegisterAttendeeForEventRequest;
use Ome\Attendee\UseCases\RegisterAttendeeForEventInteractor;
use PHPUnit\Framework\TestCase;

class RegisterAttendeeForEventInteractorTest extends TestCase
{

    /** @test */
    public function testRegisterAttendeeForEvent()
    {
        $inmemoryPersistAttendee = new InmemoryPersistAttendeeCommand();
        $registerAttendeeInteractor = new RegisterAttendeeForEventInteractor($inmemoryPersistAttendee);

        $response = $registerAttendeeInteractor->interact(
            new RegisterAttendeeForEventRequest(1, 1)
        );

        $expectAttendee = Attendee::create(1, '1', []);

        $this->assertEquals($expectAttendee, $response->getAttendee());
        $this->assertContainsEquals($expectAttendee, $inmemoryPersistAttendee->getAttendees());
    }

}

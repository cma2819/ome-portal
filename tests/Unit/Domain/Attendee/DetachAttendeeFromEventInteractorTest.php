<?php

namespace Tests\Unit\Domain\Attendee;

use Ome\Attendee\Commands\InmemoryDeleteAttendeeCommand;
use Ome\Attendee\Entities\Attendee;
use Ome\Attendee\Interfaces\UseCases\DetachAttendeeFromEvent\DetachAttendeeFromEventRequest;
use Ome\Attendee\UseCases\DetachAttendeeFromEventInteractor;
use PHPUnit\Framework\TestCase;

class DetachAttendeeFromEventInteractorTest extends TestCase
{
    /** @test */
    public function testDetachAttendeeFromEvent()
    {
        $inmemoryDeleteAttendee = new InmemoryDeleteAttendeeCommand([
            Attendee::create(1, 1, [])
        ]);

        $detachAttendeeInteractor = new DetachAttendeeFromEventInteractor($inmemoryDeleteAttendee);

        $response = $detachAttendeeInteractor->interact(
            new DetachAttendeeFromEventRequest(1, 1)
        );

        $this->assertTrue($response->getResult());
        $this->assertEmpty($inmemoryDeleteAttendee->getAttendees());
    }

}

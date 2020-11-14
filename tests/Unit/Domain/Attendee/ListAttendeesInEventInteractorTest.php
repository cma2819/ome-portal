<?php

namespace Tests\Unit\Domain\Attendee;

use Ome\Attendee\Entities\Attendee;
use Ome\Attendee\Interfaces\UseCases\ListAttendeesInEvent\ListAttendeesInEventRequest;
use Ome\Attendee\Queries\InmemoryExtractAttendeesQuery;
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

        $inmemoryExtractAttendeeQuery = new InmemoryExtractAttendeesQuery($attendees);

        $interactor = new ListAttendeesInEventInteractor($inmemoryExtractAttendeeQuery);

        $response = $interactor->interact(
            new ListAttendeesInEventRequest('rtamarathon', ['runner'])
        );

        $this->assertContainsEquals(
            Attendee::create(1, 'rtamarathon', [TaskScope::runner()], []),
            $response->getAttendees()
        );
        $this->assertNotContainsEquals(
            Attendee::create(2, 'rtamarathon', [TaskScope::commentator()], []),
            $response->getAttendees()
        );
    }

}

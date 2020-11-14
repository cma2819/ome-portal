<?php

namespace Tests\Unit\Domain\Attendee;

use Ome\Attendee\Entities\Attendee;
use Ome\Attendee\Interfaces\UseCases\FindAttendeeInEvent\FindAttendeeInEventRequest;
use Ome\Attendee\Queries\InmemoryFindAttendeeQuery;
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

        $inmemoryFindAttendeeQuery = new InmemoryFindAttendeeQuery($attendees);

        $interactor = new FindAttendeeInEventInteractor(
            $inmemoryFindAttendeeQuery
        );

        $response = $interactor->interact(
            new FindAttendeeInEventRequest('rtamarathon', 1)
        );

        $this->assertEquals(Attendee::create(1, 'rtamarathon', [TaskScope::runner()], []), $response->getAttendee());
    }
}

<?php

namespace Tests\Unit\Domain\Event;

use Carbon\Carbon;
use Ome\Event\Entities\Event;
use Ome\Event\Interfaces\Dto\OmeEventDto;
use Ome\Event\Interfaces\UseCases\ListOengusEvent\ListOengusEventRequest;
use Ome\Event\Queries\InmemoryListEvent;
use Ome\Event\UseCases\ListOengusEventInteractor;
use Ome\Event\Values\RelateType;
use Ome\Event\Values\Slug;
use PHPUnit\Framework\TestCase;
use Tests\Mocks\Domain\Event\Queries\OengusMarathonQuery\MockOengusMarathonQuery;

class ListOengusEventInteractorTest extends TestCase
{
    /** @test */
    public function testListOengusEvent()
    {
        $inmemoryListEventQuery = new InmemoryListEvent([
            new OmeEventDto('rta1', RelateType::moderate(), Slug::create('r1')),
            new OmeEventDto('rta2', RelateType::moderate(), Slug::create('r2')),
            new OmeEventDto('rta3', RelateType::moderate(), Slug::create('r3')),
        ]);

        $mockOengusMarathonQuery = new MockOengusMarathonQuery;
        $listOengusEvent = new ListOengusEventInteractor(
            $inmemoryListEventQuery,
            $mockOengusMarathonQuery
        );

        $result = $listOengusEvent->interact(
            new ListOengusEventRequest(Carbon::now())
        );

        $now = Carbon::now();
        $this->assertEquals([
            Event::createWithMarathon(
                $mockOengusMarathonQuery->fetch('rta1', $now),
                RelateType::moderate(),
                Slug::create('r1')
            ),
            Event::createWithMarathon(
                $mockOengusMarathonQuery->fetch('rta2', $now),
                RelateType::moderate(),
                Slug::create('r2')
            ),
            Event::createWithMarathon(
                $mockOengusMarathonQuery->fetch('rta3', $now),
                RelateType::moderate(),
                Slug::create('r3')
            ),
        ], $result->getEvents());
    }

}

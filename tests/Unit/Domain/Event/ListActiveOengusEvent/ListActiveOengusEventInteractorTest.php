<?php

namespace Tests\Unit\Domain\Event\ListActiveOengusEvent;

use Carbon\Carbon;
use Ome\Event\Entities\Event;
use Ome\Event\Interfaces\Dto\OmeEventDto;
use Ome\Event\Interfaces\UseCases\ListActiveOengusEvent\ListActiveOengusEventRequest;
use Ome\Event\Queries\InmemoryListEvent;
use Ome\Event\UseCases\ListActiveOengusEventInteractor;
use Ome\Event\Values\RelateType;
use Ome\Event\Values\Slug;
use PHPUnit\Framework\TestCase;
use Tests\Mocks\Domain\Event\Queries\OengusMarathonQuery\MockOengusMarathonQuery;

class ListActiveOengusEventInteractorTest extends TestCase
{
    /** @test */
    public function testListActiveOengusEvent()
    {
        $inmemoryListEventQuery = new InmemoryListEvent([
            new OmeEventDto('rta1', RelateType::moderate(), Slug::create('r1')),
        ]);

        $mockOengusMarathonQuery = new MockOengusMarathonQuery;
        $listOengusEvent = new ListActiveOengusEventInteractor(
            $inmemoryListEventQuery,
            $mockOengusMarathonQuery
        );

        $result = $listOengusEvent->interact(
            new ListActiveOengusEventRequest(Carbon::create(2020, 3, 8))
        );

        $this->assertEquals([
            Event::createWithMarathon(
                $mockOengusMarathonQuery->fetch('rta1', Carbon::create(2020, 3, 8)),
                RelateType::moderate(),
                Slug::create('r1')
            ),
        ], $result->getEvents());
    }

    /** @test */
    public function testListActiveOengusEventNothing()
    {
        $inmemoryListEventQuery = new InmemoryListEvent([
            new OmeEventDto('rta1', RelateType::moderate(), Slug::create('r1')),
        ]);

        $mockOengusMarathonQuery = new MockOengusMarathonQuery;
        $listOengusEvent = new ListActiveOengusEventInteractor(
            $inmemoryListEventQuery,
            $mockOengusMarathonQuery
        );

        $result = $listOengusEvent->interact(
            new ListActiveOengusEventRequest(Carbon::create(2020, 3, 9))
        );

        $this->assertEmpty($result->getEvents());
    }

}

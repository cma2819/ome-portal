<?php

namespace Tests\Unit\Domain\Event;

use Carbon\Carbon;
use Ome\Event\Entities\Event;
use Ome\Event\Entities\OengusMarathon;
use Ome\Event\Interfaces\Dto\OmeEventDto;
use Ome\Event\Interfaces\UseCases\FindLatestEvent\FindLatestEventRequest;
use Ome\Event\Queries\InmemoryListEvent;
use Ome\Event\Queries\InmemoryOengusMarathonQuery;
use Ome\Event\UseCases\FindLatestEventInteractor;
use Ome\Event\Values\MarathonStatus;
use Ome\Event\Values\RelateType;
use Ome\Event\Values\Slug;
use PHPUnit\Framework\TestCase;
use Tests\Mocks\Domain\Event\Queries\OengusMarathonQuery\MockOengusMarathonQuery;

class FindLatestEventInteractorTest extends TestCase
{
    /** @test */
    public function testFindLatestEvent()
    {
        $now = Carbon::create(2020, 1, 10, 9, 0, 0);

        $listEventQuery = new InmemoryListEvent([
            new OmeEventDto('first', RelateType::moderate(), Slug::create('first')),
            new OmeEventDto('second', RelateType::moderate(), Slug::create('second')),
            new OmeEventDto('third', RelateType::support(), Slug::create('third')),
        ]);
        $marathons = [
            OengusMarathon::createRegistered(
                'first',
                'first event',
                Carbon::create(2020, 1, 5, 9, 0, 0),
                Carbon::create(2020, 1, 6, 22, 0, 0),
                false,
                MarathonStatus::scheduled()
            ),
            OengusMarathon::createRegistered(
                'second',
                'second event',
                Carbon::create(2020, 1, 9, 9, 0, 0),
                Carbon::create(2020, 1, 10, 22, 0, 0),
                false,
                MarathonStatus::scheduled()
            ),
            OengusMarathon::createRegistered(
                'third',
                'third event',
                Carbon::create(2020, 1, 15, 9, 0, 0),
                Carbon::create(2020, 1, 16, 22, 0, 0),
                true,
                MarathonStatus::freshed()
            ),
        ];
        $oengusQuery = new InmemoryOengusMarathonQuery($marathons);

        $interactor = new FindLatestEventInteractor(
            $listEventQuery,
            $oengusQuery
        );

        $result = $interactor->interact(
            new FindLatestEventRequest($now)
        );

        $this->assertEquals(
            Event::createWithMarathon($marathons[1], RelateType::moderate(), Slug::create('second')),
            $result->getEvent()
        );
    }

}

<?php

namespace Tests\Unit\Domain\Event;

use Carbon\Carbon;
use Ome\Event\Commands\InmemoryDeleteEvent;
use Ome\Event\Entities\Event;
use Ome\Event\Entities\PartialOengusMarathon;
use Ome\Event\Interfaces\UseCases\DetachOengusMarathon\DetachOengusMarathonRequest;
use Ome\Event\UseCases\DetachOengusMarathonInteractor;
use Ome\Event\Values\MarathonStatus;
use Ome\Event\Values\RelateType;
use Ome\Event\Values\Slug;
use PHPUnit\Framework\TestCase;

class DetachOengusMarathonInteractorTest extends TestCase
{
    /** @test */
    public function testDetachOengusMarathon()
    {
        $inmemoryDeleteEvent = new InmemoryDeleteEvent([
            Event::createWithMarathon(
                PartialOengusMarathon::createPartial(
                    'rtamarathon',
                    'RTA Marathon',
                    Carbon::create(2020, 1, 1),
                    Carbon::create(2020, 1, 2),
                    false,
                    MarathonStatus::freshed()
                ),
                RelateType::moderate(),
                Slug::create('rm1')
            )
        ]);

        $result = (new DetachOengusMarathonInteractor($inmemoryDeleteEvent))->interact(
            new DetachOengusMarathonRequest('rtamarathon')
        );

        $this->assertTrue($result->getResult());
        $this->assertEmpty($inmemoryDeleteEvent->getEvents());
    }
}

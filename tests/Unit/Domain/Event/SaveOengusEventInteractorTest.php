<?php

namespace Tests\Unit\Domain\Event;

use Carbon\Carbon;
use Ome\Event\Commands\InmemoryPersistEvent;
use Ome\Event\Entities\Event;
use Ome\Event\Entities\PartialOengusMarathon;
use Ome\Event\Interfaces\UseCases\SaveOengusEvent\SaveOengusEventRequest;
use Ome\Event\UseCases\SaveOengusEventInteractor;
use Ome\Event\Values\MarathonStatus;
use Ome\Event\Values\RelateType;
use Ome\Event\Values\Slug;
use PHPUnit\Framework\TestCase;

class SaveOengusEventInteractorTest extends TestCase
{
    /** @test */
    public function testSaveOengusEvent()
    {
        $inmemoryPersistEvent = new InmemoryPersistEvent;

        $marathon = PartialOengusMarathon::createPartial(
            'rtamarathon',
            'RTA Marathon',
            Carbon::create(2020, 1, 1),
            Carbon::create(2020, 1, 2, 12, 34),
            false,
            MarathonStatus::freshed()
        );

        $result = (new SaveOengusEventInteractor($inmemoryPersistEvent))
            ->interact(new SaveOengusEventRequest($marathon, 'moderate', 'rm1'));
        $expectEvent = Event::createWithMarathon($marathon, RelateType::moderate(), Slug::create('rm1'));

        $this->assertEquals($expectEvent, $result->getEvent());
        $this->assertEquals($expectEvent, $inmemoryPersistEvent->find('rtamarathon'));
    }

    /** @test */
    public function testSaveOengusIncludeUnderScore()
    {
        $inmemoryPersistEvent = new InmemoryPersistEvent;

        $marathon = PartialOengusMarathon::createPartial(
            'issi',
            'INDIES Speedrun Summit I',
            Carbon::create(2020, 1, 1),
            Carbon::create(2020, 1, 2, 12, 34),
            true,
            MarathonStatus::freshed()
        );

        $result = (new SaveOengusEventInteractor($inmemoryPersistEvent))
            ->interact(new SaveOengusEventRequest($marathon, 'moderate', 'ISS_I'));

        $expectEvent = Event::createWithMarathon($marathon, RelateType::moderate(), Slug::create('ISS_I'));

        $this->assertEquals($expectEvent, $result->getEvent());
        $this->assertEquals($expectEvent, $inmemoryPersistEvent->find('issi'));
    }

}

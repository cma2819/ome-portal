<?php

namespace Tests\Unit\Domain\Event;

use Carbon\Carbon;
use Ome\Event\Entities\Event;
use Ome\Event\Interfaces\Dto\OmeEventDto;
use Ome\Event\Interfaces\UseCases\ExtractOengusEvent\ExtractOengusEventRequest;
use Ome\Event\Queries\InmemoryFindEvent;
use Ome\Event\UseCases\ExtractOengusEventInteractor;
use Ome\Event\Values\RelateType;
use Ome\Event\Values\Slug;
use PHPUnit\Framework\TestCase;
use Tests\Mocks\Domain\Event\Queries\OengusMarathonQuery\MockOengusMarathonQuery;

class ExtractOengusEventInteractorTest extends TestCase
{
    /** @test */
    public function testExtractOengusEvent()
    {
        $inmemoryFindEvent = new InmemoryFindEvent([
            new OmeEventDto('rtamarathon', RelateType::moderate(), Slug::create('rm1'))
        ]);
        $mockOengusMarathon = new MockOengusMarathonQuery;

        $result = (new ExtractOengusEventInteractor(
            $inmemoryFindEvent,
            $mockOengusMarathon
        ))->interact(
            new ExtractOengusEventRequest('rtamarathon')
        );

        $this->assertEquals(
            Event::createWithMarathon(
                $mockOengusMarathon->fetch('rtamarathon', Carbon::now()),
                RelateType::moderate(),
                Slug::create('rm1')
            ), $result->getEvent()
        );
    }
}

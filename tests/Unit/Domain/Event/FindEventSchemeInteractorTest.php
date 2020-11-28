<?php

namespace Tests\Unit\Domain\Event;

use Carbon\Carbon;
use Ome\Event\Entities\EventScheme;
use Ome\Event\Interfaces\UseCases\FindEventScheme\FindEventSchemeRequest;
use Ome\Event\Queries\InmemoryFindScheme;
use Ome\Event\UseCases\FindEventSchemeInteractor;
use Ome\Event\Values\SchemeStatus;
use Ome\Exceptions\EntityNotFoundException;
use PHPUnit\Framework\TestCase;

class FindEventSchemeInteractorTest extends TestCase
{
    /** @test */
    public function testFindEventScheme()
    {
        $expectedScheme = EventScheme::createRegistered(
            1,
            'Upcoming Event',
            1,
            SchemeStatus::confirmed(),
            Carbon::create(2020, 1, 1, 10, 0),
            Carbon::create(2020, 1, 2, 23, 0),
            'explanation for event',
            'detail for event'
        );
        $inmemoryFindEventScheme = new InmemoryFindScheme([
            $expectedScheme
        ]);

        $interactor = new FindEventSchemeInteractor($inmemoryFindEventScheme);

        $result = $interactor->interact(
            new FindEventSchemeRequest(1)
        )->getEventScheme();

        $this->assertEquals($expectedScheme, $result);
    }

    /** @test */
    public function testNotFound()
    {
        $inmemoryFindEventScheme = new InmemoryFindScheme();
        $interactor = new FindEventSchemeInteractor($inmemoryFindEventScheme);

        $this->expectException(EntityNotFoundException::class);

        $interactor->interact(new FindEventSchemeRequest(1));
    }

}

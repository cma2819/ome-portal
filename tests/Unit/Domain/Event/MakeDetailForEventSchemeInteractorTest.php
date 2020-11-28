<?php

namespace Tests\Unit\Domain\Event;

use Carbon\Carbon;
use Ome\Event\Commands\InmemoryPersistEventScheme;
use Ome\Event\Entities\EventScheme;
use Ome\Event\Interfaces\UseCases\MakeDetailForEventScheme\MakeDetailForEventSchemeRequest;
use Ome\Event\Queries\InmemoryFindScheme;
use Ome\Event\UseCases\MakeDetailForEventSchemeInteractor;
use Ome\Event\Values\SchemeStatus;
use Ome\Exceptions\UnmatchedContextException;
use PHPUnit\Framework\TestCase;

class MakeDetailForEventSchemeInteractorTest extends TestCase
{
    /** @test */
    public function testMakeDetailForEventScheme()
    {
        $expectedScheme = EventScheme::createRegistered(
            1,
            'Upcoming Event',
            1,
            SchemeStatus::approved(),
            Carbon::create(2020, 1, 1, 10, 0),
            Carbon::create(2020, 1, 2, 23, 0),
            'explanation for event',
            'detail for event'
        );

        $inmemoryFindEventScheme = new InmemoryFindScheme([
            $expectedScheme
        ]);
        $inmemoryPersistEventScheme = new InmemoryPersistEventScheme([
            $expectedScheme
        ]);

        $interactor = new MakeDetailForEventSchemeInteractor(
            $inmemoryFindEventScheme,
            $inmemoryPersistEventScheme
        );

        $result = $interactor->interact(
            new MakeDetailForEventSchemeRequest(
                1,
                'updated detail'
            )
        )->getEventScheme();

        $this->assertEquals(EventScheme::createRegistered(
            1,
            'Upcoming Event',
            1,
            SchemeStatus::approved(),
            Carbon::create(2020, 1, 1, 10, 0),
            Carbon::create(2020, 1, 2, 23, 0),
            'explanation for event',
            'updated detail'
        ), $result);
    }

    /** @test */
    public function testMakeDetailNotApprovedFailure()
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
        $inmemoryPersistEventScheme = new InmemoryPersistEventScheme([
            $expectedScheme
        ]);

        $interactor = new MakeDetailForEventSchemeInteractor(
            $inmemoryFindEventScheme,
            $inmemoryPersistEventScheme
        );

        $this->expectException(UnmatchedContextException::class);

        $interactor->interact(
            new MakeDetailForEventSchemeRequest(
                1,
                'updated detail'
            )
        );
    }

}

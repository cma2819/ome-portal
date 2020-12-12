<?php

namespace Tests\Unit\Domain\Event;

use Carbon\Carbon;
use Ome\Event\Commands\InmemoryPersistEventScheme;
use Ome\Event\Entities\EventScheme;
use Ome\Event\Interfaces\UseCases\EditEventScheme\EditEventSchemeRequest;
use Ome\Event\Queries\InmemoryFindScheme;
use Ome\Event\UseCases\EditEventSchemeInteractor;
use Ome\Event\Values\SchemeStatus;
use Ome\Exceptions\UnmatchedContextException;
use PHPUnit\Framework\TestCase;

class EditEventSchemeInteractorTest extends TestCase
{
    /** @test */
    public function testEditEventScheme()
    {
        $eventScheme = EventScheme::createRegistered(
            1,
            'Upcoming Event',
            1,
            SchemeStatus::applied(),
            null,
            null,
            '',
            ''
        );

        $inmemoryFindEventScheme = new InmemoryFindScheme([$eventScheme]);
        $inmemoryPersistEventScheme = new InmemoryPersistEventScheme([$eventScheme]);

        $interactor = new EditEventSchemeInteractor(
            $inmemoryFindEventScheme,
            $inmemoryPersistEventScheme
        );

        $result = $interactor->interact(
            new EditEventSchemeRequest(
                1,
                'Super Upcoming',
                Carbon::create(2020, 1, 1, 10, 0),
                Carbon::create(2020, 1, 2, 23, 0),
                'Updated explanation!'
            )
        )->getEventScheme();

        $expectScheme = EventScheme::createRegistered(
            1,
            'Super Upcoming',
            1,
            SchemeStatus::applied(),
            Carbon::create(2020, 1, 1, 10, 0),
            Carbon::create(2020, 1, 2, 23, 0),
            'Updated explanation!',
            ''
        );
        $this->assertEquals($expectScheme, $result);
        $this->assertContainsEquals($expectScheme, $inmemoryPersistEventScheme->getSchemes());
    }

    /** @test */
    public function testEditForNotAppliedFailure()
    {
        $eventScheme = EventScheme::createRegistered(
            1,
            'Upcoming Event',
            1,
            SchemeStatus::approved(),
            null,
            null,
            '',
            ''
        );

        $inmemoryFindEventScheme = new InmemoryFindScheme([$eventScheme]);
        $inmemoryPersistEventScheme = new InmemoryPersistEventScheme([$eventScheme]);

        $interactor = new EditEventSchemeInteractor(
            $inmemoryFindEventScheme,
            $inmemoryPersistEventScheme
        );

        $this->expectException(UnmatchedContextException::class);

        $interactor->interact(
            new EditEventSchemeRequest(
                1,
                'Super Upcoming',
                Carbon::create(2020, 1, 1, 10, 0),
                Carbon::create(2020, 1, 2, 23, 0),
                'Updated explanation!'
            )
        );
    }
}

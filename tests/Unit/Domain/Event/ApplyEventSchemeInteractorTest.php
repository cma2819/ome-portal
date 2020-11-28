<?php

namespace Tests\Unit\Domain\Event;

use Carbon\Carbon;
use Ome\Event\Commands\InmemoryPersistEventScheme;
use Ome\Event\Entities\EventScheme;
use Ome\Event\Interfaces\UseCases\ApplyEventScheme\ApplyEventSchemeRequest;
use Ome\Event\UseCases\ApplyEventSchemeInteractor;
use Ome\Event\Values\SchemeStatus;
use Ome\Exceptions\UnmatchedContextException;
use PHPUnit\Framework\TestCase;

class ApplyEventSchemeInteractorTest extends TestCase
{
    /** @test */
    public function testApplyEventScheme()
    {
        $inmemoryPersistEventScheme = new InmemoryPersistEventScheme();

        $interactor = new ApplyEventSchemeInteractor(
            $inmemoryPersistEventScheme
        );

        $eventScheme = $interactor->interact(
            new ApplyEventSchemeRequest(
                1,
                'Upcoming Event',
                Carbon::create(2020, 1, 1, 10, 0, 0),
                Carbon::create(2020, 1, 2, 22, 0),
                '年始早々やるイベントですよーーーーー'
            )
        )->getScheme();

        $exceptedEventScheme = EventScheme::createRegistered(
            1,
            'Upcoming Event',
            1,
            SchemeStatus::applied(),
            Carbon::create(2020, 1, 1, 10, 0, 0),
            Carbon::create(2020, 1, 2, 22, 0),
            '年始早々やるイベントですよーーーーー',
            ''
        );

        $this->assertEquals($exceptedEventScheme, $eventScheme);
        $this->assertContainsEquals($exceptedEventScheme, $inmemoryPersistEventScheme->getSchemes());
    }

    /** @test */
    public function testEndBeforeStartFailure()
    {
        $inmemoryPersistEventScheme = new InmemoryPersistEventScheme();

        $interactor = new ApplyEventSchemeInteractor(
            $inmemoryPersistEventScheme
        );

        $this->expectException(UnmatchedContextException::class);

        $interactor->interact(
            new ApplyEventSchemeRequest(
                1,
                'Upcoming Event',
                Carbon::create(2020, 1, 1, 10, 0, 0),
                Carbon::create(2019, 12, 31, 22, 0),
                '年始早々やるイベントですよーーーーー'
            )
        );
    }
}

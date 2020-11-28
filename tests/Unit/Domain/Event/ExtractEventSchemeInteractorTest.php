<?php

namespace Tests\Unit\Domain\Event;

use Carbon\Carbon;
use Ome\Event\Entities\EventScheme;
use Ome\Event\Interfaces\UseCases\ExtractEventScheme\ExtractEventSchemeRequest;
use Ome\Event\Queries\InmemoryListEventScheme;
use Ome\Event\UseCases\ExtractEventSchemeInteractor;
use Ome\Event\Values\SchemeStatus;
use PHPUnit\Framework\TestCase;

class ExtractEventSchemeInteractorTest extends TestCase
{
    /** @test */
    public function testExtractSchemeWithStatus()
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

        $inmemoryListEventScheme = new InmemoryListEventScheme([$expectedScheme]);

        $interactor = new ExtractEventSchemeInteractor($inmemoryListEventScheme);

        $schemes = $interactor->interact(
            new ExtractEventSchemeRequest(
                null,
                ['confirmed'],
                null,
                null
            )
        )->getEventSchemes();

        $this->assertContainsEquals($expectedScheme, $schemes);
    }

    /** @test */
    public function testExtractSchemeWithPlannerId()
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

        $inmemoryListEventScheme = new InmemoryListEventScheme([$expectedScheme]);

        $interactor = new ExtractEventSchemeInteractor($inmemoryListEventScheme);

        $schemes = $interactor->interact(
            new ExtractEventSchemeRequest(
                1,
                null,
                null,
                null
            )
        )->getEventSchemes();

        $this->assertContainsEquals($expectedScheme, $schemes);
    }

    /** @test */
    public function testExtractSchemeWithStartAt()
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

        $inmemoryListEventScheme = new InmemoryListEventScheme([$expectedScheme]);

        $interactor = new ExtractEventSchemeInteractor($inmemoryListEventScheme);

        $schemes = $interactor->interact(
            new ExtractEventSchemeRequest(
                null,
                null,
                Carbon::create(2020, 1, 1, 0, 0),
                null
            )
        )->getEventSchemes();

        $this->assertContainsEquals($expectedScheme, $schemes);
    }

    /** @test */
    public function testExtractSchemeWithEndAt()
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

        $inmemoryListEventScheme = new InmemoryListEventScheme([$expectedScheme]);

        $interactor = new ExtractEventSchemeInteractor($inmemoryListEventScheme);

        $schemes = $interactor->interact(
            new ExtractEventSchemeRequest(
                null,
                null,
                null,
                Carbon::create(2020, 1, 3, 0, 0)
            )
        )->getEventSchemes();

        $this->assertContainsEquals($expectedScheme, $schemes);
    }

    /** @test */
    public function testExtractEmpty()
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

        $inmemoryListEventScheme = new InmemoryListEventScheme([$expectedScheme]);

        $interactor = new ExtractEventSchemeInteractor($inmemoryListEventScheme);

        $schemes = $interactor->interact(
            new ExtractEventSchemeRequest(
                null,
                [],
                null,
                null
            )
        )->getEventSchemes();

        $this->assertEmpty($schemes);
    }

}

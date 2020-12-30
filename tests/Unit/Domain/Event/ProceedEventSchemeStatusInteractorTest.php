<?php

namespace Tests\Unit\Domain\Event;

use Carbon\Carbon;
use Ome\Event\Commands\InmemoryPersistAdminReply;
use Ome\Event\Commands\InmemoryPersistEventScheme;
use Ome\Event\Entities\AdminStatusReply;
use Ome\Event\Entities\EventScheme;
use Ome\Event\Interfaces\UseCases\ProceedEventSchemeStatus\ProceedEventSchemeStatusRequest;
use Ome\Event\Queries\InmemoryFindScheme;
use Ome\Event\UseCases\ProceedEventSchemeStatusInteractor;
use Ome\Event\Values\SchemeStatus;
use Ome\Exceptions\UnmatchedContextException;
use PHPUnit\Framework\TestCase;

class ProceedEventSchemeStatusInteractorTest extends TestCase
{
    /** @test */
    public function testProceedEventSchemeStatus()
    {
        $expectedScheme = EventScheme::createRegistered(
            1,
            'Upcoming Event',
            1,
            SchemeStatus::applied(),
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
        $inmemoryPersistAdminReply = new InmemoryPersistAdminReply();

        $interactor = new ProceedEventSchemeStatusInteractor(
            $inmemoryPersistEventScheme,
            $inmemoryFindEventScheme,
            $inmemoryPersistAdminReply
        );

        $result = $interactor->interact(
            new ProceedEventSchemeStatusRequest(1, 'approved', 'Approve your event!', Carbon::create(2020, 1, 1, 12, 34, 56))
        );

        $this->assertEquals($result->getScheme(), EventScheme::createRegistered(
            1,
            'Upcoming Event',
            1,
            SchemeStatus::approved(),
            Carbon::create(2020, 1, 1, 10, 0),
            Carbon::create(2020, 1, 2, 23, 0),
            'explanation for event',
            'detail for event'
        ));
        $this->assertContainsEquals(AdminStatusReply::createApproveReply(
            1,
            'Approve your event!',
            Carbon::create(2020, 1, 1, 12, 34, 56)
        ), $inmemoryPersistAdminReply->getAdminReplies());
    }

    /** @test */
    public function testProceedToUnmatchedStatus()
    {
        $scheme = EventScheme::createRegistered(
            1,
            'Upcoming Event',
            1,
            SchemeStatus::approved(),
            Carbon::create(2020, 1, 1, 10, 0),
            Carbon::create(2020, 1, 2, 23, 0),
            'explanation for event',
            'detail for event'
        );

        $inmemoryFindEventScheme = new InmemoryFindScheme([$scheme]);
        $inmemoryPersistEventScheme = new InmemoryPersistEventScheme([$scheme]);
        $inmemoryPersistAdminReply = new InmemoryPersistAdminReply();

        $interactor = new ProceedEventSchemeStatusInteractor(
            $inmemoryPersistEventScheme,
            $inmemoryFindEventScheme,
            $inmemoryPersistAdminReply
        );

        $this->expectException(UnmatchedContextException::class);

        $interactor->interact(
            new ProceedEventSchemeStatusRequest(1, 'denied', 'Deny your event', Carbon::now())
        );
    }
}

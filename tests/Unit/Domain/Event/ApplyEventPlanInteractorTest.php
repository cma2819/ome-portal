<?php

namespace Tests\Unit\Domain\Event;

use Ome\Event\Commands\InmemoryPersistEventPlan;
use Ome\Event\Entities\EventPlan;
use Ome\Event\Interfaces\UseCases\ApplyEventPlan\ApplyEventPlanRequest;
use Ome\Event\UseCases\ApplyEventPlanInteractor;
use Ome\Event\Values\PlanStatus;
use PHPUnit\Framework\TestCase;

class ApplyEventPlanInteractorTest extends TestCase
{
    /** @test */
    public function testApplyEventPlan()
    {
        $inmemoryPersistEventPlan = new InmemoryPersistEventPlan();

        $interactor = new ApplyEventPlanInteractor($inmemoryPersistEventPlan);
        $response = $interactor->interact(
            new ApplyEventPlanRequest(
                'new event plan!',
                1,
                'this is super event!'
            )
        );

        $this->assertEquals(
            EventPlan::createRegisteredPlan(
                1,
                'new event plan!',
                1,
                PlanStatus::applied(),
                'this is super event!'
            ),
            $response->getPlan()
        );
    }
}

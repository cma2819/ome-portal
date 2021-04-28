<?php

namespace Tests\Unit\Domain\Event;

use Ome\Event\Entities\EventPlan;
use Ome\Event\Interfaces\UseCases\ExtractEventPlan\ExtractEventPlanRequest;
use Ome\Event\Queries\InmemoryListEventPlanQuery;
use Ome\Event\UseCases\ExtractEventPlanInteractor;
use Ome\Event\Values\PlanStatus;
use PHPUnit\Framework\TestCase;

class ExtractEventPlanInteractorTest extends TestCase
{
    /** @test */
    public function testExtractPlan()
    {
        $plans = [
            EventPlan::createRegisteredPlan(
                1,
                'This is event plan',
                1,
                PlanStatus::approved(),
                'this is super event. please make real!'
            ),
            EventPlan::createRegisteredPlan(
                2,
                'This is next event plan',
                1,
                PlanStatus::applied(),
                'this is super next event. please make real!!'
            ),
        ];
        $inmemoryListPlanQuery = new InmemoryListEventPlanQuery($plans);

        $interactor = new ExtractEventPlanInteractor($inmemoryListPlanQuery);

        $response = $interactor->interact(new ExtractEventPlanRequest(1, null));
        $this->assertEquals(
            $plans,
            $response->getEventPlans()
        );
    }

    /** @test */
    public function testExtractPlanByStatus()
    {
        $plans = [
            EventPlan::createRegisteredPlan(
                1,
                'This is event plan',
                1,
                PlanStatus::approved(),
                'this is super event. please make real!'
            ),
            EventPlan::createRegisteredPlan(
                2,
                'This is next event plan',
                1,
                PlanStatus::applied(),
                'this is super next event. please make real!!'
            ),
        ];
        $inmemoryListPlanQuery = new InmemoryListEventPlanQuery($plans);

        $interactor = new ExtractEventPlanInteractor($inmemoryListPlanQuery);

        $response = $interactor->interact(new ExtractEventPlanRequest(null, [ PlanStatus::approved()->value() ]));
        $this->assertContainsEquals($plans[0],$response->getEventPlans());
        $this->assertNotContainsEquals($plans[1], $response->getEventPlans());
    }
}

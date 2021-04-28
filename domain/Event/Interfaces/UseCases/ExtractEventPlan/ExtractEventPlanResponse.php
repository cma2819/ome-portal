<?php

namespace Ome\Event\Interfaces\UseCases\ExtractEventPlan;

use Ome\Event\Entities\EventPlan;

/**
 * Response object for ExtractEventPlan.
 */
class ExtractEventPlanResponse
{
    /** @var EventPlan[] */
    private array $eventPlans;

    public function __construct(
        array $eventPlans
    ) {
        $this->eventPlans = $eventPlans;
    }

    /**
     * Get the value of eventPlans
     */
    public function getEventPlans()
    {
        return $this->eventPlans;
    }
}

<?php

namespace Ome\Event\Interfaces\UseCases\ApplyEventPlan;

use Ome\Event\Entities\EventPlan;

/**
 * Response object for ApplyEventPlan.
 */
class ApplyEventPlanResponse
{
    private EventPlan $plan;

    public function __construct(
        EventPlan $plan
    ) {
        $this->plan = $plan;
    }

    /**
     * Get the value of plan
     */
    public function getPlan()
    {
        return $this->plan;
    }
}

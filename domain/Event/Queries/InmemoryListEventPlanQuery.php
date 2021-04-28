<?php

namespace Ome\Event\Queries;

use Ome\Event\Entities\EventPlan;
use Ome\Event\Interfaces\Queries\ListEventPlanQuery;

class InmemoryListEventPlanQuery implements ListEventPlanQuery
{

    /** @var EventPlan[] */
    private array $plans;

    /**
     * @param EventPlan[] $plans
     */
    public function __construct(
        array $plans = []
    ) {
        $this->plans = $plans;
    }

    public function fetch(?int $plannerId = null, ?array $status = null): array
    {
        $result = $this->plans;

        if (!is_null($plannerId)) {
            $result = array_filter($result, function (EventPlan $plan) use ($plannerId) {
                return $plan->getPlannerId() === $plannerId;
            });
        }

        if (!is_null($status)) {
            $result = array_filter($result, function (EventPlan $plan) use ($status) {
                return in_array($plan->getStatus()->value(), $status);
            });
        }

        return $result;
    }

    /**
     * Get the value of plans
     */
    public function getPlans()
    {
        return $this->plans;
    }
}

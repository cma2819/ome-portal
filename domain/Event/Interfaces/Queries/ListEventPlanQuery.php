<?php

namespace Ome\Event\Interfaces\Queries;

use Ome\Event\Entities\EventPlan;
use Ome\Event\Values\PlanStatus;

interface ListEventPlanQuery
{
    /**
     * @param integer|null $plannerId
     * @param PlanStatus[]|null $status
     * @return EventPlan[]
     */
    public function fetch(
        ?int $plannerId = null,
        ?array $status = null
    ): array;
}

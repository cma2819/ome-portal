<?php

namespace Ome\Event\Interfaces\UseCases\ExtractEventPlan;

use Ome\Event\Values\PlanStatus;

/**
 * Request object for ExtractEventPlan.
 */
class ExtractEventPlanRequest
{
    private ?int $plannerId;

    /** @var PlanStatus[]|null */
    private ?array $status;

    /**
     * @param integer|null $plannerId
     * @param PlanStatus[]|null $status
     */
    public function __construct(
        ?int $plannerId = null,
        ?array $status = null
    ) {
        $this->plannerId = $plannerId;
        $this->status = $status;
    }

    /**
     * Get the value of plannerId
     */
    public function getPlannerId()
    {
        return $this->plannerId;
    }

    /**
     * Get the value of status
     */
    public function getStatus()
    {
        return $this->status;
    }
}

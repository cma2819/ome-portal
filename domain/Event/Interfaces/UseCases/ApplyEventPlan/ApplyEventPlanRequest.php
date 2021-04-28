<?php

namespace Ome\Event\Interfaces\UseCases\ApplyEventPlan;

/**
 * Request object for ApplyEventPlan.
 */
class ApplyEventPlanRequest
{
    private string $name;

    private int $plannerId;

    private string $explanation;

    public function __construct(
        string $name,
        int $plannerId,
        string $explanation
    ) {
        $this->name = $name;
        $this->plannerId = $plannerId;
        $this->explanation = $explanation;
    }

    /**
     * Get the value of name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get the value of plannerId
     */
    public function getPlannerId()
    {
        return $this->plannerId;
    }

    /**
     * Get the value of explanation
     */
    public function getExplanation()
    {
        return $this->explanation;
    }
}

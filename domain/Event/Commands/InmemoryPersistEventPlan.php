<?php

namespace Ome\Event\Commands;

use Ome\Event\Entities\EventPlan;
use Ome\Event\Interfaces\Commands\PersistEventPlanCommand;

class InmemoryPersistEventPlan implements PersistEventPlanCommand
{
    protected array $eventPlans;

    public function __construct(
        array $eventPlans = []
    ) {
        $this->eventPlans = $eventPlans;
    }

    public function execute(EventPlan $eventPlan): EventPlan
    {
        $id = $eventPlan->getId();
        if (is_null($id)) {
            $id = $this->next();
        }

        $this->eventPlans[$id] = $eventPlan;

        return EventPlan::createRegisteredPlan(
            $id,
            $eventPlan->getName(),
            $eventPlan->getPlannerId(),
            $eventPlan->getStatus(),
            $eventPlan->getExplanation()
        );
    }

    public function getEventPlans(): array
    {
        return $this->eventPlans;
    }

    protected function next(): int
    {
        return (array_key_last($this->eventPlans) ?? 0) + 1;
    }
}

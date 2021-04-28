<?php

namespace App\Infrastructure\Commands\Event;

use App\Infrastructure\Eloquents\EventPlan as EventPlanEloquent;
use Ome\Event\Entities\EventPlan;
use Ome\Event\Interfaces\Commands\PersistEventPlanCommand;
use Ome\Event\Values\PlanStatus;

class DbPersistEventPlanCommand implements PersistEventPlanCommand
{
    public function execute(EventPlan $eventPlan): EventPlan
    {
        $eloquent = EventPlanEloquent::find($eventPlan->getId());

        if (is_null($eventPlan->getId())) {
            $eloquent = new EventPlanEloquent();
        }

        $eloquent->name = $eventPlan->getName();
        $eloquent->planner_id = $eventPlan->getPlannerId();
        $eloquent->status = $eventPlan->getStatus()->value();
        $eloquent->explanation = $eventPlan->getExplanation();
        $eloquent->save();

        return EventPlan::createRegisteredPlan(
            $eloquent->id,
            $eloquent->name,
            $eloquent->planner_id,
            PlanStatus::createFromValue($eloquent->status),
            $eloquent->explanation
        );
    }
}

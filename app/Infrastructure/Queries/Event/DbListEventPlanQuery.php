<?php

namespace App\Infrastructure\QUeries\Event;

use App\Infrastructure\Eloquents\EventPlan as EventPlanEloquent;
use Ome\Event\Entities\EventPlan;
use Ome\Event\Interfaces\Queries\ListEventPlanQuery;
use Ome\Event\Values\PlanStatus;

class DbListEventPlanQuery implements ListEventPlanQuery
{
    public function fetch(?int $plannerId = null, ?array $status = null): array
    {
        $query = EventPlanEloquent::query();

        if (!is_null($plannerId)) {
            $query = $query->where('planner_id', '=', $plannerId);
        }

        if (!is_null($status)) {
            $inStatus = [];
            foreach ($status as $st) {
                $inStatus[] = $st->value();
            }

            $query = $query->whereIn('status', $inStatus);
        }

        $plans = $query->select([
            'id',
            'name',
            'planner_id',
            'status',
            'explanation'
        ])->get();

        return $plans->map(function (EventPlanEloquent $plan) {
            return EventPlan::createRegisteredPlan(
                $plan->id,
                $plan->name,
                $plan->planner_id,
                PlanStatus::createFromValue($plan->status),
                $plan->explanation
            );
        })->all();
    }
}

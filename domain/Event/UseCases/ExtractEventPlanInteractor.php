<?php

namespace Ome\Event\UseCases;

use Ome\Event\Interfaces\Queries\ListEventPlanQuery;
use Ome\Event\Interfaces\UseCases\ExtractEventPlan\ExtractEventPlanRequest;
use Ome\Event\Interfaces\UseCases\ExtractEventPlan\ExtractEventPlanResponse;
use Ome\Event\Interfaces\UseCases\ExtractEventPlan\ExtractEventPlanUseCase;

class ExtractEventPlanInteractor implements ExtractEventPlanUseCase
{
    protected ListEventPlanQuery $listEventPlanQuery;

    public function __construct(
        ListEventPlanQuery $listEventPlanQuery
    ) {
        $this->listEventPlanQuery = $listEventPlanQuery;
    }

    public function interact(ExtractEventPlanRequest $request): ExtractEventPlanResponse
    {
        $plans = $this->listEventPlanQuery->fetch(
            $request->getPlannerId(),
            $request->getStatus()
        );

        return new ExtractEventPlanResponse($plans);
    }
}

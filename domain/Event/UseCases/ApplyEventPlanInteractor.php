<?php

namespace Ome\Event\UseCases;

use Ome\Event\Entities\EventPlan;
use Ome\Event\Interfaces\Commands\PersistEventPlanCommand;
use Ome\Event\Interfaces\UseCases\ApplyEventPlan\ApplyEventPlanRequest;
use Ome\Event\Interfaces\UseCases\ApplyEventPlan\ApplyEventPlanResponse;
use Ome\Event\Interfaces\UseCases\ApplyEventPlan\ApplyEventPlanUseCase;

class ApplyEventPlanInteractor implements ApplyEventPlanUseCase
{
    protected PersistEventPlanCommand $persistEventPlanCommand;

    public function __construct(
        PersistEventPlanCommand $persistEventPlanCommand
    ) {
        $this->persistEventPlanCommand = $persistEventPlanCommand;
    }

    public function interact(ApplyEventPlanRequest $request): ApplyEventPlanResponse
    {

        $plan = $this->persistEventPlanCommand->execute(
            EventPlan::createNewPlan(
                $request->getName(),
                $request->getPlannerId(),
                $request->getExplanation()
            )
        );

        return new ApplyEventPlanResponse($plan);
    }
}

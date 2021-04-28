<?php

namespace Ome\Event\Interfaces\UseCases\ApplyEventPlan;

/**
 * Apply Event Plan.
 */
interface ApplyEventPlanUseCase
{
	/**
	 * Apply Event Plan.
	 */
	public function interact(ApplyEventPlanRequest $request): ApplyEventPlanResponse;
}

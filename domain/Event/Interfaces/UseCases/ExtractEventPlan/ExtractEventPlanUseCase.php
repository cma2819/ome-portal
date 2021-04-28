<?php

namespace Ome\Event\Interfaces\UseCases\ExtractEventPlan;

/**
 * Extract Event Plan.
 */
interface ExtractEventPlanUseCase
{
	/**
	 * Extract Event Plan.
	 */
	public function interact(ExtractEventPlanRequest $request): ExtractEventPlanResponse;
}

<?php

namespace Ome\Event\Interfaces\UseCases\FindLatestEvent;

/**
 * Find Latest Event.
 */
interface FindLatestEventUseCase
{
	/**
	 * Find Latest Event.
	 */
	public function interact(FindLatestEventRequest $request): FindLatestEventResponse;
}

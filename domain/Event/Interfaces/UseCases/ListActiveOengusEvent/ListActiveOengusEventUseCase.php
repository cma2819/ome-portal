<?php

namespace Ome\Event\Interfaces\UseCases\ListActiveOengusEvent;

/**
 * List Active Oengus Event.
 */
interface ListActiveOengusEventUseCase
{
	/**
	 * List Active Oengus Event.
	 */
	public function interact(ListActiveOengusEventRequest $request): ListActiveOengusEventResponse;
}

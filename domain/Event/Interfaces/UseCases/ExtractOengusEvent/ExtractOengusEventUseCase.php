<?php

namespace Ome\Event\Interfaces\UseCases\ExtractOengusEvent;

/**
 * Extract Oengus Event.
 */
interface ExtractOengusEventUseCase
{
	/**
	 * Extract Oengus Event.
	 */
	public function interact(ExtractOengusEventRequest $request): ExtractOengusEventResponse;
}

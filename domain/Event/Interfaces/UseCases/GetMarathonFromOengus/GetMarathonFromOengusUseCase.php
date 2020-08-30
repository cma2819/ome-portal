<?php

namespace Ome\Event\Interfaces\UseCases\GetMarathonFromOengus;

/**
 * Get Marathon From Oengus.
 */
interface GetMarathonFromOengusUseCase
{
	/**
	 * Get Marathon From Oengus.
	 */
	public function interact(GetMarathonFromOengusRequest $request): GetMarathonFromOengusResponse;
}

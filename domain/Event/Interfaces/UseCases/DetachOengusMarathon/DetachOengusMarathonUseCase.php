<?php

namespace Ome\Event\Interfaces\UseCases\DetachOengusMarathon;

/**
 * Detach Oengus Marathon.
 */
interface DetachOengusMarathonUseCase
{
	/**
	 * Detach Oengus Marathon.
	 */
	public function interact(DetachOengusMarathonRequest $request): DetachOengusMarathonResponse;
}

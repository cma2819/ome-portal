<?php

namespace Ome\Stream\Interfaces\UseCases\GetStreamerByUserId;

/**
 * Get Streamer By User Id.
 */
interface GetStreamerByUserIdUseCase
{
	/**
	 * Get Streamer By User Id.
	 */
	public function interact(GetStreamerByUserIdRequest $request): GetStreamerByUserIdResponse;
}

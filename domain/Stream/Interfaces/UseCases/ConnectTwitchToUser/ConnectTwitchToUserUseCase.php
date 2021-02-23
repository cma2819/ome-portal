<?php

namespace Ome\Stream\Interfaces\UseCases\ConnectTwitchToUser;

/**
 * Connect Twitch To User.
 */
interface ConnectTwitchToUserUseCase
{
	/**
	 * Connect Twitch To User.
	 */
	public function interact(ConnectTwitchToUserRequest $request): ConnectTwitchToUserResponse;
}

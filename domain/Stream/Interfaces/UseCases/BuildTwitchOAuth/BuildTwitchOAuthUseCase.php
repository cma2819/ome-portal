<?php

namespace Ome\Stream\Interfaces\UseCases\BuildTwitchOAuth;

/**
 * Build Twitch O Auth.
 */
interface BuildTwitchOAuthUseCase
{
	/**
	 * Build Twitch O Auth.
	 */
	public function interact(BuildTwitchOAuthRequest $request): BuildTwitchOAuthResponse;
}

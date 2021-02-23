<?php

namespace Ome\Stream\Interfaces\UseCases\AuthorizeTwitchByAccessToken;

/**
 * Authorize Twitch By Access Token.
 */
interface AuthorizeTwitchByAccessTokenUseCase
{
	/**
	 * Authorize Twitch By Access Token.
	 */
	public function interact(AuthorizeTwitchByAccessTokenRequest $request): AuthorizeTwitchByAccessTokenResponse;
}

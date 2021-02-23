<?php

namespace Ome\Stream\Interfaces\UseCases\ExchangeCodeToAccessToken;

/**
 * Exchange Code To Access Token.
 */
interface ExchangeCodeToAccessTokenUseCase
{
	/**
	 * Exchange Code To Access Token.
	 */
	public function interact(ExchangeCodeToAccessTokenRequest $request): ExchangeCodeToAccessTokenResponse;
}

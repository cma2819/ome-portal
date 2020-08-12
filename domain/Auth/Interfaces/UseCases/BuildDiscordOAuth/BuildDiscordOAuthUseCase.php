<?php

namespace Ome\Auth\Interfaces\UseCases\BuildDiscordOAuth;

/**
 * Build Discord OAuth.
 */
interface BuildDiscordOAuthUseCase
{
    /**
     * Build Discord OAuth.
     */
    public function interact(BuildDiscordOAuthRequest $request): BuildDiscordOAuthResponse;
}

<?php

namespace Ome\Auth\Interfaces\UseCases\AuthenticateWithDiscordUser;

/**
 * Authenticate With Discord User.
 */
interface AuthenticateWithDiscordUserUseCase
{
    /**
     * Authenticate With Discord User.
     */
    public function interact(AuthenticateWithDiscordUserRequest $request): AuthenticateWithDiscordUserResponse;
}

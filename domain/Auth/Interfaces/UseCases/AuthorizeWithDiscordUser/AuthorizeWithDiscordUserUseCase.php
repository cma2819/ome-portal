<?php

namespace Ome\Auth\Interfaces\UseCases\AuthorizeWithDiscordUser;

/**
 * Authorize With Discord User.
 */
interface AuthorizeWithDiscordUserUseCase
{
    /**
     * Authorize With Discord User.
     */
    public function interact(AuthorizeWithDiscordUserRequest $request): AuthorizeWithDiscordUserResponse;
}

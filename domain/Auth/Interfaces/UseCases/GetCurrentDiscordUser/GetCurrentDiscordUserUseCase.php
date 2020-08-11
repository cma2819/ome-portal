<?php

namespace Ome\Auth\Interfaces\UseCases\GetCurrentDiscordUser;

/**
 * Get Current Discord User.
 */
interface GetCurrentDiscordUserUseCase
{
    /**
     * Get Current Discord User.
     */
    public function interact(GetCurrentDiscordUserRequest $request): GetCurrentDiscordUserResponse;
}

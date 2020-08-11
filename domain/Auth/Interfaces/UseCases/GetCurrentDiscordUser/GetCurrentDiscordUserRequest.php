<?php

namespace Ome\Auth\Interfaces\UseCases\GetCurrentDiscordUser;

/**
 * Request object for GetCurrentDiscordUser.
 */
class GetCurrentDiscordUserRequest
{
    private string $token;

    public function __construct(
        string $token
    ) {
        $this->token = $token;
    }

    /**
     * Get the value of token
     */
    public function getToken()
    {
        return $this->token;
    }
}

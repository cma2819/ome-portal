<?php

namespace Ome\Auth\Interfaces\UseCases\AuthenticateWithDiscordUser;

use Ome\Auth\Entities\DiscordUser;

/**
 * Request object for AuthenticateWithDiscordUser.
 */
class AuthenticateWithDiscordUserRequest
{
    private DiscordUser $discordUser;

    public function __construct(DiscordUser $discordUser)
    {
        $this->discordUser = $discordUser;
    }

    /**
     * Get the value of discordUser
     */
    public function getDiscordUser()
    {
        return $this->discordUser;
    }
}

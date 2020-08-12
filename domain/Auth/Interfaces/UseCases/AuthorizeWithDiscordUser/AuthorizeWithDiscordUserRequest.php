<?php

namespace Ome\Auth\Interfaces\UseCases\AuthorizeWithDiscordUser;

use Ome\Auth\Entities\DiscordUser;

/**
 * Request object for AuthorizeWithDiscordUser.
 */
class AuthorizeWithDiscordUserRequest
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

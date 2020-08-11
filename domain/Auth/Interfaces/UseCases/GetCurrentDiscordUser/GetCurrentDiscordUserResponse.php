<?php

namespace Ome\Auth\Interfaces\UseCases\GetCurrentDiscordUser;

use Ome\Auth\Entities\DiscordUser;

/**
 * Response object for GetCurrentDiscordUser.
 */
class GetCurrentDiscordUserResponse
{
    private DiscordUser $user;

    public function __construct(
        DiscordUser $user
    ) {
        $this->user = $user;
    }

    /**
     * Get the value of user
     */
    public function getUser()
    {
        return $this->user;
    }
}

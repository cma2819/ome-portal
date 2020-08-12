<?php

namespace Ome\Auth\Interfaces\UseCases\AuthenticateWithDiscordUser;

use Ome\Auth\Entities\User;

/**
 * Response object for AuthenticateWithDiscordUser.
 */
class AuthenticateWithDiscordUserResponse
{
    private User $user;

    public function __construct(User $user)
    {
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

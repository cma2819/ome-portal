<?php

namespace App\Infrastructure\Queries\Auth;

use AuthDiscord\AuthDiscord;
use Ome\Auth\Entities\DiscordUser;
use Ome\Auth\Interfaces\Queries\CurrentDiscordUserQuery;

class DiscordCurrentUserQuery implements CurrentDiscordUserQuery
{
    protected AuthDiscord $authDiscord;

    public function __construct(
        AuthDiscord $authDiscord
    ) {
        $this->authDiscord = $authDiscord;
    }

    public function fetch(string $token): DiscordUser
    {
        $user = $this->authDiscord->getCurrentUser($token);

        return DiscordUser::createFromApiJson($user->jsonSerialize());
    }
}

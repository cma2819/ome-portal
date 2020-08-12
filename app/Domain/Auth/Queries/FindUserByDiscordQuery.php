<?php

namespace App\Domain\Auth\Queries;

use App\Eloquents\UserDiscord;
use Ome\Auth\Entities\DiscordUser;
use Ome\Auth\Entities\User;
use Ome\Auth\Interfaces\Queries\FindUserByDiscordQuery as FindUserByDiscordQueryInterface;

class FindUserByDiscordQuery implements FindUserByDiscordQueryInterface
{
    public function fetch(DiscordUser $discord): ?User
    {
        /** @var UserDiscord|null */
        $userDiscordEloquent = UserDiscord::where('discord_id', '=', $discord->getId())->first();
        if (is_null($userDiscordEloquent)) {
            return null;
        }

        $userEloquent = $userDiscordEloquent->user;
        if (is_null($userEloquent)) {
            return null;
        }

        return User::createRegisteredUser(
            $userEloquent->id,
            $userEloquent->name,
            $userDiscordEloquent->discord_id
        );
    }
}

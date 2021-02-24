<?php

namespace App\Infrastructure\Queries\Auth;

use App\Infrastructure\Eloquents\User as UserEloquent;
use Ome\Auth\Entities\User;
use Ome\Auth\Interfaces\Queries\FindUserByIdQuery;

class DbFindUserByIdQuery implements FindUserByIdQuery
{
    public function fetch(int $id): ?User
    {
        $user = UserEloquent::find($id);

        if (is_null($user)) {
            return null;
        }

        return User::createRegisteredUser(
            $user->id,
            $user->name,
            $user->discord->discord_id,
            $user->twitch->pluck('twitch_user_id')->all()
        );
    }
}

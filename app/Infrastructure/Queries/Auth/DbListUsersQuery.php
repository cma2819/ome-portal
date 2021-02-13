<?php

namespace App\Infrastructure\Queries\Auth;

use App\Infrastructure\Eloquents\User as UserEloquent;
use Illuminate\Database\Query\Builder;
use Ome\Auth\Entities\User;
use Ome\Auth\Interfaces\Queries\ListUsersQuery;

class DbListUsersQuery implements ListUsersQuery
{
    public function fetch(int $page): array
    {
        /** @var Builder */
        $query = UserEloquent::with('discord:id,discord_id,user_id');

        $users = $query->offset($page * 100)
            ->limit(100)
            ->get([
                'id',
                'name',
            ]);

        return $users->map(function (UserEloquent $user) {
            return User::createRegisteredUser(
                $user->id,
                $user->name,
                $user->discord->discord_id
            );
        })->all();
    }
}

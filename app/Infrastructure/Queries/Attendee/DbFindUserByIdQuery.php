<?php

namespace App\Infrastructure\Queries\Attendee;

use App\Infrastructure\Eloquents\User as UserEloquent;
use Ome\Attendee\Entities\User;
use Ome\Attendee\Interfaces\Queries\FindUserByIdQuery;

class DbFindUserByIdQuery implements FindUserByIdQuery
{
    public function fetch(int $id): ?User
    {
        $userEloquent = UserEloquent::find($id);

        if (is_null($userEloquent)) {
            return null;
        }

        return User::create($userEloquent->id, $userEloquent->name);
    }
}

<?php

namespace App\Infrastructure\Queries\Auth;

use App\Infrastructure\Eloquents\User as UserEloquent;
use Ome\Auth\Interfaces\Queries\CountUsersQuery;

class DbCountUsersQuery implements CountUsersQuery
{
    public function fetch(): int
    {
        return UserEloquent::count();
    }
}

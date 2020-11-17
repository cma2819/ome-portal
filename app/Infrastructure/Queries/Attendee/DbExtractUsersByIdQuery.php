<?php

namespace App\Infrastructure\Queries\Attendee;

use App\Infrastructure\Eloquents\User as UserEloquent;
use Ome\Attendee\Entities\User;
use Ome\Attendee\Interfaces\Queries\ExtractUsersByIdQuery;

class DbExtractUsersByIdQuery implements ExtractUsersByIdQuery
{
    public function fetch(array $idList): array
    {
        return UserEloquent::query()
            ->whereIn('id', $idList)
            ->select(['id', 'name'])
            ->get()
            ->map(function (UserEloquent $user) {
                return User::create($user->id, $user->name);
            })->all();
    }
}

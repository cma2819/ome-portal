<?php

namespace Ome\Auth\Queries;

use Ome\Auth\Interfaces\Queries\CountUsersQuery;

class InmemoryCountUsersQuery implements CountUsersQuery
{
    private array $users;

    public function __construct(
        array $users = []
    ) {
        $this->users = $users;
    }

    public function fetch(): int
    {
        return count($this->users);
    }
}

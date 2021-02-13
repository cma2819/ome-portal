<?php

namespace Ome\Auth\Queries;

use Ome\Auth\Interfaces\Queries\ListUsersQuery;

class InmemoryListUsersQuery implements ListUsersQuery
{
    /** @var User[] */
    private array $users;

    public function __construct(
        array $users = []
    ) {
        $this->users = $users;
    }

    public function fetch(int $page): array
    {
        return array_slice($this->users, 100 * $page, 100);
    }
}

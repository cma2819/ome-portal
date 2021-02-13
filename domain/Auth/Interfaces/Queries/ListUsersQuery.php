<?php

namespace Ome\Auth\Interfaces\Queries;

use Ome\Auth\Entities\User;

interface ListUsersQuery
{
    /**
     * @param integer $page
     * @return User[]
     */
    public function fetch(int $page): array;
}

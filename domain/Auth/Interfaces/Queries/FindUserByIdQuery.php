<?php

namespace Ome\Auth\Interfaces\Queries;

use Ome\Auth\Entities\User;

interface FindUserByIdQuery
{
    public function fetch(int $id): ?User;
}

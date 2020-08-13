<?php

namespace Ome\Auth\Interfaces\Queries;

use Ome\Auth\Entities\User;

interface AuthenticatedUserQuery
{
    public function fetch(): User;
}

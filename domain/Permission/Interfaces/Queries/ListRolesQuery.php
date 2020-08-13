<?php

namespace Ome\Permission\Interfaces\Queries;

use Ome\Permission\Entities\Role;

interface ListRolesQuery
{
    /**
     * @return Role[]
     */
    public function fetch(): array;
}

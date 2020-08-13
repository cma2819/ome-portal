<?php

namespace Ome\Permission\Interfaces\Queries;

use Ome\Permission\Entities\Role;

interface GetRolesForUserQuery
{
    /**
     * @param integer $id User ID
     * @return Role[]
     */
    public function fetch(int $id): array;
}

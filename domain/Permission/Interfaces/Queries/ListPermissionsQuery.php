<?php

namespace Ome\Permission\Interfaces\Queries;

use Ome\Permission\Entities\RolePermission;

interface ListPermissionsQuery
{
    /**
     * @return RolePermission[]
     */
    public function fetch(): array;
}

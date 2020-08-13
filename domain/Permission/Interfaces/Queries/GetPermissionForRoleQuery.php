<?php

namespace Ome\Permission\Interfaces\Queries;

use Ome\Permission\Entities\RolePermission;

interface GetPermissionForRoleQuery
{
    public function fetch(string $id): RolePermission;
}

<?php

namespace Ome\Permission\Interfaces\Commands;

use Ome\Permission\Entities\RolePermission;

interface PersistRolePermissionCommand
{
    public function execute(RolePermission $permission): RolePermission;
}

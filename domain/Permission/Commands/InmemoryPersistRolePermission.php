<?php

namespace Ome\Permission\Commands;

use Ome\Permission\Entities\RolePermission;
use Ome\Permission\Interfaces\Commands\PersistRolePermissionCommand;

class InmemoryPersistRolePermission implements PersistRolePermissionCommand
{
    private array $permissions = [];

    public function execute(RolePermission $permission): RolePermission
    {
        $this->permissions[] = $permission;
        return $permission;
    }

    /**
     * Get the value of permissions
     */
    public function getPermissions()
    {
        return $this->permissions;
    }
}

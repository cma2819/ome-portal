<?php

namespace Ome\Permission\Queries;

use Ome\Permission\Entities\RolePermission;
use Ome\Permission\Interfaces\Queries\GetPermissionForRoleQuery;

class InmemoryGetPermissionForRole implements GetPermissionForRoleQuery
{
    /** @var RolePermission[] */
    private array $rolePermissions = [];

    public function __construct(
        array $rolePermissions
    ) {
        $this->rolePermissions = $rolePermissions;
    }

    public function fetch(string $id): RolePermission
    {
        foreach ($this->rolePermissions as $rolePermission) {
            if ($rolePermission->getId() === $id) {
                return $rolePermission;
            }
        }

        return RolePermission::create($id, []);
    }
}

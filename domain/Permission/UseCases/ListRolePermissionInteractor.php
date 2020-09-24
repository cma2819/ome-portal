<?php

namespace Ome\Permission\UseCases;

use Ome\Permission\Entities\RolePermission;
use Ome\Permission\Interfaces\Dto\RoleDto;
use Ome\Permission\Interfaces\Queries\ListPermissionsQuery;
use Ome\Permission\Interfaces\Queries\ListRolesQuery;
use Ome\Permission\Interfaces\UseCases\ListRolePermission\ListRolePermissionResponse;
use Ome\Permission\Interfaces\UseCases\ListRolePermission\ListRolePermissionUseCase;

class ListRolePermissionInteractor implements ListRolePermissionUseCase
{
    protected ListRolesQuery $listRoles;

    protected ListPermissionsQuery $listPermissions;

    public function __construct(
        ListRolesQuery $listRoles,
        ListPermissionsQuery $listPermissions
    ) {
        $this->listRoles = $listRoles;
        $this->listPermissions = $listPermissions;
    }

    public function interact(): ListRolePermissionResponse
    {
        $roles = $this->listRoles->fetch();

        $permissions = $this->listPermissions->fetch();

        $rolePermissions = [];
        foreach ($roles as $role) {
            $dtoPermission = RolePermission::create($role->getId(), []);
            foreach ($permissions as $permission) {
                if ($role->getId() === $permission->getId()) {
                    $dtoPermission = $permission;
                    break;
                }
            }
            $rolePermissions[] = new RoleDto($role, $dtoPermission);
        }

        return new ListRolePermissionResponse($rolePermissions);
    }
}

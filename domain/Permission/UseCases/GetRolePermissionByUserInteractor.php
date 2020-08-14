<?php

namespace Ome\Permission\UseCases;

use Ome\Permission\Interfaces\Dto\RoleDto;
use Ome\Permission\Interfaces\Queries\GetPermissionForRoleQuery;
use Ome\Permission\Interfaces\Queries\GetRolesForUserQuery;
use Ome\Permission\Interfaces\UseCases\GetRolePermissionByUser\GetRolePermissionByUserRequest;
use Ome\Permission\Interfaces\UseCases\GetRolePermissionByUser\GetRolePermissionByUserResponse;
use Ome\Permission\Interfaces\UseCases\GetRolePermissionByUser\GetRolePermissionByUserUseCase;

class GetRolePermissionByUserInteractor implements GetRolePermissionByUserUseCase
{
    protected GetRolesForUserQuery $getRolesForUser;

    protected GetPermissionForRoleQuery $getPermissionForRole;

    public function __construct(
        GetRolesForUserQuery $getRolesForUser,
        GetPermissionForRoleQuery $getPermissionForRole
    ) {
        $this->getRolesForUserQuery = $getRolesForUser;
        $this->getPermissionForRole = $getPermissionForRole;
    }

    public function interact(GetRolePermissionByUserRequest $request): GetRolePermissionByUserResponse
    {
        $roles = $this->getRolesForUserQuery->fetch($request->getId());

        $rolePermissions = [];
        foreach ($roles as $role) {
            $permission = $this->getPermissionForRole->fetch($role->getId());
            $rolePermissions[] = new RoleDto($role, $permission);
        }

        return new GetRolePermissionByUserResponse($rolePermissions);
    }
}

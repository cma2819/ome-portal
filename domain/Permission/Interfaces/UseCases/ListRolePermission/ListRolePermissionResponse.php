<?php

namespace Ome\Permission\Interfaces\UseCases\ListRolePermission;

use Ome\Permission\Interfaces\Dto\RoleDto;

/**
 * Response object for ListRolePermission.
 */
class ListRolePermissionResponse
{
    /** @var RoleDto[] */
    private array $rolePermissions;

    public function __construct(
        array $rolePermissions
    ) {
        $this->rolePermissions = $rolePermissions;
    }

    /**
     * Get the value of rolePermissions
     */
    public function getRolePermissions()
    {
        return $this->rolePermissions;
    }
}

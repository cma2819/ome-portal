<?php

namespace Ome\Permission\Interfaces\UseCases\GetRolePermissionByUser;

use Ome\Permission\Interfaces\Dto\RoleDto;

/**
 * Response object for GetRolePermissionByUser.
 */
class GetRolePermissionByUserResponse
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

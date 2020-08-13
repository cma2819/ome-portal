<?php

namespace Ome\Permission\Interfaces\UseCases\SaveRolePermission;

use Ome\Permission\Entities\RolePermission;

/**
 * Response object for SaveRolePermission.
 */
class SaveRolePermissionResponse
{
    private RolePermission $rolePermission;

    public function __construct(
        RolePermission $rolePermission
    ) {
        $this->rolePermission = $rolePermission;
    }

    /**
     * Get the value of rolePermission
     */
    public function getRolePermission()
    {
        return $this->rolePermission;
    }
}

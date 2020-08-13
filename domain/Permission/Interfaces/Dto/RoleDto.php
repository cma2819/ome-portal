<?php

namespace Ome\Permission\Interfaces\Dto;

use Ome\Permission\Entities\Role;
use Ome\Permission\Entities\RolePermission;

class RoleDto
{
    private Role $role;

    private RolePermission $permission;

    public function __construct(
        Role $role,
        RolePermission $permission
    ) {
        $this->role = $role;
        $this->permission = $permission;
    }

    /**
     * Get the value of role
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Get the value of permission
     */
    public function getPermission()
    {
        return $this->permission;
    }

}

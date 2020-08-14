<?php

namespace Ome\Permission\Interfaces\UseCases\ListRolePermission;

/**
 * List Role Permission.
 */
interface ListRolePermissionUseCase
{
    /**
     * List Role Permission.
     */
    public function interact(): ListRolePermissionResponse;
}

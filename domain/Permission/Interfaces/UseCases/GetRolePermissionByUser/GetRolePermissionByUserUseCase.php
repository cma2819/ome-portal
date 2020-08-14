<?php

namespace Ome\Permission\Interfaces\UseCases\GetRolePermissionByUser;

/**
 * Get Role Permission By User.
 */
interface GetRolePermissionByUserUseCase
{
    /**
     * Get Role Permission By User.
     */
    public function interact(GetRolePermissionByUserRequest $request): GetRolePermissionByUserResponse;
}

<?php

namespace Ome\Permission\UseCases;

use Ome\Permission\Entities\RolePermission;
use Ome\Permission\Interfaces\Commands\PersistRolePermissionCommand;
use Ome\Permission\Interfaces\UseCases\SaveRolePermission\SaveRolePermissionRequest;
use Ome\Permission\Interfaces\UseCases\SaveRolePermission\SaveRolePermissionResponse;
use Ome\Permission\Interfaces\UseCases\SaveRolePermission\SaveRolePermissionUseCase;

class SaveRolePermissionInteractor implements SaveRolePermissionUseCase
{
    protected PersistRolePermissionCommand $persistRolePermission;

    public function __construct(
        PersistRolePermissionCommand $persistRolePermission
    ) {
        $this->persistRolePermission = $persistRolePermission;
    }

    public function interact(SaveRolePermissionRequest $request): SaveRolePermissionResponse
    {
        $rolePermission = RolePermission::create(
            $request->getId(),
            $request->getAllowed()
        );

        return new SaveRolePermissionResponse($this->persistRolePermission->execute($rolePermission));
    }
}

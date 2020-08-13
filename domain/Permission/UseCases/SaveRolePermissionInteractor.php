<?php

namespace Ome\Permission\UseCases;

use Ome\Permission\Entities\RolePermission;
use Ome\Permission\Interfaces\Commands\PersistRolePermissionCommand;
use Ome\Permission\Interfaces\UseCases\SaveRolePermission\SaveRolePermissionRequest;
use Ome\Permission\Interfaces\UseCases\SaveRolePermission\SaveRolePermissionResponse;
use Ome\Permission\Interfaces\UseCases\SaveRolePermission\SaveRolePermissionUseCase;
use Ome\Permission\Values\Domain;

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
        $allowedDomain = [];
        foreach ($request->getAllowed() as $allowed) {
            switch ($allowed) {
                case 'twitter':
                    $allowedDomain[] = Domain::twitter();
                    break;
                case 'admin':
                    $allowedDomain[] = Domain::admin();
                    break;
                default:
                    // Do Nothing
            }
        }

        $rolePermission = RolePermission::create(
            $request->getId(),
            $allowedDomain
        );

        return new SaveRolePermissionResponse($this->persistRolePermission->execute($rolePermission));
    }
}

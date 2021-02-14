<?php

namespace App\Http\Controllers\Api\Auth;

use App\Exceptions\HttpStatusThrowable;
use App\Http\Controllers\Controller;
use App\Http\Responses\Api\Auth\UserResponse;
use Ome\Auth\Interfaces\UseCases\GetAuthenticatedUser\GetAuthenticatedUserUseCase;
use Ome\Permission\Interfaces\UseCases\GetRolePermissionByUser\GetRolePermissionByUserRequest;
use Ome\Permission\Interfaces\UseCases\GetRolePermissionByUser\GetRolePermissionByUserUseCase;

class AuthenticateUser extends Controller
{
    protected GetAuthenticatedUserUseCase $getAuthenticatedUser;

    protected GetRolePermissionByUserUseCase $getRolePermissionByUser;

    public function __construct(
        GetAuthenticatedUserUseCase $getAuthenticatedUser,
        GetRolePermissionByUserUseCase $getRolePermissionByUser
    ) {
        $this->getAuthenticatedUser = $getAuthenticatedUser;
        $this->getRolePermissionByUser = $getRolePermissionByUser;
    }

    public function __invoke()
    {
        try {
            $user = $this->getAuthenticatedUser->interact()->getUser();
            $rolePermission = $this->getRolePermissionByUser->interact(
                new GetRolePermissionByUserRequest($user->getId())
            )->getRolePermissions();
        } catch (HttpStatusThrowable $e) {
            abort($e->getStatusCode());
        }

        $permissions = [];
        foreach ($rolePermission as $roleDto) {
            $permissions[] = $roleDto->getPermission();
        }

        return new UserResponse($user, $permissions);
    }
}

<?php

namespace App\Http\Controllers\Api\Auth;

use App\Exceptions\HttpStatusThrowable;
use App\Http\Controllers\Controller;
use App\Http\Responses\Api\Auth\UserResponse;
use Ome\Auth\Interfaces\UseCases\GetAuthenticatedUser\GetAuthenticatedUserUseCase;
use Ome\Permission\Interfaces\UseCases\GetRolePermissionByUser\GetRolePermissionByUserRequest;
use Ome\Permission\Interfaces\UseCases\GetRolePermissionByUser\GetRolePermissionByUserUseCase;
use Ome\Stream\Interfaces\UseCases\GetStreamerByUserId\GetStreamerByUserIdRequest;
use Ome\Stream\Interfaces\UseCases\GetStreamerByUserId\GetStreamerByUserIdUseCase;

class AuthenticateUser extends Controller
{
    protected GetAuthenticatedUserUseCase $getAuthenticatedUser;

    protected GetRolePermissionByUserUseCase $getRolePermissionByUser;

    protected GetStreamerByUserIdUseCase $getStreamerByUserId;

    public function __construct(
        GetAuthenticatedUserUseCase $getAuthenticatedUser,
        GetRolePermissionByUserUseCase $getRolePermissionByUser,
        GetStreamerByUserIdUseCase $getStreamerByUserId
    ) {
        $this->getAuthenticatedUser = $getAuthenticatedUser;
        $this->getRolePermissionByUser = $getRolePermissionByUser;
        $this->getStreamerByUserId = $getStreamerByUserId;
    }

    public function __invoke()
    {
        try {
            $user = $this->getAuthenticatedUser->interact()->getUser();
            $rolePermission = $this->getRolePermissionByUser->interact(
                new GetRolePermissionByUserRequest($user->getId())
            )->getRolePermissions();
            $streamer = $this->getStreamerByUserId->interact(
                new GetStreamerByUserIdRequest($user->getId())
            )->getStreamer();
        } catch (HttpStatusThrowable $e) {
            abort($e->getStatusCode());
        }

        $permissions = [];
        foreach ($rolePermission as $roleDto) {
            $permissions[] = $roleDto->getPermission();
        }

        return new UserResponse($user, $permissions, $streamer->getTwitch());
    }
}

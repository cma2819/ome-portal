<?php

namespace App\Policies;

use App\Eloquents\User;
use Auth;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Log;
use Ome\Permission\Interfaces\UseCases\GetRolePermissionByUser\GetRolePermissionByUserRequest;
use Ome\Permission\Interfaces\UseCases\GetRolePermissionByUser\GetRolePermissionByUserUseCase;

class DomainPermissionPolicy
{
    use HandlesAuthorization;

    protected GetRolePermissionByUserUseCase $getRolePermissionByUser;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct(
        GetRolePermissionByUserUseCase $getRolePermissionByUser
    ) {
        $this->getRolePermissionByUser = $getRolePermissionByUser;
    }

    public function hasPermissionToTwitter()
    {
        return $this->hasPermissionToDomain(Auth::user(), 'twitter');
    }

    public function hasPermissionToAdmin()
    {
        return $this->hasPermissionToDomain(Auth::user(), 'admin');
    }

    protected function hasPermissionToDomain(
        ?User $user,
        string $domain
    ) {
        if (is_null($user)) {
            return false;
        }

        $permissions = $this->getRolePermissionByUser->interact(new GetRolePermissionByUserRequest($user->id))->getRolePermissions();
        foreach ($permissions as $roleDto) {
            foreach ($roleDto->getPermission()->getAllowed() as $allowed) {
                if ($allowed->value() === $domain) {
                    return true;
                }
            }
        }

        return false;
    }
}

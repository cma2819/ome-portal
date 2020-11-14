<?php

namespace App\Infrastructure\Queries\Permission;

use App\Infrastructure\Eloquents\DiscordRolePermission;
use Illuminate\Support\Collection;
use Ome\Permission\Entities\RolePermission;
use Ome\Permission\Interfaces\Queries\ListPermissionsQuery;

class ListPermissions implements ListPermissionsQuery
{
    public function fetch(): array
    {
        $permissionEloquents = DiscordRolePermission::get(['discord_role_id', 'allowed_domain'])->groupBy('discord_role_id');

        $permissions = [];

        /** @var Collection */
        foreach ($permissionEloquents as $roleId => $eloquents) {
            $allowed = $eloquents->pluck('allowed_domain')->toArray();
            $permissions[] = RolePermission::create($roleId, $allowed);
        }

        return $permissions;
    }
}

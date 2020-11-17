<?php

namespace App\Infrastructure\Queries\Permission;

use App\Infrastructure\Eloquents\DiscordRolePermission;
use Ome\Permission\Entities\RolePermission;
use Ome\Permission\Interfaces\Queries\GetPermissionForRoleQuery;
use Ome\Permission\Values\Domain;

class GetPermissionForDiscordRoleQuery implements GetPermissionForRoleQuery
{
    public function fetch(string $id): RolePermission
    {
        $discordRolePermissions = DiscordRolePermission::query()
            ->where('discord_role_id', '=', $id)
            ->select(['allowed_domain'])
            ->get();

        $allowed = [];
        foreach ($discordRolePermissions->pluck('allowed_domain') as $allowedDomain) {
            $allowed[] = Domain::createFromValue($allowedDomain);
        }

        return RolePermission::create($id, $allowed);
    }
}

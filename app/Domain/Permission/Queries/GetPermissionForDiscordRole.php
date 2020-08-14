<?php

namespace App\Domain\Permission\Queries;

use App\Eloquents\DiscordRolePermission;
use Illuminate\Support\Facades\Log;
use Ome\Permission\Entities\RolePermission;
use Ome\Permission\Interfaces\Queries\GetPermissionForRoleQuery;
use Ome\Permission\Values\Domain;

class GetPermissionForDiscordRole implements GetPermissionForRoleQuery
{
    public function fetch(string $id): RolePermission
    {
        $discordRolePermissions = DiscordRolePermission::query()
            ->where('discord_role_id', '=', $id)
            ->select(['allowed_domain'])
            ->get();

        $allowed = [];
        foreach ($discordRolePermissions->pluck('allowed_domain') as $allowedDomain) {
            switch ($allowedDomain) {
                case Domain::twitter()->value():
                    $allowed[] = Domain::twitter();
                    break;
                case Domain::admin()->value():
                    $allowed[] = Domain::admin();
                    break;
                default:
                    Log::error('Unexpected domain name received: ' . $allowedDomain);
            }
        }

        return RolePermission::create($id, $allowed);
    }
}

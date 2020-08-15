<?php

namespace App\Domain\Permission\Commands;

use App\Eloquents\DiscordRolePermission;
use Illuminate\Support\Facades\DB;
use Ome\Permission\Entities\RolePermission;
use Ome\Permission\Interfaces\Commands\PersistRolePermissionCommand;

class PersistRolePermission implements PersistRolePermissionCommand
{
    public function execute(RolePermission $permission): RolePermission
    {
        $allowed = $permission->getAllowed();

        $allowedDomain = [];
        foreach ($allowed as $domainName) {
            $allowedDomain[] = $domainName->value();
        }

        DB::transaction(function () use ($permission, $allowedDomain) {
            DiscordRolePermission::query()
                ->where('discord_role_id', '=', $permission->getId())
                ->whereNotIn('allowed_domain', $allowedDomain)
                ->delete();

            foreach ($allowedDomain as $domain) {
                DiscordRolePermission::insertOrIgnore(
                    [
                        'discord_role_id' => $permission->getId(),
                        'allowed_domain' => $domain,
                    ]
                );
            }
        });

        return RolePermission::create($permission->getId(), $allowed);
    }
}

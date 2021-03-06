<?php

namespace App\Infrastructure\Queries\Permission;

use App\Api\Discord\DiscordApiClient;
use Ome\Permission\Entities\Role;
use Ome\Permission\Interfaces\Queries\ListRolesQuery;

class DbListDiscordRoleQuery implements ListRolesQuery
{
    protected DiscordApiClient $discordApiClient;

    public function __construct(
        DiscordApiClient $discordApiClient
    ) {
        $this->discordApiClient = $discordApiClient;
    }

    public function fetch(): array
    {
        $guildId = config('services.discord.guild_id');
        $endpoint = 'guilds/' . $guildId . '/roles';

        $rolesJson = $this->discordApiClient->apiGet($endpoint);

        $roles = [];
        foreach ($rolesJson as $role) {
            $roles[] = Role::createFromApiJson($role);
        }

        return $roles;
    }
}

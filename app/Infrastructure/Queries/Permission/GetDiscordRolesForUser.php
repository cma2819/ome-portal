<?php

namespace App\Infrastructure\Queries\Permission;

use App\Api\Discord\DiscordApiClient;
use App\Infrastructure\Eloquents\User;
use Ome\Permission\Entities\Role;
use Ome\Permission\Interfaces\Queries\GetRolesForUserQuery;

class GetDiscordRolesForUser implements GetRolesForUserQuery
{
    private const DISCORD_GET_MEMBER_URL = '/guilds/{guild.id}/members/{user.id}';

    private const DISCORD_GET_ROLES_URL = '/guilds/{guild.id}/roles';

    protected DiscordApiClient $discordApiClient;

    public function __construct(
        DiscordApiClient $discordApiClient
    ) {
        $this->discordApiClient = $discordApiClient;
    }

    public function fetch(int $id): array
    {
        $userEloquent = User::findOrFail($id);
        $discordId = $userEloquent->discord->discord_id;
        $guildId = config('services.discord.guild_id');

        // Get user as guild member
        $memberJson = $this->discordApiClient->apiGet(str_replace(
            ['{guild.id}', '{user.id}'],
            [$guildId, $discordId],
            self::DISCORD_GET_MEMBER_URL
        ));
        $userRoles = $memberJson['roles'];

        // Get roles
        $rolesJson = $this->discordApiClient->apiGet(str_replace(
            '{guild.id}',
            $guildId,
            self::DISCORD_GET_ROLES_URL
        ));
        $roles = [];
        foreach ($rolesJson as $json) {
            $role = Role::createFromApiJson($json);
            if (in_array($role->getId(), $userRoles)) {
                $roles[] = $role;
            }
        }

        return $roles;
    }
}

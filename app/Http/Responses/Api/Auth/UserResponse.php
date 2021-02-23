<?php

namespace App\Http\Responses\Api\Auth;

use JsonSerializable;
use Ome\Auth\Interfaces\Dto\UserProfile;
use Ome\Permission\Entities\RolePermission;
use Ome\Stream\Entities\TwitchUser;

class UserResponse implements JsonSerializable
{
    private array $json;

    /**
     * @param UserProfile $user
     * @param RolePermission[] $rolePermissions
     * @param TwitchUser[] $twitch
     */
    public function __construct(
        UserProfile $user,
        array $rolePermissions,
        array $twitch
    ) {
        $allowed = [];
        foreach ($rolePermissions as $rolePermission) {
            foreach ($rolePermission->getAllowed() as $allowedDomain) {
                $allowed[] = $allowedDomain->value();
            }
        }

        array_unique($allowed);

        $twitchJson = [];
        foreach ($twitch as $tw) {
            $twitchJson[] = [
                'id' => $tw->getId(),
                'username' => $tw->getUsername(),
            ];
        }

        $this->json = [
            'id' => $user->getId(),
            'username' => $user->getName(),
            'discord' => [
                'id' => $user->getDiscord()->getId(),
                'username' => $user->getDiscord()->getUsername(),
                'discriminator' => $user->getDiscord()->getDiscriminator(),
            ],
            'channels' => [
                'twitch' => $twitchJson,
            ],
            'thumbnail' => $user->getDiscord()->getThumbnail(config('services.discord.cdn_base_url')),
            'permissions' => $allowed
        ];
    }

    public function jsonSerialize(): array
    {
        return $this->json;
    }
}

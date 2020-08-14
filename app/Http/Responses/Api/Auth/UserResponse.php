<?php

namespace App\Http\Responses\Api\Auth;

use JsonSerializable;
use Ome\Auth\Entities\User;
use Ome\Permission\Entities\RolePermission;

class UserResponse implements JsonSerializable
{
    private array $json;

    public function __construct(
        User $user,
        array $rolePermissions
    ) {
        $allowed = [];
        foreach ($rolePermissions as $rolePermission) {
            foreach ($rolePermission->getAllowed() as $allowedDomain) {
                $allowed[] = $allowedDomain->value();
            }
        }

        array_unique($allowed);

        $this->json = [
            'id' => $user->getId(),
            'username' => $user->getUsername(),
            'discord' => [
                'id' => $user->getDiscordId()
            ],
            'permissions' => $allowed
        ];
    }

    public function jsonSerialize(): array
    {
        return $this->json;
    }
}

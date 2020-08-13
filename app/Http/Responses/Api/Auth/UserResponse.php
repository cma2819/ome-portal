<?php

namespace App\Http\Responses\Api\Auth;

use JsonSerializable;
use Ome\Auth\Entities\User;

class UserResponse implements JsonSerializable
{
    private User $user;

    public function __construct(
        User $user
    ) {
        $this->user = $user;
    }

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->user->getId(),
            'username' => $this->user->getUsername(),
            'discord' => [
                'id' => $this->user->getDiscordId()
            ]
        ];
    }
}

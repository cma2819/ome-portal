<?php

namespace App\Http\Responses\Api\Users;

use JsonSerializable;

class UserResponse implements JsonSerializable
{
    private array $json;

    public function __construct(
        int $id,
        string $username,
        string $discordId
    ) {
        $this->json = [
            'id' => $id,
            'username' => $username,
            'discord' => [
                'id' => $discordId,
            ],
        ];
    }

    public function jsonSerialize()
    {
        return $this->json;
    }
}

<?php

namespace App\Http\Responses\Api\Auth;

use JsonSerializable;

class UserProfileResponse implements JsonSerializable
{
    private array $json;

    public function __construct(
        string $id,
        string $username,
        DiscordProfileResponse $discord
    ) {
        $this->json = [
            'id' => $id,
            'username' => $username,
            'discord' => $discord->jsonSerialize()
        ];
    }

    public function jsonSerialize(): array
    {
        return $this->json;
    }
}

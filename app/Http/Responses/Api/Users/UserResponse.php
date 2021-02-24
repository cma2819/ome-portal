<?php

namespace App\Http\Responses\Api\Users;

use JsonSerializable;

class UserResponse implements JsonSerializable
{
    private array $json;

    public function __construct(
        int $id,
        string $username,
        string $discordId,
        array $twitchIds
    ) {
        $twitchJson = collect($twitchIds)->map(function (string $id) {
            return ['id' => $id];
        })->all();

        $this->json = [
            'id' => $id,
            'username' => $username,
            'discord' => [
                'id' => $discordId,
            ],
            'channels' => [
                'twitch' => $twitchJson,
            ],
        ];
    }

    public function jsonSerialize()
    {
        return $this->json;
    }
}

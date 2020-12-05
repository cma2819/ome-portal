<?php

namespace App\Http\Responses\Api\Auth;

use JsonSerializable;

class DiscordProfileResponse implements JsonSerializable
{
    private array $json;

    public function __construct(
        string $id,
        string $username,
        string $discriminator
    ) {
        $this->json = [
            'id' => $id,
            'username' => $username,
            'discriminator' => $discriminator
        ];
    }

    public function jsonSerialize(): array
    {
        return $this->json;
    }
}

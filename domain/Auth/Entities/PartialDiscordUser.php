<?php

namespace Ome\Auth\Entities;

class PartialDiscordUser extends DiscordUser
{
    public static function createPartial(
        string $id,
        string $username,
        string $discriminator
    ): self {
        return new self($id, $username, $discriminator);
    }
}

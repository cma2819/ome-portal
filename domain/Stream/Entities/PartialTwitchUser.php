<?php

namespace Ome\Stream\Entities;

class PartialTwitchUser extends TwitchUser
{
    public static function createPartial(
        string $id,
        string $username,
        string $displayName
    ): parent {
        return new TwitchUser(
            $id,
            $username,
            $displayName
        );
    }
}

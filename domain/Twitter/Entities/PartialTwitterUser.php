<?php

namespace Ome\Twitter\Entities;

class PartialTwitterUser extends TwitterUser
{
    public static function createPartial(
        string $id,
        string $name,
        string $screenName
    ): TwitterUser {
        return new parent($id, $name, $screenName);
    }
}

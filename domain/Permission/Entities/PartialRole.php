<?php

namespace Ome\Permission\Entities;

class PartialRole extends Role
{
    public static function createPartial(
        string $id,
        string $name
    ): Role {
        return new parent($id, $name);
    }
}

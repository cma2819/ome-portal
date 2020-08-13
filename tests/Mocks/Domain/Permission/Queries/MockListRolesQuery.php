<?php

namespace Tests\Mocks\Domain\Permission\Queries;

use Ome\Permission\Entities\Role;
use Ome\Permission\Interfaces\Queries\ListRolesQuery;

class MockListRolesQuery implements ListRolesQuery
{
    public function fetch(): array
    {
        return [
            Role::createFromApiJson(json_decode('{
                "id": "41771983423143936",
                "name": "WE DEM BOYZZ!!!!!!",
                "color": 3447003,
                "hoist": true,
                "position": 1,
                "permissions": 66321471,
                "permissions_new": "66321471",
                "managed": false,
                "mentionable": false
            }', true)
        )];
    }
}

<?php

namespace Tests\Feature\Streams;

use Ome\Permission\Interfaces\Queries\GetRolesForUserQuery;

class GetEmptyRolesForUserQuery implements GetRolesForUserQuery
{
    public function fetch(int $id): array
    {
        return [];
    }
}

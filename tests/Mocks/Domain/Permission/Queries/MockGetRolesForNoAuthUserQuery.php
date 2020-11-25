<?php

namespace Tests\Mocks\Domain\Permission\Queries;

use Ome\Permission\Interfaces\Queries\GetRolesForUserQuery;

class MockGetRolesForNoAuthUserQuery implements GetRolesForUserQuery
{
    public function fetch(int $id): array
    {
        return [];
    }
}

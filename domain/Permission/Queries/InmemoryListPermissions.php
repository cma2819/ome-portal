<?php

namespace Ome\Permission\Queries;

use Ome\Permission\Entities\RolePermission;
use Ome\Permission\Interfaces\Queries\ListPermissionsQuery;

class InmemoryListPermissions implements ListPermissionsQuery
{
    /** @var RolePermission[] */
    private array $permissions;

    public function __construct(
        array $permissions
    ) {
        $this->permissions = $permissions;
    }

    public function fetch(): array
    {
        return $this->permissions;
    }
}

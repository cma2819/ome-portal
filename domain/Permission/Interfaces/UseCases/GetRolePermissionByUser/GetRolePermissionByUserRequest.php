<?php

namespace Ome\Permission\Interfaces\UseCases\GetRolePermissionByUser;

/**
 * Request object for GetRolePermissionByUser.
 */
class GetRolePermissionByUserRequest
{
    private int $id;

    public function __construct(
        int $id
    ) {
        $this->id = $id;
    }

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }
}

<?php

namespace App\Http\Responses\Api\Roles;

use JsonSerializable;
use Ome\Permission\Entities\Role;
use Ome\Permission\Entities\RolePermission;

class RoleResponse implements JsonSerializable
{
    private array $json;

    public function __construct(
        Role $role,
        RolePermission $rolePermission
    ) {
        $allowed = [];
        foreach ($rolePermission->getAllowed() as $allowedDomain) {
            $allowed[] = $allowedDomain->value();
        }

        $this->json = [
            'id' => $role->getId(),
            'name' => $role->getName(),
            'permissions' => $allowed
        ];
    }

    public function jsonSerialize(): array
    {
        return $this->json;
    }
}

<?php

namespace Ome\Permission\Interfaces\UseCases\SaveRolePermission;

/**
 * Request object for SaveRolePermission.
 */
class SaveRolePermissionRequest
{
    private string $id;

    /** @var string[] */
    private array $allowed;

    public function __construct(
        string $id,
        array $allowed
    ) {
        $this->id = $id;
        $this->allowed = $allowed;
    }

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of allowed
     */
    public function getAllowed()
    {
        return $this->allowed;
    }
}

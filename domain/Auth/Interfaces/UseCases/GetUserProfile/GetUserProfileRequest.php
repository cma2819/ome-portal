<?php

namespace Ome\Auth\Interfaces\UseCases\GetUserProfile;

/**
 * Request object for GetUserProfile.
 */
class GetUserProfileRequest
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

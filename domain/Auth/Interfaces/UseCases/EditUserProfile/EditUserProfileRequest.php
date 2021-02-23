<?php

namespace Ome\Auth\Interfaces\UseCases\EditUserProfile;

/**
 * Request object for EditUserProfile.
 */
class EditUserProfileRequest
{
    private int $id;

    private string $username;

    public function __construct(
        int $id,
        string $username
    ) {
        $this->id = $id;
        $this->username = $username;
    }

    /**
     * Get the value of username
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }
}

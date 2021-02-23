<?php

namespace Ome\Auth\Interfaces\UseCases\EditUserProfile;

use Ome\Auth\Entities\User;

/**
 * Response object for EditUserProfile.
 */
class EditUserProfileResponse
{
    private User $user;

    public function __construct(
        User $user
    ) {
        $this->user = $user;
    }

    /**
     * Get the value of user
     */
    public function getUser()
    {
        return $this->user;
    }
}

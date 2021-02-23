<?php

namespace Ome\Auth\Interfaces\UseCases\GetAuthenticatedUser;

use Ome\Auth\Entities\User;
use Ome\Auth\Interfaces\Dto\UserProfile;

/**
 * Response object for GetAuthenticatedUser.
 */
class GetAuthenticatedUserResponse
{
    private UserProfile $user;

    public function __construct(
        UserProfile $user
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

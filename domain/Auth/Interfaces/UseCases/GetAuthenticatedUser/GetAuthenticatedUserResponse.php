<?php

namespace Ome\Auth\Interfaces\UseCases\GetAuthenticatedUser;

use Ome\Auth\Entities\User;

/**
 * Response object for GetAuthenticatedUser.
 */
class GetAuthenticatedUserResponse
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

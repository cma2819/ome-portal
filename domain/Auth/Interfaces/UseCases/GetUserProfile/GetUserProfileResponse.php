<?php

namespace Ome\Auth\Interfaces\UseCases\GetUserProfile;

use Ome\Auth\Interfaces\Dto\UserProfile;

/**
 * Response object for GetUserProfile.
 */
class GetUserProfileResponse
{
    private UserProfile $profile;

    public function __construct(
        UserProfile $profile
    ) {
        $this->profile = $profile;
    }

    /**
     * Get the value of profile
     */
    public function getProfile()
    {
        return $this->profile;
    }
}

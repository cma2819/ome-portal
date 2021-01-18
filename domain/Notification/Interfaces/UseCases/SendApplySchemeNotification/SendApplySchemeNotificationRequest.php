<?php

namespace Ome\Notification\Interfaces\UseCases\SendApplySchemeNotification;

use Ome\Auth\Interfaces\Dto\UserProfile;
use Ome\Event\Entities\EventScheme;

/**
 * Request object for SendApplySchemeNotification.
 */
class SendApplySchemeNotificationRequest
{
    private EventScheme $scheme;

    private UserProfile $userProfile;

    public function __construct(
        EventScheme $scheme,
        UserProfile $userProfile
    ) {
        $this->scheme = $scheme;
        $this->userProfile = $userProfile;
    }

    /**
     * Get the value of scheme
     */
    public function getScheme()
    {
        return $this->scheme;
    }

    /**
     * Get the value of userProfile
     */
    public function getUserProfile()
    {
        return $this->userProfile;
    }
}

<?php

namespace Ome\Notification\Interfaces\UseCases\SendApplySchemeNotification;

use Ome\Notification\Entities\EventSchemeNotification;

/**
 * Response object for SendApplySchemeNotification.
 */
class SendApplySchemeNotificationResponse
{
    private EventSchemeNotification $notification;

    public function __construct(
        EventSchemeNotification $notification
    ) {
        $this->notification = $notification;
    }

    /**
     * Get the value of notification
     */
    public function getNotification()
    {
        return $this->notification;
    }
}

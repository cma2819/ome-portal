<?php

namespace Ome\Notification\Interfaces\UseCases\SendApplyPlanNotification;

use Ome\Notification\Entities\SimpleNotification;

/**
 * Response object for SendApplyPlanNotification.
 */
class SendApplyPlanNotificationResponse
{
    protected SimpleNotification $notification;

    public function __construct(
        SimpleNotification $notification
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

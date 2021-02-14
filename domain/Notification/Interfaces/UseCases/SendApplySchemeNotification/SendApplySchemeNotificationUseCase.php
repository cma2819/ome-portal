<?php

namespace Ome\Notification\Interfaces\UseCases\SendApplySchemeNotification;

/**
 * Send Apply Scheme Notification.
 */
interface SendApplySchemeNotificationUseCase
{
    /**
     * Send Apply Scheme Notification.
     */
    public function interact(SendApplySchemeNotificationRequest $request): SendApplySchemeNotificationResponse;
}

<?php

namespace Ome\Notification\Commands;

use Ome\Notification\Entities\Notifiable;
use Ome\Notification\Interfaces\Commands\SendNotificationCommand;

class InmemorySendNotification implements SendNotificationCommand
{
    private array $notifications = [];

    public function execute(Notifiable $notification)
    {
        $this->notifications[] = $notification;
    }

    /**
     * Get the value of notifications
     */
    public function getNotifications()
    {
        return $this->notifications;
    }
}

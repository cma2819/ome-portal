<?php

namespace Ome\Notification\Interfaces\Commands;

use Ome\Notification\Entities\Notifiable;

interface SendNotificationCommand
{
    public function execute(Notifiable $notification);
}

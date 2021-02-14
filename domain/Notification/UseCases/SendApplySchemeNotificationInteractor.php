<?php

namespace Ome\Notification\UseCases;

use Ome\Notification\Entities\EventSchemeNotification;
use Ome\Notification\Interfaces\Commands\SendNotificationCommand;
use Ome\Notification\Interfaces\UseCases\SendApplySchemeNotification\SendApplySchemeNotificationRequest;
use Ome\Notification\Interfaces\UseCases\SendApplySchemeNotification\SendApplySchemeNotificationResponse;
use Ome\Notification\Interfaces\UseCases\SendApplySchemeNotification\SendApplySchemeNotificationUseCase;

class SendApplySchemeNotificationInteractor implements SendApplySchemeNotificationUseCase
{
    protected SendNotificationCommand $sendNotification;

    public function __construct(
        SendNotificationCommand $sendNotification
    ) {
        $this->sendNotification = $sendNotification;
    }

    public function interact(SendApplySchemeNotificationRequest $request): SendApplySchemeNotificationResponse
    {
        $notification = EventSchemeNotification::createFromScheme(
            $request->getScheme(),
            $request->getUserProfile()
        );

        $this->sendNotification->execute($notification);

        return new SendApplySchemeNotificationResponse($notification);
    }
}

<?php

namespace Ome\Notification\UseCases;

use Ome\Notification\Entities\SimpleNotification;
use Ome\Notification\Interfaces\Commands\SendNotificationCommand;
use Ome\Notification\Interfaces\UseCases\SendApplyPlanNotification\SendApplyPlanNotificationRequest;
use Ome\Notification\Interfaces\UseCases\SendApplyPlanNotification\SendApplyPlanNotificationResponse;
use Ome\Notification\Interfaces\UseCases\SendApplyPlanNotification\SendApplyPlanNotificationUseCase;
use Ome\Notification\Templates\Event\ApplyEventPlanMessage;
use Ome\Notification\Templates\Event\ApplyEventPlanSubject;

class SendApplyPlanNotificationInteractor implements SendApplyPlanNotificationUseCase
{
    protected SendNotificationCommand $sendNotification;

    public function __construct(
        SendNotificationCommand $sendNotification
    ) {
        $this->sendNotification = $sendNotification;
    }

    public function interact(SendApplyPlanNotificationRequest $request): SendApplyPlanNotificationResponse
    {
        $notification = SimpleNotification::create(
            new ApplyEventPlanSubject($request->getPlan()->getName()),
            new ApplyEventPlanMessage($request->getPlan()->getExplanation())
        );

        $this->sendNotification->execute($notification);

        return new SendApplyPlanNotificationResponse($notification);
    }
}

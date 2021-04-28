<?php

namespace Ome\Notification\Interfaces\UseCases\SendApplyPlanNotification;

/**
 * Send Apply Plan Notification.
 */
interface SendApplyPlanNotificationUseCase
{
	/**
	 * Send Apply Plan Notification.
	 */
	public function interact(SendApplyPlanNotificationRequest $request): SendApplyPlanNotificationResponse;
}

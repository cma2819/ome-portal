<?php

namespace Ome\Notification\Interfaces\UseCases\SendApplyPlanNotification;

use Ome\Auth\Interfaces\Dto\UserProfile;
use Ome\Event\Entities\EventPlan;

/**
 * Request object for SendApplyPlanNotification.
 */
class SendApplyPlanNotificationRequest
{
    protected EventPlan $plan;

    protected UserProfile $userProfile;

    public function __construct(
        EventPlan $plan,
        UserProfile $userProfile
    ) {
        $this->plan = $plan;
        $this->userProfile = $userProfile;
    }

    /**
     * Get the value of plan
     */
    public function getPlan()
    {
        return $this->plan;
    }

    /**
     * Get the value of userProfile
     */
    public function getUserProfile()
    {
        return $this->userProfile;
    }
}

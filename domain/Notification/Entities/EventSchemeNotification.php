<?php

namespace Ome\Notification\Entities;

use Ome\Auth\Interfaces\Dto\UserProfile;
use Ome\Event\Entities\EventScheme;
use Ome\Notification\Templates\Event\ApplyEventSchemeMessage;
use Ome\Notification\Templates\Event\ApplyEventSchemeSubject;
use Ome\Notification\Templates\Template;

class EventSchemeNotification implements Notifiable
{
    private Template $subject;

    private Template $message;

    protected function __construct(
        EventScheme $scheme,
        UserProfile $plannerProfile
    ) {
        $this->subject = new ApplyEventSchemeSubject($scheme->getId());
        $this->message = new ApplyEventSchemeMessage(
            $scheme->getName(),
            $plannerProfile->getName(),
            $scheme->getExplanation()
        );
    }

    public static function createFromScheme(
        EventScheme $scheme,
        UserProfile $plannerProfile
    ): self {
        return new self(
            $scheme,
            $plannerProfile
        );
    }

    /**
     * Get the value of subject
     */
    public function getSubject(): string
    {
        return $this->subject->toString();
    }

    /**
     * Get the value of message
     */
    public function getMessage(): string
    {
        return $this->message->toString();
    }
}

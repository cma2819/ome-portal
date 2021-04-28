<?php

namespace Ome\Notification\Templates\Event;

use Ome\Notification\Templates\Template;

class ApplyEventPlanSubject implements Template
{
    private string $subject;

    public function __construct(
        string $name
    ) {
        $this->subject = "イベント企画案応募通知: [{$name}]";
    }

    public function toString(): string
    {
        return $this->subject;
    }
}
